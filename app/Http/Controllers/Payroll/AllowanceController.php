<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Allowance;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AllowanceController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view("School.Pages.Payroll.PayrollMaster.add_allowances");
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'nullable|exists:allowances,id',

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'allowance_name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('allowances', 'allowance_name')
                    ->where(function ($query) use ($request) {
                        return $query->where('branch_id', $request->branch_id);
                    })
                    ->ignore($request->id),
            ],

            'allowance_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('allowances', 'allowance_code')
                    ->where(function ($query) use ($request) {
                        return $query->where('branch_id', $request->branch_id);
                    })
                    ->ignore($request->id),
            ],

            'effect_type' => 'required|in:1,2',
            'calculation_type' => 'required|in:1,2',

            'default_amount' => 'required_if:calculation_type,1|nullable|numeric|min:0',
            'default_percentage' => 'required_if:calculation_type,2|nullable|numeric|min:0|max:100',
            'percentage_on' => 'required_if:calculation_type,2|nullable|in:1,2,3,4',

            'is_taxable' => 'nullable|boolean',
            'is_pf_applicable' => 'nullable|boolean',
            'is_esic_applicable' => 'nullable|boolean',
            'is_prorated' => 'nullable|boolean',
            'is_overtime_applicable' => 'nullable|boolean',

            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {
            $allowance = $request->filled('id')
                ? Allowance::findOrFail($request->id)
                : new Allowance();

            // School & Branch
            $allowance->school_id = $allowance->exists
                ? $allowance->school_id
                : tenantSchoolId();

            $allowance->branch_id = $request->branch_id;

            // Basic Information
            $allowance->allowance_name = $request->allowance_name;
            $allowance->allowance_code = $request->allowance_code;

            // Effect & Calculation Rules
            $allowance->effect_type = $request->effect_type;
            $allowance->calculation_type = $request->calculation_type;

            $allowance->default_amount = $request->calculation_type == 1 ? ($request->default_amount ?? 0) : 0;
            $allowance->default_percentage = $request->calculation_type == 2 ? $request->default_percentage : null;
            $allowance->percentage_on = $request->calculation_type == 2 ? $request->percentage_on : null;

            // Statutory & Calculation Toggles
            $allowance->is_taxable = $request->has('is_taxable') ? (bool) $request->is_taxable : false;
            $allowance->is_pf_applicable = $request->has('is_pf_applicable') ? (bool) $request->is_pf_applicable : false;
            $allowance->is_esic_applicable = $request->has('is_esic_applicable') ? (bool) $request->is_esic_applicable : false;
            $allowance->is_prorated = $request->has('is_prorated') ? (bool) $request->is_prorated : false;
            $allowance->is_overtime_applicable = $request->has('is_overtime_applicable') ? (bool) $request->is_overtime_applicable : false;

            // Description
            $allowance->description = $request->description;

            // Status
            $allowance->status = $request->has('status')
                ? (bool) $request->status
                : true;

            // Audit
            if (!$allowance->exists) {
                $allowance->created_by = loginId();
            }

            $allowance->updated_by = loginId();

            $allowance->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $allowance->wasRecentlyCreated
                    ? 'Allowance added successfully.'
                    : 'Allowance updated successfully.',
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch allowances.
     */
    public function fetch()
    {
        return $this->commonFetch(
            Allowance::class
        );
    }

    /**
     * Fetch allowances with relationships.
     */
    public function fetchWith()
    {
        return $this->commonFetch(
            Allowance::class,
            [
                'branch'
            ]
        );
    }

    /**
     * Show allowance.
     */
    public function show(Request $request)
    {
        return $this->commonShow(
            Allowance::class,
            $request,
            []
        );
    }

    /**
     * Show allowance with relationships.
     */
    public function showWith(Request $request)
    {
        return $this->commonShow(
            Allowance::class,
            $request,
            [
                'branch'
            ]
        );
    }

    /**
     * Toggle allowance status.
     */
    public function status(Request $request)
    {
        return $this->toggleStatus(
            Allowance::class,
            $request
        );
    }

    /**
     * Soft delete allowance.
     */
    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            Allowance::class,
            $request
        );
    }

    /**
     * Trashed allowances.
     */
    public function trash()
    {
        return $this->commonTrash(
            Allowance::class
        );
    }

    /**
     * Restore allowance.
     */
    public function restore(Request $request)
    {
        return $this->commonRestore(
            Allowance::class,
            $request
        );
    }

    /**
     * Permanently delete allowance.
     */
    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            Allowance::class,
            $request
        );
    }
}
