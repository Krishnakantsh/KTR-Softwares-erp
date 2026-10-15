<?php

namespace App\Http\Controllers\FeeModule;

use App\Http\Controllers\Controller;
use App\Models\FeeModule\FeeHead;
use App\Models\FeeModule\FeeHeadApplicability;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeHeadApplicabilityController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        $feeHeads = FeeHead::where('status', 1)->orderBy('head_name')->get();
        $keyOptions = FeeHeadApplicability::keyOptions();

        return view('School.Pages.FeeModule.feeHeadsRules', compact('feeHeads', 'keyOptions'));
    }

 
    public function getByHead(Request $request)
    {
        $request->validate([
            'fee_head_id' => 'required|exists:fee_heads,id',
        ]);

        $rows = FeeHeadApplicability::where('fee_head_id', $request->fee_head_id)->get();

        $selected = [];
        $status   = true;

        foreach (FeeHeadApplicability::keyOptions() as $key => $meta) {
            $selected[$key] = $rows->where('applicability_key', $key)
                ->pluck('applicability_value')
                ->values();
        }

        if ($rows->isNotEmpty()) {
            $status = (bool) $rows->first()->status;
        }

        return response()->json([
            'status' => true,
            'data'   => [
                'fee_head_id' => (int) $request->fee_head_id,
                'selected'    => $selected,
                'row_status'  => $status,
            ],
        ]);
    }

    /**
     * Save (sync) applicability rules for a fee head.
     * Existing rows for this fee_head_id are replaced with the submitted selection.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fee_head_id' => 'required|exists:fee_heads,id',

            'gender'         => 'nullable|array',
            'gender.*'       => 'in:all,boys,girls',

            'student_type'   => 'nullable|array',
            'student_type.*' => 'in:all,new,old',

            'fee_type'       => 'nullable|array',
            'fee_type.*'     => 'in:all,regular,rte,repeater',

            'status' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            FeeHeadApplicability::withTrashed()
                ->where('fee_head_id', $request->fee_head_id)
                ->forceDelete();

            $status = $request->has('status') ? (bool) $request->status : false;
            $now    = now();

            $fieldToKey = [
                'gender'       => FeeHeadApplicability::KEY_GENDER,
                'student_type' => FeeHeadApplicability::KEY_STUDENT_TYPE,
                'fee_type'     => FeeHeadApplicability::KEY_FEE_TYPE,
            ];

            $rows = [];

            foreach ($fieldToKey as $field => $key) {
                foreach ($request->input($field, []) as $value) {
                    $rows[] = [
                        'school_id'           => null,
                        'fee_head_id'         => $request->fee_head_id,
                        'applicability_key'   => $key,
                        'applicability_value' => $value,
                        'status'              => $status,
                        'created_at'          => $now,
                        'updated_at'          => $now,
                    ];
                }
            }

            if (!empty($rows)) {
                FeeHeadApplicability::insert($rows);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Fee head applicability saved successfully.',
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
            FeeHeadApplicability::class,
            ['feeHead']
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            FeeHeadApplicability::class,
            ['feeHead']
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            FeeHeadApplicability::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            FeeHeadApplicability::class,
            $request,
            ['feeHead']
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            FeeHeadApplicability::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            FeeHeadApplicability::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            FeeHeadApplicability::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            FeeHeadApplicability::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            FeeHeadApplicability::class,
            $request
        );
    }
}
