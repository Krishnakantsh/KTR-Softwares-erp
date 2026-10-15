<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Designation;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DesignationController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view("School.Pages.Payroll/PayrollMaster/add_designation");
    }

    /**
     * Store / Update designation.
     */
    public function store(Request $request)
    {
        $request->validate([

            'id' => 'nullable|exists:designations,id',

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'designation_name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('designations', 'designation_name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'department_id',
                            $request->department_id
                        );
                    })
                    ->ignore($request->id),
            ],

            'designation_code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('designations', 'designation_code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'department_id',
                            $request->department_id
                        );
                    })
                    ->ignore($request->id),
            ],

            'hierarchy_level' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'description' => 'nullable|string',

            'is_teaching_staff' => 'nullable|boolean',

            'status' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $designation = $request->filled('id')
                ? Designation::findOrFail($request->id)
                : new Designation();

            /*
             * School / Tenant
             */
            $designation->school_id = $designation->exists
                ? $designation->school_id
                : tenantSchoolId();

            /*
             * Branch
             */
            $designation->branch_id = $request->branch_id;

            /*
             * Department
             */
            $designation->department_id = $request->department_id;

            /*
             * Basic Information
             */
            $designation->designation_name = $request->designation_name;
            $designation->designation_code = $request->designation_code;

            /*
             * Hierarchy
             */
            $designation->hierarchy_level = $request->hierarchy_level ?? 1;

            /*
             * Description
             */
            $designation->description = $request->description;

            /*
             * Staff Type
             */
            $designation->is_teaching_staff = $request->has('is_teaching_staff')
                ? (bool) $request->is_teaching_staff
                : false;

            /*
             * Status
             */
            $designation->status = $request->has('status')
                ? (bool) $request->status
                : true;

            /*
             * Audit
             */
            if (!$designation->exists) {
                $designation->created_by = loginId();
            }

            $designation->updated_by = loginId();

            $designation->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $designation->wasRecentlyCreated
                    ? 'Designation added successfully.'
                    : 'Designation updated successfully.',
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
     * Fetch designations.
     */
    public function fetch()
    {
        return $this->commonFetch(
            Designation::class,
            []
        );
    }

    /**
     * Fetch designations with relationships.
     */
    public function fetchWith()
    {
        return $this->commonFetch(
            Designation::class,
            [
                'branch',
                'department',
            ]
        );
    }

    /**
     * Show designation.
     */
    public function show(Request $request)
    {
        return $this->commonShow(
            Designation::class,
            $request,
            []
        );
    }

    /**
     * Show designation with relationships.
     */
    public function showWith(Request $request)
    {
        return $this->commonShow(
            Designation::class,
            $request,
            [
                'branch',
                'department',
            ]
        );
    }

    /**
     * Toggle designation status.
     */
    public function status(Request $request)
    {
        return $this->toggleStatus(
            Designation::class,
            $request
        );
    }

    /**
     * Soft delete designation.
     */
    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            Designation::class,
            $request
        );
    }

    /**
     * Trashed designations.
     */
    public function trash()
    {
        return $this->commonTrash(
            Designation::class
        );
    }

    /**
     * Restore designation.
     */
    public function restore(Request $request)
    {
        return $this->commonRestore(
            Designation::class,
            $request
        );
    }

    /**
     * Permanently delete designation.
     */
    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            Designation::class,
            $request
        );
    }
}
