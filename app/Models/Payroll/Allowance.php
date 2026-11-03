<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class Allowance extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Effect Types
    |--------------------------------------------------------------------------
    */

    const EFFECT_EARNING = 1;
    const EFFECT_DEDUCTION = 2;


    /*
    |--------------------------------------------------------------------------
    | Calculation Types
    |--------------------------------------------------------------------------
    */

    const CALCULATION_FIXED = 1;
    const CALCULATION_PERCENTAGE = 2;


    /*
    |--------------------------------------------------------------------------
    | Percentage Base
    |--------------------------------------------------------------------------
    */

    const PERCENTAGE_ON_BASIC = 1;
    const PERCENTAGE_ON_GROSS = 2;
    const PERCENTAGE_ON_BASIC_DA = 3;
    const PERCENTAGE_ON_CUSTOM = 4;


    protected $fillable = [

        'school_id',
        'branch_id',

        'allowance_name',
        'allowance_code',

        'effect_type',

        'calculation_type',

        'default_amount',
        'default_percentage',

        'percentage_on',

        'is_taxable',
        'is_pf_applicable',
        'is_esic_applicable',

        'is_prorated',
        'is_overtime_applicable',

        'status',

        'description',
    ];


    protected $casts = [

        'effect_type' => 'integer',

        'calculation_type' => 'integer',

        'default_amount' => 'decimal:2',

        'default_percentage' => 'decimal:4',

        'percentage_on' => 'integer',

        'is_taxable' => 'boolean',

        'is_pf_applicable' => 'boolean',

        'is_esic_applicable' => 'boolean',

        'is_prorated' => 'boolean',

        'is_overtime_applicable' => 'boolean',

        'status' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function school()
    {
        return $this->belongsTo(\App\Models\School::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}