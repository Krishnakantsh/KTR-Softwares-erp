<?php

namespace App\Traits;

use App\Models\Library\LibraryMembership;
use App\Models\Student\Student;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionInvoice;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPayment;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPaymentRefund;
use App\Models\SuperAdmin\SubscriptionPlan\TenantSubscription;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

trait CommonCrudOperations
{


    public function commonFetch(
        $model,
        array $relations = [],
        array $whereConditions = [],
        $orderBy = 'id',
        $orderDir = 'desc',
        $groupBy = null,
        $limit = null,
        $for = null,
        array $columns = []
    ) {
        try {

            $table = (new $model)->getTable();

            $query = $model::query();

            // select columns
            if (!empty($columns)) {

                $selectColumns = [];

                foreach ($columns as $column) {

                    if (str_contains($column, '.')) {
                        $selectColumns[] = $column;
                    } else {
                        $selectColumns[] = $table . '.' . $column;
                    }
                }

                $query->select($selectColumns);
            } else {

                $query->select($table . '.*');
            }

            if (!empty($relations)) {
                $query->with($relations);
            }

            if (!empty($whereConditions)) {

                foreach ($whereConditions as $column => $value) {

                    if (is_array($value)) {
                        $query->whereIn($column, $value);
                    } else {
                        $query->where($column, $value);
                    }
                }
            }

            if (!empty($groupBy)) {
                $query->groupBy($groupBy);
            }

            if (!empty($orderBy)) {
                $query->orderBy($orderBy, $orderDir);
            }

            if (!empty($limit)) {
                $query->limit($limit);
            }

            if ($for === 'query') {
                return $query;
            }

            if ($for === 'first') {
                return $query->first();
            }

            if ($for === 'collection') {
                return $query->get();
            }

            return response()->json([
                'status' => true,
                'data'   => $query->get()
            ]);
        } catch (Exception $e) {

            if ($for) {
                throw $e;
            }

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function commonGet(
        $model,
        array $relations = [],
        array $whereConditions = [],
        $orderBy = 'id',
        $orderDir = 'desc',
        $groupBy = null,
        $limit = null,
        $for = null,
        array $columns = []
    ) {
        try {

            $table = (new $model)->getTable();

            $query = $model::query();

            // select columns
            if (!empty($columns)) {

                $selectColumns = [];

                foreach ($columns as $column) {

                    if (str_contains($column, '.')) {
                        $selectColumns[] = $column;
                    } else {
                        $selectColumns[] = $table . '.' . $column;
                    }
                }

                $query->select($selectColumns);
            } else {

                $query->select($table . '.*');
            }

            if (!empty($relations)) {
                $query->with($relations);
            }

            if (!empty($whereConditions)) {

                foreach ($whereConditions as $column => $value) {

                    if (is_array($value)) {
                        $query->whereIn($column, $value);
                    } else {
                        $query->where($column, $value);
                    }
                }
            }

            if (!empty($groupBy)) {
                $query->groupBy($groupBy);
            }

            if (!empty($orderBy)) {
                $query->orderBy($orderBy, $orderDir);
            }

            if (!empty($limit)) {
                $query->limit($limit);
            }

            if ($for === 'query') {
                return $query;
            }

            if ($for === 'first') {
                return $query->first();
            }

            if ($for === 'collection') {
                return $query->get();
            }

            return response()->json([
                'status' => true,
                'data'   => $query->first()
            ]);
        } catch (Exception $e) {

            if ($for) {
                throw $e;
            }

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function commonShow($model, Request $request, array $relations = [])
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $query = $model::query();

            if (!empty($relations)) {
                $query->with($relations);
            }

            if (Schema::hasColumn((new $model)->getTable(), 'session_id')) {
                $query->where('session_id', activeSession()->id ?? null);
            }

            $data = $query->findOrFail($request->id);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }
    }

    public function toggleStatus($model, Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $data = $model::findOrFail($request->id);

            if (Schema::hasColumn((new $model)->getTable(), 'is_active')) {
                $data->is_active = !$data->is_active;
            }

            if (Schema::hasColumn((new $model)->getTable(), 'status')) {
                $data->status = !$data->status;
            }

            $data->save();

            return response()->json([
                'status' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }
    }

    public function commonDestroy($model, Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $query = $model::query();

            if (Schema::hasColumn((new $model)->getTable(), 'session_id')) {
                $query->where('session_id', activeSession()->id ?? null);
            }

            $data = $query->findOrFail($request->id);

            $data->delete();

            return response()->json([
                'status' => true,
                'message' => 'Record deleted successfully'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function commonTrash($model)
    {
        try {

            $data = $model::onlyTrashed()
                ->where(
                    'session_id',
                    activeSession()->id ?? null
                )
                ->latest()
                ->get();

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function commonRestore($model, Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $data = $model::onlyTrashed()
                ->where(
                    'session_id',
                    activeSession()->id ?? null
                )
                ->findOrFail($request->id);

            $data->restore();

            return response()->json([
                'status' => true,
                'message' => 'Record restored successfully'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function commonForceDelete($model, Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $data = $model::onlyTrashed()
                ->where(
                    'session_id',
                    activeSession()->id ?? null
                )
                ->findOrFail($request->id);

            $data->forceDelete();

            return response()->json([
                'status' => true,
                'message' => 'Record permanently deleted'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function isDuplicate($model, array $conditions, $ignoreId = null)
    {
        $query = $model::where($conditions)
            ->where(
                'session_id',
                activeSession()->id ?? null
            );

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    public function isDuplicateAny(
        $model,
        array $conditions,
        $ignoreId = null
    ) {
        $query = $model::where(function ($q) use ($conditions) {

            foreach ($conditions as $field => $value) {

                if (!empty($value)) {
                    $q->orWhere($field, $value);
                }
            }
        })
            ->where(
                'session_id',
                activeSession()->id ?? null
            );

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    public static function generateStudentSrNo()
    {
        $year = date('Y');

        $lastStudent = Student::whereNotNull('sr_no')
            ->where('session_id', activeSession()->id)
            ->where('sr_no', 'like', "%-{$year}")
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastStudent || empty($lastStudent->sr_no)) {
            return 'SR0001-' . $year;
        }

        preg_match('/SR(\d+)-\d{4}$/', $lastStudent->sr_no, $matches);

        $lastNumber = isset($matches[1]) ? (int) $matches[1] : 0;

        $newNumber = $lastNumber + 1;

        return 'SR' . str_pad($newNumber, 4, '0', STR_PAD_LEFT) . '-' . $year;
    }

    public static function generateStudentAdmissionNo()
    {
        $year = date('Y');

        $lastStudent = Student::whereNotNull('admission_no')
            ->where('session_id', activeSession()->id)
            ->where('admission_no', 'like', "%-{$year}")
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastStudent || empty($lastStudent->admission_no)) {
            return 'ADM0001-' . $year;
        }

        preg_match('/ADM(\d+)-\d{4}$/', $lastStudent->admission_no, $matches);

        $lastNumber = isset($matches[1]) ? (int) $matches[1] : 0;

        $newNumber = $lastNumber + 1;

        return 'ADM' . str_pad($newNumber, 4, '0', STR_PAD_LEFT) . '-' . $year;
    }

    public static function generateLibraryMembershipNo()
    {
        $year = date('Y');

        $lastMembership = LibraryMembership::whereNotNull('membership_card_number')
            ->where('session_id', activeSession()->id)
            ->where('membership_card_number', 'like', "LMEM-%-{$year}")
            ->orderByDesc('id')
            ->first();


        if (!$lastMembership || empty($lastMembership->membership_card_number)) {
            return 'LMEM-00001-' . $year;
        }

        preg_match('/LMEM-(\d{5})-\d{4}/', $lastMembership->membership_card_number, $matches);

        $lastNumber = isset($matches[1]) ? (int) $matches[1] : 0;

        $newNumber = $lastNumber + 1;

        return 'LMEM-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT) . '-' . $year;
    }

    public static function generateStudentEnrollmentNo()
    {
        $year = date('Y');

        $lastStudent = Student::whereNotNull('enroll_no')
            ->where('session_id', activeSession()->id)
            ->where('enroll_no', 'like', "%-{$year}")
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastStudent || empty($lastStudent->enroll_no)) {
            return 'ENR0001-' . $year;
        }

        preg_match('/ENR(\d+)-\d{4}$/', $lastStudent->enroll_no, $matches);

        $lastNumber = isset($matches[1]) ? (int) $matches[1] : 0;

        $newNumber = $lastNumber + 1;

        return 'ENR' . str_pad($newNumber, 4, '0', STR_PAD_LEFT) . '-' . $year;
    }

    public static function generateStudentSearchQuery(array $data)
    {
        $keys = ['sr_no', 'admission_no', 'enroll_no', 'first_name', 'last_name'];

        $parts = [];

        foreach ($keys as $key) {
            if (!empty($data[$key])) {
                $parts[] = $data[$key];
            }
        }

        return implode(' / ', $parts);
    }

    public static function generateInvoiceNumber()
    {
        $last = SubscriptionInvoice::latest('id')->first();

        $number = $last ? $last->id + 1 : 1;

        return 'INV-' .
            now()->year .
            '-' .
            str_pad($number, 6, '0', STR_PAD_LEFT);
    }

    public static function generatePaymentNo()
    {
        $last = SubscriptionPayment::latest('id')->first();

        $number = $last
            ? $last->id + 1
            : 1;

        return 'PAY-' .
            now()->year .
            '-' .
            str_pad(
                $number,
                6,
                '0',
                STR_PAD_LEFT
            );
    }

    public static function generateRefundNo()
    {
        $last = SubscriptionPaymentRefund::latest('id')->first();

        $number = $last
            ? $last->id + 1
            : 1;

        return 'REF-' .
            now()->year .
            '-' .
            str_pad(
                $number,
                6,
                '0',
                STR_PAD_LEFT
            );
    }

    public function generatePassword($length = 8)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $password;
    }

    public function createTenantSubscription(array $data)
    {
        $startDate = Carbon::parse($data['start_date']);

        $endDate = match ($data['billing_cycle']) {
            'monthly'      => $startDate->copy()->addMonth(),
            'quarterly'    => $startDate->copy()->addMonths(3),
            'half_yearly'  => $startDate->copy()->addMonths(6),
            'yearly'       => $startDate->copy()->addYear(),
            default        => $startDate->copy()->addMonth(),
        };

        $amount = $data['amount'] ?? 0;
        $discount = $data['discount'] ?? 0;
        $tax = $data['tax'] ?? 0;

        $finalAmount = ($amount - $discount) + $tax;

        return TenantSubscription::create([

            'tenant_id'             => $data['tenant_id'],
            'subscription_plan_id' => $data['subscription_plan_id'],

            'billing_cycle' => $data['billing_cycle'],

            'activated_at' => $data['activated_at'] ?? now(),

            'cancelled_at' => null,
            'suspended_at' => null,
            'expired_at'   => null,

            'start_date' => $startDate,
            'end_date'   => $endDate,

            'is_trial' => $data['is_trial'] ?? false,

            'trial_start_date' => $data['trial_start_date'] ?? null,
            'trial_end_date'   => $data['trial_end_date'] ?? null,

            'amount' => $amount,
            'discount' => $discount,
            'tax' => $tax,
            'final_amount' => $finalAmount,

            'status' => $data['status'] ?? 'active',

            'auto_renew' => $data['auto_renew'] ?? false,

            'renewal_count' => $data['renewal_count'] ?? 0,

            'remarks' => $data['remarks'] ?? null,
        ]);
    }

    public function updateRecordField(
        $model,
        $request,
        string $column,
        array $allowedValues
    ) {

        try {

            $record = $model::find($request->id);

            if (!$record) {

                return response()->json([
                    'status' => false,
                    'message' => 'Record not found.'
                ]);
            }

            if (!in_array($request->$column, $allowedValues)) {

                return response()->json([
                    'status' => false,
                    'message' => 'Invalid value.'
                ]);
            }

            $record->$column = $request->$column;

            $record->save();

            return response()->json([
                'status' => true,
                'message' => ucfirst(str_replace('_', ' ', $column)) . ' updated successfully.'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}


// Payment Success Service

// DB::transaction(function () use (
//     $payment,
//     $invoice
// ) {

//     $payment->update([
//         'status' => 'success'
//     ]);

//     $invoice->update([
//         'paid_amount' => $invoice->paid_amount + $payment->amount,
//         'due_amount' =>
//             $invoice->grand_total -
//             (
//                 $invoice->paid_amount +
//                 $payment->amount
//             ),
//     ]);

//     if (
//         (
//             $invoice->paid_amount +
//             $payment->amount
//         ) >= $invoice->grand_total
//     ) {

//         $invoice->update([
//             'payment_status' => 'paid'
//         ]);
//     }
// });




// Refund Service Logic

// DB::transaction(function () use (
//     $refund,
//     $payment,
//     $invoice
// ) {

//     $refund->update([
//         'status' => 'processed'
//     ]);

//     $invoice->update([
//         'paid_amount' =>
//             $invoice->paid_amount -
//             $refund->refund_amount,

//         'due_amount' =>
//             $invoice->due_amount +
//             $refund->refund_amount,

//         'payment_status' => 'partial'
//     ]);

//     $payment->update([
//         'status' => 'refunded'
//     ]);
// });






// Price Resolver Service


// public function getPlanPrice(
//     int $planId,
//     string $billingCycle
// )
// {
//     return PlanPriceHistory::query()
//         ->where(
//             'subscription_plan_id',
//             $planId
//         )
//         ->where(
//             'billing_cycle',
//             $billingCycle
//         )
//         ->whereDate(
//             'effective_from',
//             '<=',
//             now()
//         )
//         ->where(function ($query) {

//             $query->whereNull(
//                 'effective_to'
//             )->orWhereDate(
//                 'effective_to',
//                 '>=',
//                 now()
//             );
//         })
//         ->latest('effective_from')
//         ->first();
// }