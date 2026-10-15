<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

/**
 * EmployeePayrollDetail
 *
 * PURPOSE:
 * ----------
 * This model stores the component-wise breakup of a generated payroll.
 *
 * EmployeePayroll:
 * ----------------
 * Stores the final monthly salary summary.
 *
 * EmployeePayrollDetail:
 * ----------------------
 * Stores exactly how that salary was calculated.
 *
 * Example:
 *
 * employee_payrolls
 * ----------------
 * Gross Salary  = ₹35,000
 * Total Deduction = ₹2,500
 * Net Salary = ₹32,500
 *
 *
 * employee_payroll_details
 * ------------------------
 *
 * Basic Salary       ₹25,000  Earning
 * HRA                 ₹5,000  Earning
 * Transport           ₹2,000  Earning
 * Overtime            ₹1,000  Earning
 * Bonus               ₹2,000  Earning
 *
 * PF                  ₹1,800  Deduction
 * TDS                   ₹400  Deduction
 * LOP                   ₹300  Deduction
 *
 *
 * This makes payslip generation and component-wise reporting easy.
 *
 * IMPORTANT:
 * ----------
 * Component name/code are stored as snapshots.
 *
 * If "House Rent Allowance" is renamed later,
 * an old payroll should still show the original component name.
 */
class EmployeePayrollDetail extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Component Types
    |--------------------------------------------------------------------------
    */

    const COMPONENT_BASIC = 1;
    const COMPONENT_ALLOWANCE = 2;
    const COMPONENT_OVERTIME = 3;
    const COMPONENT_BONUS = 4;
    const COMPONENT_INCENTIVE = 5;
    const COMPONENT_ARREAR = 6;
    const COMPONENT_OTHER_EARNING = 7;

    const COMPONENT_DEDUCTION = 8;
    const COMPONENT_TAX = 9;
    const COMPONENT_PF = 10;
    const COMPONENT_LOAN = 11;
    const COMPONENT_ADVANCE = 12;
    const COMPONENT_LOP = 13;
    const COMPONENT_OTHER_DEDUCTION = 14;


    /*
    |--------------------------------------------------------------------------
    | Calculation Types
    |--------------------------------------------------------------------------
    */

    const CALC_FIXED = 1;
    const CALC_PERCENTAGE = 2;
    const CALC_PER_DAY = 3;
    const CALC_PER_HOUR = 4;
    const CALC_ACTUAL = 5;
    const CALC_MANUAL = 6;


    /*
    |--------------------------------------------------------------------------
    | Effect
    |--------------------------------------------------------------------------
    */

    const EFFECT_EARNING = 1;
    const EFFECT_DEDUCTION = 2;


    protected $fillable = [

        'employee_payroll_id',

        'employee_id',

        'component_id',

        'component_name',
        'component_code',

        'component_type',

        'calculation_type',

        'calculation_base',

        'percentage',

        'quantity',

        'rate',

        'amount',

        'effect',

        'is_taxable',

        'is_included_in_gross',

        'is_included_in_net',

        'display_order',

        'remarks',
    ];


    protected $casts = [

        'employee_payroll_id' => 'integer',

        'employee_id' => 'integer',

        'component_id' => 'integer',

        'component_type' => 'integer',

        'calculation_type' => 'integer',

        'calculation_base' => 'decimal:2',

        'percentage' => 'decimal:4',

        'quantity' => 'decimal:2',

        'rate' => 'decimal:4',

        'amount' => 'decimal:2',

        'effect' => 'integer',

        'is_taxable' => 'boolean',

        'is_included_in_gross' => 'boolean',

        'is_included_in_net' => 'boolean',

        'display_order' => 'integer',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function payroll()
    {
        return $this->belongsTo(
            EmployeePayroll::class,
            'employee_payroll_id'
        );
    }

    public function employee()
    {
        return $this->belongsTo(
            Employee::class
        );
    }
}