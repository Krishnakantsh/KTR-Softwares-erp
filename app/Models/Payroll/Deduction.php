<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class Deduction extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Deduction Types
    |--------------------------------------------------------------------------
    */

    const TYPE_STATUTORY = 1;
    const TYPE_LOAN = 2;
    const TYPE_ADVANCE = 3;
    const TYPE_ATTENDANCE = 4;
    const TYPE_TAX = 5;
    const TYPE_OTHER = 6;


    /*
    |--------------------------------------------------------------------------
    | Calculation Types
    |--------------------------------------------------------------------------
    */

    const CALC_FIXED = 1;
    const CALC_PERCENTAGE = 2;
    const CALC_FORMULA = 3;
    const CALC_SLAB = 4;


    /*
    |--------------------------------------------------------------------------
    | Calculation Bases
    |--------------------------------------------------------------------------
    */

    const BASE_BASIC = 1;
    const BASE_GROSS = 2;
    const BASE_BASIC_DA = 3;
    const BASE_CTC = 4;
    const BASE_NET_SALARY = 5;
    const BASE_CUSTOM = 6;


    /*
    |--------------------------------------------------------------------------
    | Frequency
    |--------------------------------------------------------------------------
    */

    const FREQUENCY_MONTHLY = 1;
    const FREQUENCY_WEEKLY = 2;
    const FREQUENCY_DAILY = 3;
    const FREQUENCY_ONE_TIME = 4;


    protected $fillable = [

        'school_id',
        'branch_id',

        'deduction_code',
        'deduction_name',
        'description',

        'deduction_type',

        'calculation_type',
        'calculation_base',

        'amount',
        'percentage',
        'formula',

        'is_statutory',
        'statutory_code',

        'is_pre_tax',
        'is_post_tax',

        'affects_net_salary',

        'is_proratable',
        'is_affected_by_lop',

        'minimum_amount',
        'maximum_amount',

        'frequency',

        'is_active',

        'remarks',
    ];


    protected $casts = [

        'deduction_type' => 'integer',

        'calculation_type' => 'integer',

        'calculation_base' => 'integer',

        'amount' => 'decimal:2',

        'percentage' => 'decimal:4',

        'minimum_amount' => 'decimal:2',

        'maximum_amount' => 'decimal:2',

        'is_statutory' => 'boolean',

        'is_pre_tax' => 'boolean',

        'is_post_tax' => 'boolean',

        'affects_net_salary' => 'boolean',

        'is_proratable' => 'boolean',

        'is_affected_by_lop' => 'boolean',

        'frequency' => 'integer',

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
}