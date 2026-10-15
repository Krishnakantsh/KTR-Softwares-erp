<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class AttendanceRegularization extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Regularization Types
    |--------------------------------------------------------------------------
    */

    const TYPE_MISSING_IN = 1;
    const TYPE_MISSING_OUT = 2;
    const TYPE_WRONG_IN = 3;
    const TYPE_WRONG_OUT = 4;
    const TYPE_FULL_DAY_PRESENT = 5;
    const TYPE_HALF_DAY = 6;
    const TYPE_ABSENT_TO_PRESENT = 7;
    const TYPE_PRESENT_TO_LEAVE = 8;
    const TYPE_PRESENT_TO_WFH = 9;
    const TYPE_PRESENT_TO_ON_DUTY = 10;
    const TYPE_OVERTIME_CORRECTION = 11;
    const TYPE_LATE_CORRECTION = 12;
    const TYPE_EARLY_EXIT_CORRECTION = 13;
    const TYPE_OTHER = 14;


    /*
    |--------------------------------------------------------------------------
    | Approval Status
    |--------------------------------------------------------------------------
    */

    const STATUS_DRAFT = 1;
    const STATUS_PENDING = 2;
    const STATUS_APPROVED = 3;
    const STATUS_REJECTED = 4;
    const STATUS_CANCELLED = 5;


    /*
    |--------------------------------------------------------------------------
    | Source
    |--------------------------------------------------------------------------
    */

    const SOURCE_EMPLOYEE = 1;
    const SOURCE_MANAGER = 2;
    const SOURCE_HR = 3;
    const SOURCE_ADMIN = 4;
    const SOURCE_SYSTEM = 5;


    protected $fillable = [

        'request_number',

        'employee_id',

        'employee_attendance_id',

        'attendance_date',

        'regularization_type',

        'requested_in',
        'requested_out',

        'existing_in',
        'existing_out',

        'requested_status',

        'requested_overtime_minutes',

        'reason',

        'attachment',
        'attachment_name',

        'applied_at',

        'approval_status',

        'approved_by',
        'approved_at',
        'approval_remarks',

        'rejected_by',
        'rejected_at',
        'rejection_reason',

        'cancelled_by',
        'cancelled_at',
        'cancellation_reason',

        'is_processed',
        'processed_at',

        'source',
    ];


    protected $casts = [

        'attendance_date' => 'date',

        'requested_in' => 'datetime',
        'requested_out' => 'datetime',

        'existing_in' => 'datetime',
        'existing_out' => 'datetime',

        'regularization_type' => 'integer',

        'requested_status' => 'integer',

        'requested_overtime_minutes' => 'integer',

        'applied_at' => 'datetime',

        'approval_status' => 'integer',

        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'cancelled_at' => 'datetime',

        'is_processed' => 'boolean',

        'processed_at' => 'datetime',

        'source' => 'integer',
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

    public function attendance()
    {
        return $this->belongsTo(
            EmployeeAttendance::class,
            'employee_attendance_id'
        );
    }

    public function approvedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'approved_by'
        );
    }

    public function rejectedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'rejected_by'
        );
    }

    public function cancelledBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'cancelled_by'
        );
    }
}