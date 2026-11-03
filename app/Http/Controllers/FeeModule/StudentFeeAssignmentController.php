<?php

namespace App\Http\Controllers\FeeModule;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\FeeModule\FeeStructure;
use App\Models\FeeModule\StudentFeeAssignment;
use App\Models\FeeModule\StudentFeeAssignmentDetail;
use App\Models\FeeModule\StudentFeeLedger;
use App\Services\FeeModule\FeeFineCalculator;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFeeAssignmentController extends Controller
{
    protected FeeFineCalculator $fineCalculator;

    public function __construct(FeeFineCalculator $fineCalculator)
    {
        $this->fineCalculator = $fineCalculator;
    }

    /**
     * Assigned Students List
     */
    public function index()
    {
        return view('School.Pages.FeeModule.feeAssignment');
    }

    /**
     * Assign Fee Structure To Student
     */
    public function assign(Request $request)
    {
        $request->validate([
            'student_id'       => 'required|exists:students,id',
            'fee_structure_id' => 'required|exists:fee_structures,id',
            'remarks'          => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            // Check Student Already Assigned
            $alreadyAssigned = StudentFeeAssignment::where([
                'session_id' => activeSession()->id,
                'student_id' => $request->student_id,
            ])->exists();

            if ($alreadyAssigned) {

                DB::rollBack();

                return response()->json([
                    'status'  => false,
                    'message' => 'Fee is already assigned to this student.',
                ]);
            }

            // Check Fee Structure
            $structure = FeeStructure::findOrFail($request->fee_structure_id);

            // Create Assignment
            $assignment = StudentFeeAssignment::create([
                'school_id'        => null,
                'session_id'       => activeSession()->id,
                'student_id'       => $request->student_id,
                'fee_structure_id' => $structure->id,
                'assigned_date'    => now()->toDateString(),
                'remarks'          => $request->remarks,
                'status'           => true,
            ]);

            // Copy Structure Details
            $this->copyStructureDetails(
                $structure->id,
                $assignment->id
            );

            // Generate Ledger Rows (amount + fine, agar due date already nikal chuka ho)
            $this->generateLedgerForAssignment($assignment);

            DB::commit();

            return response()->json([
                'status'        => true,
                'message'       => 'Fee assigned successfully.',
                'assignment_id' => $assignment->id,
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function reAssign(Request $request)
    {
        $request->validate([
            'student_id'       => 'required|exists:students,id',
            'fee_structure_id' => 'required|exists:fee_structures,id',
            'remarks'          => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            // Check Existing Assignment
            $oldAssignment = StudentFeeAssignment::where([
                'session_id' => activeSession()->id,
                'student_id' => $request->student_id,
            ])->first();

            if ($oldAssignment) {

                StudentFeeAssignmentDetail::where(
                    'student_fee_assignment_id',
                    $oldAssignment->id
                )->forceDelete();

                // Purge stale ledger rows for this student+session — structure
                // is changing, so old rows no longer correspond to anything.
                // (If any of them already have payments, we block instead of
                // silently wiping paid history.)
                $hasOldPayments = StudentFeeLedger::where([
                    'session_id' => $oldAssignment->session_id,
                    'student_id' => $oldAssignment->student_id,
                ])->where('paid_amount', '>', 0)->exists();

                if ($hasOldPayments) {
                    DB::rollBack();

                    return response()->json([
                        'status'  => false,
                        'message' => 'Cannot re-assign — payments already collected against the current fee structure.',
                    ]);
                }

                StudentFeeLedger::where([
                    'session_id' => $oldAssignment->session_id,
                    'student_id' => $oldAssignment->student_id,
                ])->forceDelete();

                $oldAssignment->forceDelete();
            }

            // Check Fee Structure
            $structure = FeeStructure::findOrFail($request->fee_structure_id);

            // Create New Assignment
            $assignment = StudentFeeAssignment::create([
                'school_id'        => null,
                'session_id'       => activeSession()->id,
                'student_id'       => $request->student_id,
                'fee_structure_id' => $structure->id,
                'assigned_date'    => now()->toDateString(),
                'remarks'          => $request->remarks,
                'status'           => true,
            ]);

            // Copy Fee Structure Details
            $this->copyStructureDetails(
                $structure->id,
                $assignment->id
            );

            // Generate Ledger Rows
            $this->generateLedgerForAssignment($assignment);

            DB::commit();

            return response()->json([
                'status'        => true,
                'message'       => 'Fee reassigned successfully.',
                'assignment_id' => $assignment->id,
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $assignment = StudentFeeAssignment::with([
            'student',
            'feeStructure',
            'details.feeHead',
            'details.installment',
        ])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data'   => $assignment,
        ]);
    }

    public function updateAmount(Request $request)
    {
        $request->validate([
            'detail_id' => 'required|exists:student_fee_assignment_details,id',
            'amount'    => 'required|numeric|min:0',
        ]);

        $detail = StudentFeeAssignmentDetail::findOrFail($request->detail_id);

        $detail->update([
            'amount' => $request->amount,
        ]);

        // Keep the matching ledger row's amount / balance / status in sync
        $assignment = StudentFeeAssignment::find($detail->student_fee_assignment_id);

        if ($assignment) {

            $ledger = StudentFeeLedger::where([
                'session_id'                => $assignment->session_id,
                'student_id'                => $assignment->student_id,
                'fee_head_id'               => $detail->fee_head_id,
                'fee_installment_detail_id' => $detail->fee_installment_detail_id,
            ])->first();

            if ($ledger) {

                $balance = $request->amount
                    + $ledger->fine_amount
                    - $ledger->concession_amount
                    - $ledger->paid_amount;

                $ledger->update([
                    'amount'         => $request->amount,
                    'balance_amount' => max($balance, 0),
                    'payment_status' => $this->resolvePaymentStatus($ledger->paid_amount, $balance),
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Amount updated successfully.',
        ]);
    }

    /**
     * Remove Fee Head
     */
    public function removeHead(Request $request)
    {
        $request->validate([
            'detail_id' => 'required|exists:student_fee_assignment_details,id',
        ]);

        $detail = StudentFeeAssignmentDetail::findOrFail($request->detail_id);
        $assignment = StudentFeeAssignment::find($detail->student_fee_assignment_id);

        $ledger = null;

        if ($assignment) {
            $ledger = StudentFeeLedger::where([
                'session_id'                => $assignment->session_id,
                'student_id'                => $assignment->student_id,
                'fee_head_id'               => $detail->fee_head_id,
                'fee_installment_detail_id' => $detail->fee_installment_detail_id,
            ])->first();
        }

        // Safety: don't let a fee head with an already-collected payment
        // silently disappear.
        if ($ledger && $ledger->paid_amount > 0) {
            return response()->json([
                'status'  => false,
                'message' => 'Cannot remove — payment already collected against this fee head.',
            ]);
        }

        $detail->delete();

        if ($ledger) {
            $ledger->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Fee head removed successfully.',
        ]);
    }

    /**
     * Delete Assignment
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|exists:student_fee_assignments,id',
        ]);

        DB::beginTransaction();

        try {

            $assignment = StudentFeeAssignment::findOrFail($request->assignment_id);

            $hasPayments = StudentFeeLedger::where([
                'session_id' => $assignment->session_id,
                'student_id' => $assignment->student_id,
            ])->where('paid_amount', '>', 0)->exists();

            if ($hasPayments) {
                DB::rollBack();

                return response()->json([
                    'status'  => false,
                    'message' => 'Cannot delete — payments already collected against this assignment.',
                ]);
            }

            StudentFeeAssignmentDetail::where(
                'student_fee_assignment_id',
                $request->assignment_id
            )->delete();

            StudentFeeLedger::where([
                'session_id' => $assignment->session_id,
                'student_id' => $assignment->student_id,
            ])->delete();

            $assignment->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Assignment deleted successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    private function copyStructureDetails(int $structureId, int $assignmentId): void
    {
        $structure = FeeStructure::with('details')->findOrFail($structureId);

        $rows = [];

        foreach ($structure->details as $detail) {

            $rows[] = [

                'student_fee_assignment_id' => $assignmentId,

                'fee_head_id' => $detail->fee_head_id,

                'fee_installment_detail_id' => $detail->fee_installment_detail_id,

                'amount' => $detail->amount,

                'is_optional' => $detail->is_optional,

                'allow_concession' => $detail->allow_concession,

                'allow_fine' => $detail->allow_fine,

                'display_order' => $detail->display_order,

                'status' => $detail->status,

                'created_at' => now(),

                'updated_at' => now(),
            ];
        }

        if (!empty($rows)) {
            StudentFeeAssignmentDetail::insert($rows);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Ledger generation
    |--------------------------------------------------------------------------
    | Har student_fee_assignment_detail ke liye ek student_fee_ledgers row
    | banata/update karta hai. Match / uniqueness key = (session_id,
    | student_id, fee_head_id, fee_installment_detail_id) — is combination
    | pe hi student_fee_assignment_details bhi unique hai, isliye yahi
    | reliable link hai (ledger table mein direct FK detail_id ka nahi hai).
    |
    | Fine sirf tabhi calculate hoti hai jab due_date nikal chuka ho
    | (as-of aaj) — jaisa decide hua tha. Baad mein actual payment ke
    | waqt Collection page pe FeeFineCalculator dobara call hoga using
    | the real payment date.
    |--------------------------------------------------------------------------
    */
    private function generateLedgerForAssignment(StudentFeeAssignment $assignment): void
    {
        $details = StudentFeeAssignmentDetail::with('installment')
            ->where('student_fee_assignment_id', $assignment->id)
            ->get();

        if ($details->isEmpty()) {
            return;
        }

        $session = AcademicSession::find($assignment->session_id);

        foreach ($details as $detail) {

            $startMonth = $detail->installment->start_month ?? null;
            $dueDay     = $detail->installment->due_day ?? null;

            $dueDate = $this->calculateDueDate(
                $session->start_date ?? null,
                $startMonth,
                $dueDay
            );

            $fineAmount = 0;

            if ($dueDate && Carbon::parse($dueDate)->lessThan(Carbon::today())) {
                $fineAmount = $this->fineCalculator->calculate(
                    $assignment->session_id,
                    $startMonth,
                    $dueDate
                    // reference date defaults to today inside the calculator
                );
            }

            $amount = (float) $detail->amount;

            StudentFeeLedger::updateOrCreate(
                [
                    'session_id'                 => $assignment->session_id,
                    'student_id'                 => $assignment->student_id,
                    'fee_head_id'                => $detail->fee_head_id,
                    'fee_installment_detail_id'  => $detail->fee_installment_detail_id,
                ],
                [
                    'school_id'          => $assignment->school_id,
                    'fee_structure_id'   => $assignment->fee_structure_id,
                    'amount'             => $amount,
                    'concession_amount'  => 0,
                    'fine_amount'        => $fineAmount,
                    'paid_amount'        => 0,
                    'balance_amount'     => max($amount + $fineAmount, 0),
                    'payment_status'     => 0, // Pending
                    'due_date'           => $dueDate,
                    'status'             => true,
                ]
            );
        }
    }

    /**
     * Calendar-correct due date for an installment, based on the session's
     * start_date and the installment's start_month + due_day.
     *
     * Example: session starts 2026-04-01, installment start_month = 1 (Jan)
     * -> due date falls in 2027, not 2026.
     */
    private function calculateDueDate(?string $sessionStartDate, ?int $startMonth, ?int $dueDay): ?string
    {
        if (!$sessionStartDate || !$startMonth) {
            return null;
        }

        $sessionStart      = Carbon::parse($sessionStartDate);
        $sessionStartMonth = (int) $sessionStart->month;

        $year = $startMonth >= $sessionStartMonth
            ? $sessionStart->year
            : $sessionStart->year + 1;

        $day         = $dueDay ?: 1;
        $daysInMonth = Carbon::createFromDate($year, $startMonth, 1)->daysInMonth;
        $day         = min($day, $daysInMonth);

        return Carbon::createFromDate($year, $startMonth, $day)->toDateString();
    }

    private function resolvePaymentStatus(float $paidAmount, float $balance): int
    {
        if ($paidAmount <= 0) {
            return 0; // Pending
        }

        return $balance <= 0 ? 2 : 1; // Paid : Partial
    }


    public function byStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $assignment = StudentFeeAssignment::with([
            'student',
            'feeStructure',
            'details.feeHead',
            'details.installment',
        ])->where([
            'session_id' => activeSession()->id,
            'student_id' => $request->student_id,
        ])->first();

        return response()->json([
            'status' => (bool) $assignment,
            'data'   => $assignment,
        ]);
    }
}
