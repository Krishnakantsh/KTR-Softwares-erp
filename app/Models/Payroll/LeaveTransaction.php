<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class LeaveTransaction extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Transaction Types
    |--------------------------------------------------------------------------
    */

    const TYPE_OPENING = 1;
    const TYPE_ACCRUAL = 2;
    const TYPE_CARRY_FORWARD = 3;
    const TYPE_LEAVE_USED = 4;
    const TYPE_LEAVE_REVERSAL = 5;
    const TYPE_ADJUSTMENT_CREDIT = 6;
    const TYPE_ADJUSTMENT_DEBIT = 7;
    const TYPE_ENCASHMENT = 8;
    const TYPE_EXPIRY = 9;
    const TYPE_LOP = 10;
    const TYPE_TRANSFER_IN = 11;
    const TYPE_TRANSFER_OUT = 12;
    const TYPE_CORRECTION = 13;


    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    const STATUS_POSTED = 1;
    const STATUS_REVERSED = 2;
    const STATUS_CANCELLED = 3;


    protected $fillable = [

        'transaction_number',

        'employee_id',
        'leave_type_id',

        'employee_leave_assignment_id',
        'leave_balance_id',
        'leave_application_id',

        'transaction_date',

        'transaction_type',

        'quantity',

        'balance_before',
        'balance_after',

        'credit',
        'debit',

        'reference_type',
        'reference_id',

        'payroll_id',

        'description',

        'is_system_generated',

        'is_reversal',
        'reversal_of_id',

        'status',
    ];


    protected $casts = [

        'transaction_date' => 'date',

        'transaction_type' => 'integer',

        'quantity' => 'decimal:2',

        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',

        'credit' => 'decimal:2',
        'debit' => 'decimal:2',

        'reference_id' => 'integer',

        'payroll_id' => 'integer',

        'is_system_generated' => 'boolean',

        'is_reversal' => 'boolean',

        'reversal_of_id' => 'integer',

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

    public function leaveBalance()
    {
        return $this->belongsTo(
            LeaveBalance::class
        );
    }

    public function leaveApplication()
    {
        return $this->belongsTo(
            LeaveApplication::class
        );
    }

    public function reversalOf()
    {
        return $this->belongsTo(
            self::class,
            'reversal_of_id'
        );
    }

    public function reversals()
    {
        return $this->hasMany(
            self::class,
            'reversal_of_id'
        );
    }
}