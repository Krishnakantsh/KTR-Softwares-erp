<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Employee;
use App\Models\Payroll\EmployeeAttendance;
use App\Traits\CommonCrudOperations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeAttendanceController extends Controller
{

    use CommonCrudOperations;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('School/Pages/Payroll/PayrollMaster/employee_attendance');
    }

    public function fetch(Request $request)
    {
        $departmentIds  = $request->input('department_id', []);
        $designationIds = $request->input('designation_id', []);
        $date           = $request->input('attendance_date');

        $query = Employee::query()
            ->where('status', true)
            ->whereHas('staffEmploymentDetails', function ($q) use ($departmentIds, $designationIds) {
                if (!empty($departmentIds)) {
                    $q->whereIn('department_id', $departmentIds);
                }
                if (!empty($designationIds)) {
                    $q->whereIn('designation_id', $designationIds);
                }
            });

        $query->with(['staffEmploymentDetails' => function ($q) {
            $q->select('id', 'employee_id', 'department_id', 'designation_id', 'employee_code', 'employment_status');
        }]);

        $query->with(['attendance' => function ($q) use ($date) {
            $q->where('attendance_date', $date);
        }]);

        $staff = $query->get();

        // print_r($staff);
        // exit;

        $result = $staff->map(function ($employee) {
            $attendance = $employee->attendance->first();

            // dd($attendance);

            return [
                'employee_id'     => $employee->id,
                'name'            => $employee->display_name
                    ?: trim($employee->first_name . ' ' . $employee->last_name),
                'employee_code'   => $employee->staffEmploymentDetails->employee_code ?? null,
                'department_id'   => $employee->staffEmploymentDetails->department_id ?? null,
                'designation_id'  => $employee->staffEmploymentDetails->designation_id ?? null,
                'has_attendance'  => (bool) $attendance,
                'attendance'      => $attendance ? [
                    'id'              => $attendance->id,
                    'status'          => $attendance->attendance_status,
                    'first_in'        => $attendance->first_in,
                    'last_out'        => $attendance->last_out,
                    'worked_minutes'  => $attendance->worked_minutes,
                    'is_regularized'  => $attendance->is_regularized,
                ] : null,
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'attendance_date' => ['required', 'date'],
            'attendance' => ['required', 'array'],
            'attendance.*' => ['required', 'in:P,A,H,ML'],
        ]);

        DB::beginTransaction();

        try {

            $date = $request->input('attendance_date');
            $attendanceData = $request->input('attendance');

            foreach ($attendanceData as $employeeId => $status) {

                $employee = Employee::with('staffEmploymentDetails')
                    ->where('id', $employeeId)
                    ->where('status', true)
                    ->first();

                if (!$employee) {
                    continue;
                }

                $employment = $employee->staffEmploymentDetails
                    ->where('status', true)
                    ->first();

                if (!$employment) {
                    continue;
                }

                switch ($status) {

                    case 'P':
                        $attendanceStatus = EmployeeAttendance::STATUS_PRESENT;
                        $presentDays = 1;
                        $paidLeaveDays = 0;
                        $unpaidLeaveDays = 0;
                        $lopDays = 0;
                        break;

                    case 'A':
                        $attendanceStatus = EmployeeAttendance::STATUS_ABSENT;
                        $presentDays = 0;
                        $paidLeaveDays = 0;
                        $unpaidLeaveDays = 0;
                        $lopDays = 1;
                        break;

                    case 'H':
                        $attendanceStatus = EmployeeAttendance::STATUS_HALF_DAY;
                        $presentDays = 0.5;
                        $paidLeaveDays = 0;
                        $unpaidLeaveDays = 0;
                        $lopDays = 0.5;
                        break;

                    case 'ML':
                        $attendanceStatus = EmployeeAttendance::STATUS_PAID_LEAVE;
                        $presentDays = 1;
                        $paidLeaveDays = 0;
                        $unpaidLeaveDays = 0;
                        $lopDays = 0;
                        break;

                    default:
                        continue 2;
                }

                EmployeeAttendance::updateOrCreate(
                    [
                        'employee_id' => $employee->id,
                        'attendance_date' => $date,
                    ],
                    [
                        'school_id' => $employment->school_id,
                        'branch_id' => $employment->branch_id,

                        'attendance_status' => $attendanceStatus,

                        'present_days' => $presentDays,
                        'paid_leave_days' => $paidLeaveDays,
                        'unpaid_leave_days' => $unpaidLeaveDays,
                        'lop_days' => $lopDays,

                        'source' => EmployeeAttendance::SOURCE_MANUAL,
                        'processing_status' => EmployeeAttendance::PROCESSING_PROCESSED,

                        'is_late' => false,
                        'is_early_exit' => false,
                        'is_overtime' => false,

                        'is_regularized' => false,

                        'remarks' => 'Manual attendance',
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Attendance saved successfully.'
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to save attendance.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function registered_fetch(Request $request)
    {
        try {
            $month = (int) $request->input('month', now()->month);
            $year  = (int) $request->input('year', now()->year);

            $startOfMonth = Carbon::create($year, $month, 1)
                ->startOfMonth()
                ->toDateString();

            $endOfMonth = Carbon::create($year, $month, 1)
                ->endOfMonth()
                ->toDateString();

            $data = EmployeeAttendance::selectRaw("
                attendance_date,
                COUNT(*) as present_count
            ")
                ->whereBetween('attendance_date', [$startOfMonth, $endOfMonth])
                ->groupBy('attendance_date')
                ->orderBy('attendance_date', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'attendance_date' => Carbon::parse($item->attendance_date)
                            ->format('d M, Y'),
                        'present_count' => (int) $item->present_count,
                    ];
                });

            return response()->json([
                'status' => true,
                'data'   => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong while fetching attendance registry.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    // public function showAttendantStaff(Request $request)
    // {
    //     try {

    //         $date = $request->input('attendance_date');

    //         if (empty($date)) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Attendance date is required.'
    //             ], 422);
    //         }

    //         $attendance = EmployeeAttendance::with([
    //             'employee:id,first_name,middle_name,last_name,display_name'
    //         ])
    //             ->whereDate('attendance_date', $date)
    //             ->get();

    //         $data = $attendance->map(function ($item) {

    //             $employee = $item->employee;

    //             return [
    //                 'employee_id' => $item->employee_id,

    //                 'employee_name' => $employee
    //                     ? ($employee->display_name
    //                         ?: trim(
    //                             $employee->first_name . ' ' .
    //                                 $employee->middle_name . ' ' .
    //                                 $employee->last_name
    //                         ))
    //                     : null,

    //                 'attendance_status' => $item->attendance_status,
    //             ];
    //         });

    //         return response()->json([
    //             'status' => true,
    //             'data' => $data,
    //         ]);
    //     } catch (\Throwable $e) {

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Something went wrong while fetching attendance.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }


    public function showAttendantStaff(Request $request)
    {
        try {

            $date = $request->input('attendance_date');

            if (empty($date)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Attendance date is required.'
                ], 422);
            }

            $date = Carbon::createFromFormat('d M, Y', $date)->format('Y-m-d');

            $attendance = EmployeeAttendance::with([
                'employee:id,first_name,middle_name,last_name,display_name'
            ])
                ->whereDate('attendance_date', $date)
                ->get();

            $data = $attendance->map(function ($item) {

                $employee = $item->employee;

                return [
                    'employee_id' => $item->employee_id,

                    'employee_name' => $employee
                        ? ($employee->display_name
                            ?: trim(
                                $employee->first_name . ' ' .
                                    $employee->middle_name . ' ' .
                                    $employee->last_name
                            ))
                        : null,

                    'attendance_status' => $item->attendance_status,
                ];
            });

            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong while fetching attendance.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update attendance status for a single record (P/A/H/L/ML).
     */
    public function status(Request $request)
    {
        $request->validate([
            'id'     => 'required|exists:employee_attendances,id',
            'status' => 'required|in:P,A,H,L,ML',
        ]);

        $attendance = EmployeeAttendance::findOrFail($request->id);
        $attendance->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Attendance status updated successfully.',
            'data'    => $attendance,
        ]);
    }

    /**
     * Soft delete single attendance record.
     */
    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            EmployeeAttendance::class,
            $request
        );
    }

    /**
     * Delete ALL attendance records for a given date.
     * (Registry table ke delete button ke liye — data-id = attendance_date)
     */
    public function destroyByDate(Request $request)
    {
        $request->validate([
            'attendance_date' => 'required|date',
        ]);

        $deletedCount = EmployeeAttendance::where('attendance_date', $request->attendance_date)->delete();

        if ($deletedCount === 0) {
            return response()->json([
                'status'  => false,
                'message' => 'No attendance records found for this date.',
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Attendance for the selected date deleted successfully.',
        ]);
    }

    /**
     * Trashed attendance records.
     */
    public function trash()
    {
        return $this->commonTrash(
            EmployeeAttendance::class
        );
    }

    /**
     * Restore soft-deleted attendance record.
     */
    public function restore(Request $request)
    {
        return $this->commonRestore(
            EmployeeAttendance::class,
            $request
        );
    }

    /**
     * Permanently delete attendance record.
     */
    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            EmployeeAttendance::class,
            $request
        );
    }
}
