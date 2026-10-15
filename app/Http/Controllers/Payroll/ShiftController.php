<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Shift;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ShiftController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view("School.Pages.Payroll.PayrollMaster.add_shifts");
    }

    public function store(Request $request)
    {
        $request->validate([

            'id' => 'nullable|exists:shifts,id',

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'shift_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('shifts', 'shift_name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    })
                    ->ignore($request->id),
            ],

            'shift_code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('shifts', 'shift_code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    })
                    ->ignore($request->id),
            ],

            // Shift Timing
            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
            ],

            // Overnight
            'is_overnight' => 'nullable|boolean',

            // Break
            'has_break' => 'nullable|boolean',

            'break_start_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'break_end_time' => [
                'nullable',
                'date_format:H:i',
            ],

            // Working Hours
            'working_hours' => [
                'nullable',
                'numeric',
                'min:0',
                'max:24',
            ],

            'break_hours' => [
                'nullable',
                'numeric',
                'min:0',
                'max:24',
            ],

            // Attendance Grace
            'late_grace_minutes' => [
                'nullable',
                'integer',
                'min:0',
                'max:1440',
            ],

            'early_grace_minutes' => [
                'nullable',
                'integer',
                'min:0',
                'max:1440',
            ],

            // Half Day
            'half_day_after_minutes' => [
                'nullable',
                'integer',
                'min:0',
                'max:1440',
            ],

            // Overtime
            'overtime_allowed' => 'nullable|boolean',

            'overtime_after_minutes' => [
                'nullable',
                'integer',
                'min:0',
                'max:1440',
            ],

            // Attendance Rules
            'late_mark_enabled' => 'nullable|boolean',
            'early_out_enabled' => 'nullable|boolean',

            // Status
            'status' => 'nullable|boolean',

            'description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $shift = $request->filled('id')
                ? Shift::findOrFail($request->id)
                : new Shift();

            /*
             * School / Tenant
             */
            $shift->school_id = $shift->exists
                ? $shift->school_id
                : tenantSchoolId();

            /*
             * Branch
             */
            $shift->branch_id = $request->branch_id;

            /*
             * Basic Information
             */
            $shift->shift_name = $request->shift_name;
            $shift->shift_code = $request->shift_code;

            /*
             * Shift Timing
             */
            $shift->start_time = $request->start_time;
            $shift->end_time = $request->end_time;

            /*
             * Overnight
             */
            $shift->is_overnight = $request->has('is_overnight')
                ? (bool) $request->is_overnight
                : false;

            /*
             * Break
             */
            $shift->has_break = $request->has('has_break')
                ? (bool) $request->has_break
                : false;

            $shift->break_start_time = $request->break_start_time;
            $shift->break_end_time = $request->break_end_time;

            /*
             * Working Hours
             */
            $shift->working_hours = $request->working_hours ?? 0;
            $shift->break_hours = $request->break_hours ?? 0;

            /*
             * Attendance Grace
             */
            $shift->late_grace_minutes =
                $request->late_grace_minutes ?? 0;

            $shift->early_grace_minutes =
                $request->early_grace_minutes ?? 0;

            /*
             * Half Day
             */
            $shift->half_day_after_minutes =
                $request->half_day_after_minutes;

            /*
             * Overtime
             */
            $shift->overtime_allowed = $request->has('overtime_allowed')
                ? (bool) $request->overtime_allowed
                : false;

            $shift->overtime_after_minutes =
                $request->overtime_after_minutes ?? 0;

            /*
             * Attendance Rules
             */
            $shift->late_mark_enabled =
                $request->has('late_mark_enabled')
                ? (bool) $request->late_mark_enabled
                : true;

            $shift->early_out_enabled =
                $request->has('early_out_enabled')
                ? (bool) $request->early_out_enabled
                : true;

            /*
             * Status
             */
            $shift->status = $request->has('status')
                ? (bool) $request->status
                : true;

            /*
             * Description
             */
            $shift->description = $request->description;

            /*
             * Audit
             */
            if (!$shift->exists) {
                $shift->created_by = loginId();
            }

            $shift->updated_by = loginId();

            $shift->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $shift->wasRecentlyCreated
                    ? 'Shift added successfully.'
                    : 'Shift updated successfully.',
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
            Shift::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            Shift::class,
            [
                'branch',
            ]
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            Shift::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            Shift::class,
            $request,
            [
                'branch',
            ]
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            Shift::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            Shift::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            Shift::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            Shift::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            Shift::class,
            $request
        );
    }
}
