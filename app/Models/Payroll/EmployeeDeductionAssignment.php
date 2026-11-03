<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmployeeDeductionAssignment extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Recovery Mode
    |--------------------------------------------------------------------------
    */

    const RECOVERY_MONTHLY = 1;
    const RECOVERY_WEEKLY = 2;
    const RECOVERY_DAILY = 3;
    const RECOVERY_ONE_TIME = 4;


    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    const STATUS_ACTIVE = 1;
    const STATUS_PAUSED = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;
    const STATUS_EXPIRED = 5;


    /*
    |--------------------------------------------------------------------------
    | Approval
    |--------------------------------------------------------------------------
    */

    const APPROVAL_DRAFT = 1;
    const APPROVAL_PENDING = 2;
    const APPROVAL_APPROVED = 3;
    const APPROVAL_REJECTED = 4;


    protected $fillable = [

        'employee_id',
        'deduction_id',

        'assignment_number',

        'effective_from',
        'effective_to',

        'fixed_amount',
        'percentage',
        'formula',

        'total_amount',
        'recovered_amount',
        'remaining_amount',

        'installment_amount',

        'total_installments',
        'completed_installments',
        'remaining_installments',

        'recovery_mode',

        'first_recovery_date',
        'last_recovery_date',

        'priority',

        'status',

        'approval_status',

        'approved_by',
        'approved_at',
        'approval_remarks',

        'remarks',
    ];


    protected $casts = [

        'effective_from' => 'date',
        'effective_to' => 'date',

        'fixed_amount' => 'decimal:2',
        'percentage' => 'decimal:4',

        'total_amount' => 'decimal:2',
        'recovered_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',

        'installment_amount' => 'decimal:2',

        'total_installments' => 'integer',
        'completed_installments' => 'integer',
        'remaining_installments' => 'integer',

        'recovery_mode' => 'integer',

        'first_recovery_date' => 'date',
        'last_recovery_date' => 'date',

        'priority' => 'integer',

        'status' => 'integer',
        'approval_status' => 'integer',

        'approved_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function deduction()
    {
        return $this->belongsTo(Deduction::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'approved_by'
        );
    }
}