<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class LeaveApplication extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Leave Unit
    |--------------------------------------------------------------------------
    */

    const UNIT_FULL_DAY = 1;
    const UNIT_HALF_DAY = 2;
    const UNIT_HOURLY = 3;


    /*
    |--------------------------------------------------------------------------
    | Half Day
    |--------------------------------------------------------------------------
    */

    const HALF_FIRST = 1;
    const HALF_SECOND = 2;


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
    const STATUS_WITHDRAWN = 6;


    protected $fillable = [

        'application_number',

        'employee_id',

        'leave_type_id',

        'employee_leave_assignment_id',

        'from_date',
        'to_date',

        'total_days',
        'total_hours',

        'leave_unit',

        'half_day_type',

        'from_time',
        'to_time',

        'reason',

        'contact_number',
        'contact_address',

        'attachment',
        'attachment_name',

        'is_emergency',

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

        'is_payroll_processed',
        'payroll_processed_at',

        'is_attendance_processed',
        'attendance_processed_at',

        'is_active',

        'remarks',
    ];


    protected $casts = [

        'from_date' => 'date',
        'to_date' => 'date',

        'total_days' => 'decimal:2',
        'total_hours' => 'decimal:2',

        'leave_unit' => 'integer',
        'half_day_type' => 'integer',

        'is_emergency' => 'boolean',

        'applied_at' => 'datetime',

        'approval_status' => 'integer',

        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'cancelled_at' => 'datetime',

        'is_payroll_processed' => 'boolean',
        'payroll_processed_at' => 'datetime',

        'is_attendance_processed' => 'boolean',
        'attendance_processed_at' => 'datetime',

        'is_active' => 'boolean',
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

    public function leaveType()
    {
        return $this->belongsTo(
            LeaveType::class
        );
    }

    public function employeeLeaveAssignment()
    {
        return $this->belongsTo(
            EmployeeLeaveAssignment::class
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