<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

/**
 * EmployeeOvertime
 *
 * PURPOSE:
 * ----------
 * This model stores the actual overtime earned by an employee.
 *
 * OvertimeRule = Policy / Configuration
 *
 * EmployeeOvertime = Actual Employee Transaction
 *
 * Example:
 *
 * Rahul worked 90 extra minutes on 11-Aug.
 *
 * The overtime rule decides:
 *
 * - minimum eligible minutes
 * - rounding
 * - multiplier
 * - working-day / holiday rate
 *
 * This model stores the final result:
 *
 * Actual OT       = 90 minutes
 * Eligible OT     = 90 minutes
 * Approved OT     = 90 minutes
 * Hourly Rate      = ₹200
 * Multiplier       = 1.5x
 * OT Rate          = ₹300
 * Payable Amount   = ₹450
 *
 * Payroll will consume approved overtime records.
 */
class EmployeeOvertime extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Day Type
    |--------------------------------------------------------------------------
    */

    const DAY_WORKING = 1;
    const DAY_WEEKLY_OFF = 2;
    const DAY_HOLIDAY = 3;


    /*
    |--------------------------------------------------------------------------
    | Approval Status
    |--------------------------------------------------------------------------
    */

    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_CANCELLED = 4;


    /*
    |--------------------------------------------------------------------------
    | Source
    |--------------------------------------------------------------------------
    */

    const SOURCE_ATTENDANCE = 1;
    const SOURCE_MANUAL = 2;
    const SOURCE_REGULARIZATION = 3;
    const SOURCE_IMPORT = 4;


    protected $fillable = [

        'employee_id',

        'employee_attendance_id',

        'overtime_rule_id',

        'overtime_date',

        'day_type',

        'overtime_start',
        'overtime_end',

        'actual_overtime_minutes',
        'eligible_overtime_minutes',
        'approved_overtime_minutes',

        'hourly_rate',

        'overtime_multiplier',

        'overtime_rate',

        'calculated_amount',
        'approved_amount',

        'approval_required',

        'approval_status',

        'approved_by',
        'approved_at',
        'approval_remarks',

        'rejected_by',
        'rejected_at',
        'rejection_reason',

        'is_payroll_processed',

        'payroll_id',

        'payroll_processed_at',

        'source',

        'remarks',
    ];


    protected $casts = [

        'overtime_date' => 'date',

        'overtime_start' => 'datetime',
        'overtime_end' => 'datetime',

        'day_type' => 'integer',

        'actual_overtime_minutes' => 'integer',
        'eligible_overtime_minutes' => 'integer',
        'approved_overtime_minutes' => 'integer',

        'hourly_rate' => 'decimal:2',

        'overtime_multiplier' => 'decimal:2',

        'overtime_rate' => 'decimal:2',

        'calculated_amount' => 'decimal:2',
        'approved_amount' => 'decimal:2',

        'approval_required' => 'boolean',

        'approval_status' => 'integer',

        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',

        'is_payroll_processed' => 'boolean',

        'payroll_id' => 'integer',

        'payroll_processed_at' => 'datetime',

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

    public function overtimeRule()
    {
        return $this->belongsTo(
            OvertimeRule::class
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
}