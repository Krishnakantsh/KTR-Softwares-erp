<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

/**
 * OvertimeRule
 *
 * PURPOSE:
 * ----------
 * This model stores the rules/configuration used by the payroll system
 * to determine when employee overtime is eligible and how it should
 * be calculated.
 *
 * IMPORTANT:
 * ----------
 * This table does NOT store employee-wise actual overtime.
 *
 * Example:
 *
 * Employee worked 2 extra hours.
 *
 * OvertimeRule decides:
 *
 * - Is 2 hours eligible?
 * - Is approval required?
 * - Is it 1x, 1.5x or 2x?
 * - Is it a working day, weekly-off or holiday?
 * - Should late minutes reduce overtime?
 * - How should minutes be rounded?
 *
 * Actual employee overtime will be stored separately.
 */
class OvertimeRule extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Applicable On
    |--------------------------------------------------------------------------
    |
    | Defines which type of day this rule applies to.
    |
    */

    const APPLIES_ALL_DAYS = 1;
    const APPLIES_WORKING_DAYS = 2;
    const APPLIES_WEEKLY_OFF = 3;
    const APPLIES_HOLIDAY = 4;
    const APPLIES_WORKING_AND_WEEKLY_OFF = 5;
    const APPLIES_WORKING_AND_HOLIDAY = 6;


    /*
    |--------------------------------------------------------------------------
    | Rounding Method
    |--------------------------------------------------------------------------
    |
    | Controls how overtime minutes are rounded.
    |
    */

    const ROUND_EXACT = 1;
    const ROUND_DOWN = 2;
    const ROUND_UP = 3;
    const ROUND_NEAREST = 4;


    /*
    |--------------------------------------------------------------------------
    | Calculation Method
    |--------------------------------------------------------------------------
    |
    | Determines the base used to calculate overtime payment.
    |
    */

    const CALC_HOURLY_RATE = 1;
    const CALC_BASIC_SALARY = 2;
    const CALC_GROSS_SALARY = 3;
    const CALC_FIXED_AMOUNT = 4;


    protected $fillable = [

        /*
        | School / Branch
        */
        'school_id',
        'branch_id',

        /*
        | Rule Identity
        */
        'rule_name',
        'rule_code',

        /*
        | Applicability
        */
        'applicable_on',

        /*
        | Eligibility
        */
        'minimum_overtime_minutes',

        /*
        | Rounding
        */
        'rounding_minutes',
        'rounding_method',

        /*
        | Limits
        */
        'maximum_daily_overtime_minutes',
        'maximum_monthly_overtime_minutes',

        /*
        | Approval
        */
        'approval_required',

        /*
        | Payroll Calculation
        */
        'calculation_method',
        'overtime_multiplier',
        'fixed_hourly_amount',

        /*
        | Day Specific Rates
        */
        'working_day_multiplier',
        'weekly_off_multiplier',
        'holiday_multiplier',

        /*
        | Attendance Adjustments
        */
        'exclude_break_time',
        'adjust_late_minutes',
        'adjust_early_exit_minutes',

        /*
        | Status
        */
        'is_active',

        /*
        | Effective Period
        */
        'effective_from',
        'effective_to',

        /*
        | Description
        */
        'description',
    ];


    protected $casts = [

        'applicable_on' => 'integer',

        'minimum_overtime_minutes' => 'integer',

        'rounding_minutes' => 'integer',
        'rounding_method' => 'integer',

        'maximum_daily_overtime_minutes' => 'integer',
        'maximum_monthly_overtime_minutes' => 'integer',

        'approval_required' => 'boolean',

        'calculation_method' => 'integer',

        'overtime_multiplier' => 'decimal:2',

        'fixed_hourly_amount' => 'decimal:2',

        'working_day_multiplier' => 'decimal:2',

        'weekly_off_multiplier' => 'decimal:2',

        'holiday_multiplier' => 'decimal:2',

        'exclude_break_time' => 'boolean',

        'adjust_late_minutes' => 'boolean',

        'adjust_early_exit_minutes' => 'boolean',

        'is_active' => 'boolean',

        'effective_from' => 'date',

        'effective_to' => 'date',
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
        return $this->belongsTo(
            Branch::class
        );
    }
}