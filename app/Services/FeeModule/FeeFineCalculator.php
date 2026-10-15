<?php

namespace App\Services\FeeModule;

use App\Models\FeeModule\FeeCollection;
use App\Models\FeeModule\FeeFineMaster;
use App\Models\FeeModule\FeeFineRule;
use App\Models\FeeModule\FeeFineRuleAmount;
use App\Models\School;
use App\Models\TransportMonth;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| FeeFineCalculator
|--------------------------------------------------------------------------
| Ek hi, GLOBAL, active (status = 1) Fee Fine Master poore school/session
| ke liye use hota hai — fee_head se koi link nahi hai. Fine sirf isi
| baat par depend karta hai ki:
|   - is installment ka target month kaunsa hai (fee_installment_details.start_month)
|   - due_date se kitne din late payment ho raha hai (ya aaj tak ho chuka hai)
|
| Calendar month (1=Jan...12=Dec) ko transport_months.order se match karne
| ka formula (April-start academic session assume kiya gaya hai):
|   order = month >= 4 ? month - 3 : month + 9
|   (April=1, May=2, ... Dec=9, Jan=10, Feb=11, Mar=12)
|
| NOTE: Model namespaces (FeeFineMaster, FeeFineRule, FeeFineRuleAmount,
| TransportMonth) yahan best-guess hain based on the existing
| StudentFeeAssignmentController pattern (App\Models\FeeModule\*). Agar
| aapke project mein inka actual namespace/location alag hai, sirf yeh
| `use` statements upar adjust kar dena — baaki logic waisa hi rahega.
|--------------------------------------------------------------------------
*/

class FeeFineCalculator
{
    /**
     * Calculate fine amount for a given installment, as of a reference date.
     *
     * @param  int          $sessionId
     * @param  int|null     $installmentStartMonth  fee_installment_details.start_month (1-12)
     * @param  string|null  $dueDate                Y-m-d
     * @param  string|null  $referenceDate           Y-m-d — the date fine is being evaluated
     *                                                on (generation time = today, collection
     *                                                time = actual payment date). Defaults to today.
     * @return float
     */
    public function calculate(
        int $sessionId,
        ?int $installmentStartMonth,
        ?string $dueDate,
        ?string $referenceDate = null
    ): float {

        if (!$installmentStartMonth || !$dueDate) {
            return 0;
        }

        $master = FeeFineMaster::where('status', 1)->first();

        if (!$master) {
            return 0;
        }

        $reference = $referenceDate ? Carbon::parse($referenceDate) : Carbon::now();
        $due       = Carbon::parse($dueDate);

        if ($reference->lessThanOrEqualTo($due)) {
            return 0; // not due yet / paid on/before due date
        }

        $daysLate = $due->diffInDays($reference) - (int) $master->grace_days;

        if ($daysLate <= 0) {
            return 0; // still within grace period
        }

        return match ((int) $master->fine_type) {
            1 => $this->fixedOrPerDay($master, $daysLate, false),
            2 => $this->fixedOrPerDay($master, $daysLate, true),
            3 => $this->monthlyMatrix($master, $sessionId, $installmentStartMonth, $reference),
            default => 0,
        };
    }

    /**
     * fine_type 1 (Fixed) / 2 (Per Day)
     * Rows for these types have transport_month_id = null; from_day/to_day
     * represent a "days late" slab.
     */
    private function fixedOrPerDay(FeeFineMaster $master, int $daysLate, bool $perDay): float
    {
        $rule = FeeFineRule::where('fee_fine_master_id', $master->id)
            ->whereNull('transport_month_id')
            ->where('from_day', '<=', $daysLate)
            ->where('to_day', '>=', $daysLate)
            ->where('status', 1)
            ->orderBy('display_order')
            ->first();

        if (!$rule || $rule->fine_amount === null) {
            return 0;
        }

        return $perDay
            ? (float) $rule->fine_amount * $daysLate
            : (float) $rule->fine_amount;
    }

    /**
     * fine_type 3 (Monthly matrix)
     * Step 1: find which period-row applies, based on the REFERENCE date's
     *         own calendar month + day-of-month (row's transport_month_id
     *         + from_day/to_day).
     * Step 2: within that row, look up the amount for the installment's
     *         TARGET month via fee_fine_rule_amounts.
     */
    private function monthlyMatrix(
        FeeFineMaster $master,
        int $sessionId,
        int $installmentStartMonth,
        Carbon $reference
    ): float {

        $referenceMonthRow = TransportMonth::where('session_id', $sessionId)
            ->where('sort_order', $this->monthToOrder((int) $reference->month))
            ->first();

        if (!$referenceMonthRow) {
            return 0;
        }

        $rule = FeeFineRule::where('fee_fine_master_id', $master->id)
            ->where('transport_month_id', $referenceMonthRow->id)
            ->where('from_day', '<=', $reference->day)
            ->where('to_day', '>=', $reference->day)
            ->where('status', 1)
            ->orderBy('display_order')
            ->first();

        if (!$rule) {
            return 0;
        }

        $targetMonthRow = TransportMonth::where('session_id', $sessionId)
            ->where('sort_order', $this->monthToOrder($installmentStartMonth))
            ->first();

        if (!$targetMonthRow) {
            return 0;
        }

        $amountRow = FeeFineRuleAmount::where('fee_fine_rule_id', $rule->id)
            ->where('target_month_id', $targetMonthRow->id)
            ->first();

        return $amountRow ? (float) $amountRow->fine_amount : 0;
    }

    /**
     * Calendar month (1=Jan...12=Dec) -> transport_months.order
     * (April-start academic session: April=1 ... March=12)
     */
    private function monthToOrder(int $calendarMonth): int
    {
        return $calendarMonth >= 4 ? $calendarMonth - 3 : $calendarMonth + 9;
    }

 
}
