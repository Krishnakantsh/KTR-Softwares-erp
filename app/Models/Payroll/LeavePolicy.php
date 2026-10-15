<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class LeavePolicy extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Accrual Frequency
    |--------------------------------------------------------------------------
    */

    const ACCRUAL_YEARLY = 1;
    const ACCRUAL_MONTHLY = 2;
    const ACCRUAL_QUARTERLY = 3;
    const ACCRUAL_HALF_YEARLY = 4;


    /*
    |--------------------------------------------------------------------------
    | Accrual Method
    |--------------------------------------------------------------------------
    */

    const METHOD_FIXED = 1;
    const METHOD_MONTHLY = 2;
    const METHOD_PRO_RATA = 3;
    const METHOD_JOINING_DATE = 4;


    /*
    |--------------------------------------------------------------------------
    | Carry Forward Expiry
    |--------------------------------------------------------------------------
    */

    const CARRY_NEVER_EXPIRE = 1;
    const CARRY_FINANCIAL_YEAR = 2;
    const CARRY_FIXED_MONTHS = 3;


    /*
    |--------------------------------------------------------------------------
    | Encashment Basis
    |--------------------------------------------------------------------------
    */

    const ENCASH_BASIC = 1;
    const ENCASH_BASIC_DA = 2;
    const ENCASH_GROSS = 3;


    protected $fillable = [

        'school_id',
        'branch_id',

        'leave_type_id',

        'policy_code',
        'policy_name',
        'description',

        'effective_from',
        'effective_to',

        'annual_entitlement',
        'monthly_entitlement',

        'accrual_frequency',
        'accrual_method',

        'pro_rata_on_joining',
        'pro_rata_on_exit',

        'accrual_day',

        'accrue_during_probation',
        'accrue_during_notice_period',

        'allow_carry_forward',
        'carry_forward_limit',
        'carry_forward_expiry_type',
        'carry_forward_expiry_months',

        'allow_encashment',
        'encashment_limit',
        'encashment_basis',

        'allow_negative_balance',
        'negative_balance_limit',

        'minimum_service_days',
        'maximum_consecutive_days',
        'minimum_notice_days',

        'allow_half_day',
        'allow_hourly',

        'count_weekends',
        'count_holidays',

        'sandwich_rule',

        'convert_excess_to_lop',

        'applicable_to_all_employees',

        'is_active',

        'remarks',
    ];


    protected $casts = [

        'effective_from' => 'date',
        'effective_to' => 'date',

        'annual_entitlement' => 'decimal:2',
        'monthly_entitlement' => 'decimal:2',

        'accrual_frequency' => 'integer',
        'accrual_method' => 'integer',

        'pro_rata_on_joining' => 'boolean',
        'pro_rata_on_exit' => 'boolean',

        'accrual_day' => 'integer',

        'accrue_during_probation' => 'boolean',
        'accrue_during_notice_period' => 'boolean',

        'allow_carry_forward' => 'boolean',
        'carry_forward_limit' => 'decimal:2',

        'carry_forward_expiry_type' => 'integer',
        'carry_forward_expiry_months' => 'integer',

        'allow_encashment' => 'boolean',
        'encashment_limit' => 'decimal:2',

        'encashment_basis' => 'integer',

        'allow_negative_balance' => 'boolean',
        'negative_balance_limit' => 'decimal:2',

        'minimum_service_days' => 'integer',
        'maximum_consecutive_days' => 'integer',
        'minimum_notice_days' => 'integer',

        'allow_half_day' => 'boolean',
        'allow_hourly' => 'boolean',

        'count_weekends' => 'boolean',
        'count_holidays' => 'boolean',

        'sandwich_rule' => 'boolean',

        'convert_excess_to_lop' => 'boolean',

        'applicable_to_all_employees' => 'boolean',

        'is_active' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function school()
    {
        return $this->belongsTo(
            \App\Models\School::class
        );
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}