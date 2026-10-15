<?php

namespace App\Http\Controllers\FeeModule;

use App\Http\Controllers\Controller;
use App\Models\FeeModule\FeeCollection;
use App\Models\FeeModule\FeeCollectionDetail;
use App\Models\FeeModule\StudentFeeAssignment;
use App\Models\FeeModule\StudentFeeAssignmentDetail;
use App\Models\FeeModule\StudentFeeConcession;
use App\Models\FeeModule\StudentFeeLedger;
use App\Models\School;
use App\Models\TransportMonth;
use App\Services\FeeModule\FeeFineCalculator;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeCollectionController extends Controller
{
    protected FeeFineCalculator $fineCalculator;

    public function __construct(FeeFineCalculator $fineCalculator)
    {
        $this->fineCalculator = $fineCalculator;
    }

    public function index()
    {
        return view('School.Pages.FeeModule.fee_collection');
    }

    /*
    |--------------------------------------------------------------------------
    | GET ledger rows for a student (pending/partial only) with
    | auto-computed concession + fine (editable on the frontend)
    |--------------------------------------------------------------------------
    */
    public function ledgerByStudent(Request $request)
    {
        $request->validate(['student_id' => 'required|exists:students,id']);

        $sessionId = activeSession()->id;

        $rows = StudentFeeLedger::with(['feeHead', 'installment'])
            ->where('student_id', $request->student_id)
            ->where('session_id', $sessionId)
            ->whereIn('payment_status', [0, 1]) // 0=Pending, 1=Partial
            ->where('status', true)
            ->orderBy('fee_installment_detail_id')
            ->get();

        if ($rows->isEmpty()) {
            return response()->json(['status' => true, 'data' => []]);
        }

        // Build a (fee_head_id + fee_installment_detail_id) -> assignment_detail_id
        // map ONCE for this student, so concession lookup below doesn't run
        // a query per row.
        $assignmentDetailMap = $this->buildAssignmentDetailMap($request->student_id, $sessionId);

        // transport_months.order -> full row, for THIS session, fetched once.
        // Used to resolve each ledger row's calendar start_month to the
        // school's own Transport Month master (id / name / order) — the
        // blade groups & labels the "Months" panel using these, not a
        // hardcoded Jan-Dec array.
        $transportMonthsByOrder = TransportMonth::where('session_id', $sessionId)
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('sort_order');

        $today = Carbon::today();

        $data = $rows->map(function ($row) use ($today, $assignmentDetailMap, $transportMonthsByOrder) {

            $detailId   = $assignmentDetailMap[$row->fee_head_id . '_' . $row->fee_installment_detail_id] ?? null;
            $concession = $this->calculateConcession($row, $detailId);
            $fine       = $this->calculateFine($row, $today);

            $startMonth      = optional($row->installment)->start_month;
            $transportMonth  = $startMonth
                ? ($transportMonthsByOrder[$this->monthToOrder($startMonth)] ?? null)
                : null;

            return [
                'id'                        => $row->id,
                'fee_head_id'               => $row->fee_head_id,
                'fee_installment_detail_id' => $row->fee_installment_detail_id,
                'installment_name'          => optional($row->installment)->installment_name,
                'transport_month_id'        => optional($transportMonth)->id,
                'transport_month_name'      => optional($transportMonth)->month_name,
                'transport_month_order'     => optional($transportMonth)->order,
                'fee_head'                  => ['head_name' => optional($row->feeHead)->head_name],
                'amount'                    => $row->amount,
                'balance_amount'            => $row->balance_amount,
                'due_date'                  => $row->due_date,
                'concession_amount'         => round($concession, 2),
                'fine_amount'               => round($fine, 2),
            ];
        });

        return response()->json(['status' => true, 'data' => $data]);
    }

    /**
     * fee_head_id + fee_installment_detail_id -> student_fee_assignment_detail_id,
     * for the given student's active-session assignment.
     */
    private function buildAssignmentDetailMap(int $studentId, int $sessionId): array
    {
        $assignment = StudentFeeAssignment::where('session_id', $sessionId)
            ->where('student_id', $studentId)
            ->first();

        if (!$assignment) {
            return [];
        }

        return StudentFeeAssignmentDetail::where('student_fee_assignment_id', $assignment->id)
            ->get(['id', 'fee_head_id', 'fee_installment_detail_id'])
            ->mapWithKeys(function ($d) {
                return [$d->fee_head_id . '_' . $d->fee_installment_detail_id => $d->id];
            })
            ->toArray();
    }

    /*
    |--------------------------------------------------------------------------
    | Auto concession: sums all active concessions recorded against this
    | ledger row's matching student_fee_assignment_detail_id (concessions
    | are stored per-detail, not per-head — see student_fee_concessions
    | migration), capped so total concession never exceeds the row balance.
    |--------------------------------------------------------------------------
    */
    private function calculateConcession(StudentFeeLedger $row, ?int $assignmentDetailId): float
    {
        if (!$assignmentDetailId) {
            return 0;
        }

        $concessions = StudentFeeConcession::where('student_fee_assignment_detail_id', $assignmentDetailId)
            ->where('status', true)
            ->get();

        $total = 0;

        foreach ($concessions as $c) {
            $total += $c->concession_mode == 2 // percentage
                ? ($row->amount * $c->concession_value / 100)
                : $c->concession_value;
        }

        return min($total, (float) $row->balance_amount);
    }

    /*
    |--------------------------------------------------------------------------
    | Auto fine: delegates to the shared FeeFineCalculator (same one used at
    | ledger-generation time) — single global active Fee Fine Master,
    | evaluated as of "today" (the reference date), against the ledger
    | row's own due_date and installment month.
    |--------------------------------------------------------------------------
    */
    private function calculateFine(StudentFeeLedger $row, Carbon $today): float
    {
        if (!$row->due_date) {
            return 0;
        }

        return $this->fineCalculator->calculate(
            $row->session_id,
            optional($row->installment)->start_month,
            $row->due_date,
            $today->toDateString()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE — collect fee, edited concession/fine values honored as-is
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'student_id'                       => 'required|exists:students,id',
            'receipt_date'                      => 'required|date',
            'payment_mode'                       => 'required|integer',
            'details'                            => 'required|array|min:1',
            'details.*.student_fee_ledger_id'    => 'required|exists:student_fee_ledgers,id',
            'details.*.paid_amount'              => 'required|numeric|min:0',
            'details.*.concession_amount'        => 'nullable|numeric|min:0',
            'details.*.fine_amount'              => 'nullable|numeric|min:0',
        ]);

        $sessionId = activeSession()->id;

        DB::beginTransaction();

        try {

            $totalAmount     = 0;
            $totalConcession = 0;
            $totalFine       = 0;

            $collection = FeeCollection::create([
                'school_id'      => null,
                'session_id'     => $sessionId,
                'student_id'     => $request->student_id,
                'receipt_no'     => $this->generateReceiptNo(),
                'receipt_date'   => $request->receipt_date,
                'payment_mode'   => $request->payment_mode,
                'transaction_no' => $request->transaction_no,
                'bank_name'      => $request->bank_name,
                'remarks'        => $request->remarks,
                'received_by'    => auth()->id(),
                'receipt_status' => 1,
            ]);

            foreach ($request->details as $line) {

                $ledger = StudentFeeLedger::where('id', $line['student_fee_ledger_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $paid       = round($line['paid_amount'], 2);
                $concession = round($line['concession_amount'] ?? 0, 2);
                $fine       = round($line['fine_amount'] ?? 0, 2);

                if ($paid + $concession > $ledger->balance_amount + 0.01) {
                    throw new Exception("Paid + concession exceeds due for ledger #{$ledger->id}.");
                }

                FeeCollectionDetail::create([
                    'fee_collection_id'     => $collection->id,
                    'student_fee_ledger_id' => $ledger->id,
                    'amount'                => $ledger->amount,
                    'concession_amount'     => $concession,
                    'fine_amount'           => $fine,
                    'paid_amount'           => $paid,
                ]);

                $ledger->paid_amount       = round(((float) $ledger->paid_amount) + $paid, 2);
                $ledger->concession_amount = round(((float) $ledger->concession_amount) + $concession, 2);
                $ledger->fine_amount       = $fine; // latest snapshot, as agreed

                // Full recompute (NOT a running subtraction) — keeps balance
                // correct even if fine has moved since generation time.
                $balance = ((float) $ledger->amount)
                    + $ledger->fine_amount
                    - $ledger->concession_amount
                    - $ledger->paid_amount;

                $ledger->balance_amount = max(round($balance, 2), 0);
                $ledger->paid_date      = $request->receipt_date;
                $ledger->payment_status = $ledger->balance_amount <= 0.01
                    ? 2 // Paid
                    : ($ledger->paid_amount > 0 ? 1 : 0); // Partial : Pending

                $ledger->save();

                $totalAmount     += $paid;
                $totalConcession += $concession;
                $totalFine       += $fine;
            }

            $collection->update([
                'total_amount'     => $totalAmount,
                'total_concession' => $totalConcession,
                'total_fine'       => $totalFine,
                'net_amount'       => $totalAmount + $totalFine,
            ]);

            DB::commit();

            return response()->json([
                'status'        => true,
                'message'       => 'Fee collected successfully.',
                'collection_id' => $collection->id,
                'receipt_no'    => $collection->receipt_no,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 422);
        }
    }

    private function monthToOrder(int $calendarMonth): int
    {
        return $calendarMonth >= 4 ? $calendarMonth - 3 : $calendarMonth + 9;
    }

    public function generateReceiptNo(): string
    {
        $lastReceiptNo = FeeCollection::where('session_id', activeSession()->id)
            ->orderByDesc('id')
            ->value('receipt_no');

        if ($lastReceiptNo) {
            $lastNumber = (int) preg_replace('/\D/', '', $lastReceiptNo);

            return 'RC' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        }

        $school = School::firstOrFail();

        $startingNo = $school->starting_recept_no ?? 1;

        return 'RC' . str_pad($startingNo, 6, '0', STR_PAD_LEFT);
    }


    public function historyByStudent(Request $request)
    {
        $request->validate(['student_id' => 'required|exists:students,id']);

        $collections = FeeCollection::where('student_id', $request->student_id)
            ->orderByDesc('receipt_date')
            ->orderByDesc('id')
            ->get();

        $data = $collections->map(function ($c) {
            return [
                'id'                 => $c->id,
                'receipt_no'         => $c->receipt_no,
                'receipt_date'       => optional($c->receipt_date)->format('d M Y') ?? $c->receipt_date,
                'payment_mode'       => $c->payment_mode,
                'payment_mode_label' => $this->paymentModeLabel($c->payment_mode),
                'transaction_no'     => $c->transaction_no,
                'total_amount'       => (float) $c->total_amount,
                'total_concession'   => (float) $c->total_concession,
                'total_fine'         => (float) $c->total_fine,
                'net_amount'         => (float) $c->net_amount,
                'receipt_status'     => (int) $c->receipt_status,
                'remarks'            => $c->remarks,
            ];
        });

        return response()->json(['status' => true, 'data' => $data]);
    }

    private function paymentModeLabel($mode): string
    {
        return [
            1 => 'Cash',
            2 => 'Cheque',
            3 => 'Online',
            4 => 'UPI',
            5 => 'Card',
            6 => 'Bank Transfer',
        ][(int) $mode] ?? '-';
    }
}
