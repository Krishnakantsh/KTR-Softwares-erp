<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Department;
use App\Models\Payroll\Designation;
use App\Services\TaskService;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    use CommonCrudOperations;


    public function index()
    {
        return view("School.Pages.Payroll.PayrollMaster.add_department");
    }


    public function store(Request $request)
    {
        $request->validate([

            'id' => 'nullable|exists:departments,id',

            'branch_id' => [
                'nullable',
                'exists:branches,id',
            ],

            'department_name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('departments', 'department_name')
                    ->where(function ($query) use ($request) {
                        return $query->where('branch_id', $request->branch_id);
                    })
                    ->ignore($request->id),
            ],

            'department_code' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('departments', 'department_code')
                    ->where(function ($query) use ($request) {
                        return $query->where('branch_id', $request->branch_id);
                    })
                    ->ignore($request->id),
            ],

            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',

            'department_head_id' => 'nullable|integer',

            'description' => 'nullable|string',

            'status' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $department = $request->filled('id')
                ? Department::findOrFail($request->id)
                : new Department();

            $department->school_id = $department->exists
                ? $department->school_id
                : tenantSchoolId();

            // Branch
            $department->branch_id = $request->branch_id;

            // Basic Information
            $department->department_name = $request->department_name;
            $department->department_code = $request->department_code;

            // Contact
            $department->email = $request->email;
            $department->phone = $request->phone;

            // Department Head
            $department->department_head_id = $request->department_head_id;

            // Description
            $department->description = $request->description;

            // Status
            $department->status = $request->has('status')
                ? (bool) $request->status
                : true;

            // Audit
            if (!$department->exists) {
                $department->created_by = loginId();
            }

            $department->updated_by = loginId();

            $department->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $department->wasRecentlyCreated
                    ? 'Department added successfully.'
                    : 'Department updated successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    // public function store(Request $request)
    // {
    //     return TaskService::addUpdateDepartMent($request);
    // }
    
    public function fetch()
    {
        return $this->commonFetch(
            Department::class,
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            Department::class,
            [
                'branch'
            ]
        );
    }

    public function get_designations(Request $request)
    {
        $departmentIds = $request->input('department_id');

        if (!is_array($departmentIds)) {
            $departmentIds = explode(',', $departmentIds);
        }

        $departmentIds = array_filter($departmentIds);

        $query = Designation::query();

        if (!empty($departmentIds)) {
            $query->whereIn('department_id', $departmentIds);
        }

        $designations = $query->get();

        return response()->json([
            'status' => true,
            'data'   => $designations
        ]);
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            Department::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            Department::class,
            $request,
            [
                'branch',
                'departmentHead',
            ]
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            Department::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            Department::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            Department::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            Department::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            Department::class,
            $request
        );
    }
}
