<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\EmploymentType;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EmploymentTypeController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('School.Pages.Payroll.PayrollMaster.employment_types');
    }

    public function store(Request $request)
    {
        $request->validate([

            'id' => 'nullable|exists:employment_types,id',

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'employment_type_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('employment_types', 'employment_type_name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    })
                    ->ignore($request->id),
            ],

            'employment_type_code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('employment_types', 'employment_type_code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    })
                    ->ignore($request->id),
            ],

            'description' => 'nullable|string',

            'status' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $employmentType = $request->filled('id')
                ? EmploymentType::findOrFail($request->id)
                : new EmploymentType();

            $employmentType->school_id = $employmentType->exists
                ? $employmentType->school_id
                : tenantSchoolId();

            $employmentType->branch_id = $request->branch_id;

            $employmentType->employment_type_name =
                $request->employment_type_name;

            $employmentType->employment_type_code =
                $request->employment_type_code;

            $employmentType->description =
                $request->description;

            $employmentType->status = $request->has('status')
                ? (bool) $request->status
                : true;

            if (!$employmentType->exists) {
                $employmentType->created_by =  loginId();
            }

            $employmentType->updated_by =  loginId();

            $employmentType->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $employmentType->wasRecentlyCreated
                    ? 'Employment type added successfully.'
                    : 'Employment type updated successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function fetch()
    {
        return $this->commonFetch(
            EmploymentType::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            EmploymentType::class,
            [
                'branch',
            ]
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            EmploymentType::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            EmploymentType::class,
            $request,
            [
                'branch',
            ]
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            EmploymentType::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            EmploymentType::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            EmploymentType::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            EmploymentType::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            EmploymentType::class,
            $request
        );
    }
}
