<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmployeeLeaveAssignment extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPENDED = 2;
    const STATUS_EXPIRED = 3;
    const STATUS_CANCELLED = 4;


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
        'leave_policy_id',

        'assignment_number',

        'effective_from',
        'effective_to',

        'annual_entitlement',
        'monthly_entitlement',

        'allow_carry_forward',
        'carry_forward_limit',

        'allow_encashment',
        'encashment_limit',

        'allow_negative_balance',
        'negative_balance_limit',

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

        'annual_entitlement' => 'decimal:2',
        'monthly_entitlement' => 'decimal:2',

        'allow_carry_forward' => 'boolean',
        'carry_forward_limit' => 'decimal:2',

        'allow_encashment' => 'boolean',
        'encashment_limit' => 'decimal:2',

        'allow_negative_balance' => 'boolean',
        'negative_balance_limit' => 'decimal:2',

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
        return $this->belongsTo(
            Employee::class
        );
    }

    public function leavePolicy()
    {
        return $this->belongsTo(
            LeavePolicy::class
        );
    }

    public function approvedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'approved_by'
        );
    }
}