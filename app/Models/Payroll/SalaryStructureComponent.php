<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class SalaryStructureComponent extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Component Type
    |--------------------------------------------------------------------------
    */

    const TYPE_EARNING = 1;
    const TYPE_DEDUCTION = 2;


    /*
    |--------------------------------------------------------------------------
    | Calculation Type
    |--------------------------------------------------------------------------
    */

    const CALC_FIXED = 1;
    const CALC_PERCENTAGE = 2;
    const CALC_FORMULA = 3;


    /*
    |--------------------------------------------------------------------------
    | Calculation Base
    |--------------------------------------------------------------------------
    */

    const BASE_BASIC = 1;
    const BASE_GROSS = 2;
    const BASE_BASIC_DA = 3;
    const BASE_CTC = 4;
    const BASE_NET_SALARY = 5;
    const BASE_WORKING_DAYS = 6;
    const BASE_PRESENT_DAYS = 7;
    const BASE_CUSTOM_COMPONENT = 8;


    /*
    |--------------------------------------------------------------------------
    | Frequency
    |--------------------------------------------------------------------------
    */

    const FREQUENCY_MONTHLY = 1;
    const FREQUENCY_WEEKLY = 2;
    const FREQUENCY_DAILY = 3;
    const FREQUENCY_ONE_TIME = 4;


    /*
    |--------------------------------------------------------------------------
    | Rounding
    |--------------------------------------------------------------------------
    */

    const ROUND_NORMAL = 1;
    const ROUND_UP = 2;
    const ROUND_DOWN = 3;


    protected $fillable = [

        'salary_structure_id',
        'allowance_id',

        'component_code',
        'component_name',

        'component_type',

        'calculation_type',
        'calculation_base',

        'amount',
        'percentage',

        'formula',

        'minimum_amount',
        'maximum_amount',

        'is_taxable',
        'is_part_of_gross',
        'is_part_of_ctc',
        'is_part_of_net_salary',

        'is_pf_applicable',
        'is_esi_applicable',
        'is_pt_applicable',
        'is_tds_applicable',

        'is_proratable',
        'is_affected_by_lop',
        'is_affected_by_attendance',
        'is_eligible_for_arrear',

        'calculation_order',

        'frequency',

        'rounding_method',

        'is_active',

        'remarks',
    ];


    protected $casts = [

        'component_type' => 'integer',

        'calculation_type' => 'integer',

        'calculation_base' => 'integer',

        'amount' => 'decimal:2',

        'percentage' => 'decimal:4',

        'minimum_amount' => 'decimal:2',

        'maximum_amount' => 'decimal:2',

        'is_taxable' => 'boolean',

        'is_part_of_gross' => 'boolean',

        'is_part_of_ctc' => 'boolean',

        'is_part_of_net_salary' => 'boolean',

        'is_pf_applicable' => 'boolean',

        'is_esi_applicable' => 'boolean',

        'is_pt_applicable' => 'boolean',

        'is_tds_applicable' => 'boolean',

        'is_proratable' => 'boolean',

        'is_affected_by_lop' => 'boolean',

        'is_affected_by_attendance' => 'boolean',

        'is_eligible_for_arrear' => 'boolean',

        'calculation_order' => 'integer',

        'frequency' => 'integer',

        'rounding_method' => 'integer',

        'is_active' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function salaryStructure()
    {
        return $this->belongsTo(
            SalaryStructure::class
        );
    }

    public function allowance()
    {
        return $this->belongsTo(
            Allowance::class
        );
    }
}