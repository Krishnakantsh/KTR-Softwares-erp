<?php

namespace App\Http\Controllers\FeeModule;

use App\Http\Controllers\Controller;
use App\Models\ConcessionBy;
use App\Models\ConcessionType;
use App\Models\FeeModule\StudentFeeAssignment;
use App\Models\FeeModule\StudentFeeConcession;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFeeConcessionController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('School.Pages.FeeModule.feeConcession');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'                 => 'required|exists:students,id',
            'concession_type_id'         => 'required|exists:concession_types,id',
            'concession_by_id'           => 'required|exists:concession_bies,id',
            'concession_mode'            => 'required|in:1,2',
            'description'                => 'nullable|string',
            'status'                     => 'nullable|boolean',
            'cells'                      => 'required|array|min:1',
            'cells.*.detail_id'          => 'required|exists:student_fee_assignment_details,id',
            'cells.*.value'              => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {

            $sessionId = activeSession()->id;
            $status    = $request->has('status') ? (bool) $request->status : false;
            $savedIds  = [];

            foreach ($request->cells as $cell) {

                $concession = StudentFeeConcession::updateOrCreate(
                    [
                        'session_id'                       => $sessionId,
                        'student_id'                        => $request->student_id,
                        'student_fee_assignment_detail_id'  => $cell['detail_id'],
                        'concession_type_id'                => $request->concession_type_id,
                    ],
                    [
                        'school_id'          => null,
                        'concession_by_id'   => $request->concession_by_id,
                        'concession_mode'    => $request->concession_mode,
                        'concession_value'   => $cell['value'],
                        'description'        => $request->description,
                        'status'             => $status,
                    ]
                );

                $savedIds[] = $concession->id;
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => count($savedIds) > 1
                    ? count($savedIds) . ' fee concessions saved successfully.'
                    : 'Fee concession saved successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            StudentFeeConcession::class
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            StudentFeeConcession::class,
            [
                'student',
                'concessionType',
                'concessionBy',
                'assignmentDetail.feeHead',
                'assignmentDetail.installment',
            ]
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            StudentFeeConcession::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            StudentFeeConcession::class,
            $request,
            [
                'student',
                'concessionType',
                'concessionBy',
                'studentFeeAssignmentDetail.feeHead',
                'studentFeeAssignmentDetail.installment',
            ]
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            StudentFeeConcession::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            StudentFeeConcession::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            StudentFeeConcession::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            StudentFeeConcession::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            StudentFeeConcession::class,
            $request
        );
    }

    public function fetchConcessionTypes()
    {
        return response()->json([
            'status' => true,
            'data'   => ConcessionType::where('status', 1)
                ->orderBy('concession_type')
                ->get(),
        ]);
    }

    public function fetchConcessionBies()
    {
        return response()->json([
            'status' => true,
            'data'   => ConcessionBy::where('status', 1)
                ->orderBy('concession_by')
                ->get(),
        ]);
    }


    public function fetchAssignmentDetails(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $sessionId = activeSession()->id;

        $assignment = $this->commonFetch(StudentFeeAssignment::class, ['details.feeHead', 'details.installment'], ['student_id' => $request->student_id, 'session_id' => $sessionId], 'id', 'desc', null, null, 'first');

        $details = $assignment
            ? $assignment->details->map(function ($detail) {
                return [
                    'id'              => $detail->id,
                    'fee_head_id'     => $detail->fee_head_id,
                    'fee_head_name'   => $detail->feeHead->head_name ?? '-',
                    'start_month'     => $detail->installment->start_month ?? null,
                    'installment_name' => $detail->installment->installment_name ?? '',
                    'amount'          => $detail->amount,
                ];
            })->values()
            : collect();

        $concessions = StudentFeeConcession::where('student_id', $request->student_id)
            ->where('session_id', $sessionId)
            ->get([
                'id',
                'student_fee_assignment_detail_id',
                'concession_type_id',
                'concession_by_id',
                'concession_mode',
                'concession_value',
                'description',
                'status',
            ]);

        return response()->json([
            'status' => true,
            'data'   => [
                'structure_name' => $assignment->feeStructure->structure_name ?? null,
                'details'        => $details,
                'concessions'    => $concessions,
            ],
        ]);
    }
}
