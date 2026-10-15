<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Branch;
use App\Models\Payroll\Department;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    use CommonCrudOperations;


    public function index()
    {
        return view("School.Pages.Payroll.PayrollMaster.add_branch");
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'                 => 'nullable|exists:branches,id',

            'branch_code'        => 'required|string|max:30',
            'branch_name'        => 'required|string|max:150',
            'display_name'       => 'nullable|string|max:150',

            'email'              => 'nullable|email|max:255',
            'phone'              => 'nullable|string|max:20',
            'alternate_phone'    => 'nullable|string|max:20',

            'country'            => 'nullable|string|max:100',
            'state'              => 'nullable|string|max:100',
            'district'           => 'nullable|string|max:100',
            'city'               => 'nullable|string|max:100',
            'area'               => 'nullable|string|max:150',
            'pincode'             => 'nullable|string|max:10',
            'address'            => 'nullable|string',

            'latitude'           => 'nullable|numeric|between:-90,90',
            'longitude'          => 'nullable|numeric|between:-180,180',

            'branch_head_id'     => 'nullable|integer',

            'office_start_time'  => 'nullable|date_format:H:i',
            'office_end_time'    => 'nullable|date_format:H:i',

            'opening_date'       => 'nullable|date',

            'logo'               => 'nullable|string|max:255',
            'cover_image'        => 'nullable|string|max:255',

            'gst_number'         => 'nullable|string|max:20',
            'registration_number' => 'nullable|string|max:255',
            'affiliation_number' => 'nullable|string|max:255',

            'is_head_office'     => 'nullable|boolean',
            'is_active'          => 'nullable|boolean',

            'description'        => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $branch = $request->filled('id')
                ? Branch::findOrFail($request->id)
                : new Branch();

            /*
             * School / Tenant
             *
             * Agar aapke project me tenantSchoolId() available hai
             * to current school automatically assign hogi.
             */
            $branch->school_id = $branch->exists
                ? $branch->school_id
                : tenantSchoolId();

            // Basic Information
            $branch->branch_code   = $request->branch_code;
            $branch->branch_name   = $request->branch_name;
            $branch->display_name  = $request->display_name;

            // Contact
            $branch->email         = $request->email;
            $branch->phone         = $request->phone;
            $branch->alternate_phone = $request->alternate_phone;

            // Address
            $branch->country       = $request->country ?? 'India';
            $branch->state         = $request->state;
            $branch->district      = $request->district;
            $branch->city          = $request->city;
            $branch->area          = $request->area;
            $branch->pincode       = $request->pincode;
            $branch->address       = $request->address;

            // GPS
            $branch->latitude      = $request->latitude;
            $branch->longitude     = $request->longitude;

            // Branch Head
            $branch->branch_head_id = $request->branch_head_id;

            // Office Timing
            $branch->office_start_time = $request->office_start_time;
            $branch->office_end_time   = $request->office_end_time;

            // Academic
            $branch->opening_date  = $request->opening_date;

            // Images
            $branch->logo          = $request->logo;
            $branch->cover_image   = $request->cover_image;

            // Registration
            $branch->gst_number          = $request->gst_number;
            $branch->registration_number = $request->registration_number;
            $branch->affiliation_number  = $request->affiliation_number;

            // Status
            $branch->is_head_office = $request->has('is_head_office')
                ? (bool) $request->is_head_office
                : false;

            $branch->is_active = $request->has('is_active')
                ? (bool) $request->is_active
                : true;

            // Description
            $branch->description = $request->description;

            // Audit
            if (!$branch->exists) {
                $branch->created_by = loginId();
            }

            $branch->updated_by = loginId();

            $branch->save();

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $branch->wasRecentlyCreated
                    ? 'Branch added successfully.'
                    : 'Branch updated successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch branches.
     */
    public function fetch()
    {
        return $this->commonFetch(
            Branch::class,
        );
    }

    /**
     * Fetch all departments for this branch
     */

    public function getDepartments()
    {
        // dd(request()->branch_id);
        return $this->commonFetch(
            Department::class,
            ['branch'],
            ['branch_id' => request()->branch_id]
        );
    }


    /**
     * Fetch branches with relationships.
     */
    public function fetchWith()
    {
        return $this->commonFetch(
            Branch::class,
            ['branchHead']
        );
    }

    /**
     * Show branch.
     */
    public function show(Request $request)
    {
        return $this->commonShow(
            Branch::class,
            $request,
            []
        );
    }

    /**
     * Show branch with relationships.
     */
    public function showWith(Request $request)
    {
        return $this->commonShow(
            Branch::class,
            $request,
            ['branchHead']
        );
    }

    /**
     * Toggle branch status.
     */
    public function status(Request $request)
    {
        return $this->toggleStatus(
            Branch::class,
            $request
        );
    }

    /**
     * Soft delete branch.
     */
    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            Branch::class,
            $request
        );
    }

    /**
     * Trashed branches.
     */
    public function trash()
    {
        return $this->commonTrash(
            Branch::class
        );
    }

    /**
     * Restore branch.
     */
    public function restore(Request $request)
    {
        return $this->commonRestore(
            Branch::class,
            $request
        );
    }

    /**
     * Permanently delete branch.
     */
    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            Branch::class,
            $request
        );
    }
}
