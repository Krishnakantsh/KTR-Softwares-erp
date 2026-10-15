<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class LeaveType extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Leave Categories
    |--------------------------------------------------------------------------
    */

    const CATEGORY_PAID = 1;
    const CATEGORY_UNPAID = 2;
    const CATEGORY_STATUTORY = 3;
    const CATEGORY_SPECIAL = 4;
    const CATEGORY_OTHER = 5;


    /*
    |--------------------------------------------------------------------------
    | Salary Treatment
    |--------------------------------------------------------------------------
    */

    const SALARY_PAID = 1;
    const SALARY_LOP = 2;
    const SALARY_PARTIAL = 3;


    /*
    |--------------------------------------------------------------------------
    | Attendance Treatment
    |--------------------------------------------------------------------------
    */

    const ATTENDANCE_PRESENT = 1;
    const ATTENDANCE_LEAVE = 2;
    const ATTENDANCE_ABSENT = 3;
    const ATTENDANCE_HALF_DAY = 4;


    /*
    |--------------------------------------------------------------------------
    | Gender Restriction
    |--------------------------------------------------------------------------
    */

    const GENDER_ALL = 1;
    const GENDER_MALE = 2;
    const GENDER_FEMALE = 3;
    const GENDER_OTHER = 4;


    protected $fillable = [

        'school_id',
        'branch_id',

        'leave_code',
        'leave_name',
        'description',

        'leave_category',

        'salary_treatment',
        'attendance_treatment',

        'gender_restriction',

        'is_paid',

        'requires_approval',
        'requires_document',

        'allow_half_day',
        'allow_hourly',

        'allow_carry_forward',
        'maximum_carry_forward',

        'allow_encashment',
        'maximum_encashment',

        'allow_negative_balance',
        'maximum_negative_balance',

        'include_weekends',
        'include_holidays',

        'minimum_notice_days',
        'maximum_consecutive_days',

        'is_active',

        'remarks',
    ];


    protected $casts = [

        'leave_category' => 'integer',

        'salary_treatment' => 'integer',

        'attendance_treatment' => 'integer',

        'gender_restriction' => 'integer',

        'is_paid' => 'boolean',

        'requires_approval' => 'boolean',

        'requires_document' => 'boolean',

        'allow_half_day' => 'boolean',

        'allow_hourly' => 'boolean',

        'allow_carry_forward' => 'boolean',

        'maximum_carry_forward' => 'decimal:2',

        'allow_encashment' => 'boolean',

        'maximum_encashment' => 'decimal:2',

        'allow_negative_balance' => 'boolean',

        'maximum_negative_balance' => 'decimal:2',

        'include_weekends' => 'boolean',

        'include_holidays' => 'boolean',

        'minimum_notice_days' => 'integer',

        'maximum_consecutive_days' => 'integer',

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