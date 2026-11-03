<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class LeaveBalance extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;
    const STATUS_LOCKED = 3;


    protected $fillable = [

        'employee_id',

        'employee_leave_assignment_id',

        'leave_type_id',

        'period_start',
        'period_end',

        'opening_balance',

        'accrued',

        'carried_forward',

        'used',

        'pending',

        'adjustment',

        'encashed',

        'expired',

        'lop_days',

        'closing_balance',

        'negative_balance',

        'last_accrual_date',

        'last_transaction_date',

        'status',
    ];


    protected $casts = [

        'period_start' => 'date',
        'period_end' => 'date',

        'opening_balance' => 'decimal:2',

        'accrued' => 'decimal:2',

        'carried_forward' => 'decimal:2',

        'used' => 'decimal:2',

        'pending' => 'decimal:2',

        'adjustment' => 'decimal:2',

        'encashed' => 'decimal:2',

        'expired' => 'decimal:2',

        'lop_days' => 'decimal:2',

        'closing_balance' => 'decimal:2',

        'negative_balance' => 'decimal:2',

        'last_accrual_date' => 'date',

        'last_transaction_date' => 'date',

        'status' => 'integer',
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

    public function employeeLeaveAssignment()
    {
        return $this->belongsTo(
            EmployeeLeaveAssignment::class
        );
    }

    public function leaveType()
    {
        return $this->belongsTo(
            LeaveType::class
        );
    }
}