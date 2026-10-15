<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmployeeAttendance extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Attendance Status
    |--------------------------------------------------------------------------
    */

    const STATUS_PRESENT = 1;
    const STATUS_ABSENT = 2;
    const STATUS_HALF_DAY = 3;
    const STATUS_PAID_LEAVE = 4;
    const STATUS_UNPAID_LEAVE = 5;
    const STATUS_HOLIDAY = 6;
    const STATUS_WEEKLY_OFF = 7;
    const STATUS_WORK_FROM_HOME = 8;
    const STATUS_ON_DUTY = 9;
    const STATUS_COMP_OFF = 10;
    const STATUS_LATE = 11;
    const STATUS_EARLY_EXIT = 12;


    /*
    |--------------------------------------------------------------------------
    | Source
    |--------------------------------------------------------------------------
    */

    const SOURCE_BIOMETRIC = 1;
    const SOURCE_MANUAL = 2;
    const SOURCE_MOBILE = 3;
    const SOURCE_WEB = 4;
    const SOURCE_IMPORT = 5;
    const SOURCE_API = 6;


    /*
    |--------------------------------------------------------------------------
    | Processing Status
    |--------------------------------------------------------------------------
    */

    const PROCESSING_RAW = 1;
    const PROCESSING_PROCESSED = 2;
    const PROCESSING_APPROVED = 3;
    const PROCESSING_LOCKED = 4;


    protected $table='employee_attendance';


    protected $fillable = [

        'employee_id',

        'school_id',
        'branch_id',

        'shift_id',
        'employee_shift_assignment_id',

        'attendance_date',

        'attendance_status',

        'first_in',
        'last_out',

        'total_punches',

        'first_punch_at',
        'last_punch_at',

        'scheduled_minutes',
        'worked_minutes',
        'break_minutes',
        'short_minutes',

        'late_minutes',
        'early_exit_minutes',

        'overtime_minutes',
        'approved_overtime_minutes',

        'present_days',
        'paid_leave_days',
        'unpaid_leave_days',
        'lop_days',

        'grace_minutes',

        'is_late',
        'is_early_exit',
        'is_overtime',

        'source',

        'processing_status',
        'processed_at',

        'approved_by',
        'approved_at',

        'is_regularized',
        'regularized_by',
        'regularized_at',
        'regularization_reason',

        'remarks',
    ];


    protected $casts = [

        'attendance_date' => 'date',

        'first_in' => 'datetime',
        'last_out' => 'datetime',

        'first_punch_at' => 'datetime',
        'last_punch_at' => 'datetime',

        'total_punches' => 'integer',

        'scheduled_minutes' => 'integer',
        'worked_minutes' => 'integer',
        'break_minutes' => 'integer',
        'short_minutes' => 'integer',

        'late_minutes' => 'integer',
        'early_exit_minutes' => 'integer',

        'overtime_minutes' => 'integer',
        'approved_overtime_minutes' => 'integer',

        'present_days' => 'decimal:2',
        'paid_leave_days' => 'decimal:2',
        'unpaid_leave_days' => 'decimal:2',
        'lop_days' => 'decimal:2',

        'grace_minutes' => 'integer',

        'is_late' => 'boolean',
        'is_early_exit' => 'boolean',
        'is_overtime' => 'boolean',

        'source' => 'integer',

        'processing_status' => 'integer',

        'processed_at' => 'datetime',

        'approved_at' => 'datetime',

        'is_regularized' => 'boolean',

        'regularized_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function employee()
    {
        return $this->belongsTo(
            Employee::class
        );
    }

    public function school()
    {
        return $this->belongsTo(
            \App\Models\School::class
        );
    }

    public function branch()
    {
        return $this->belongsTo(
            Branch::class
        );
    }

    public function shift()
    {
        return $this->belongsTo(
            Shift::class
        );
    }

    public function shiftAssignment()
    {
        return $this->belongsTo(
            EmployeeShiftAssignment::class,
            'employee_shift_assignment_id'
        );
    }

    public function approvedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'approved_by'
        );
    }

    public function regularizedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'regularized_by'
        );
    }
}