<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmployeeGeneralInformation extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_OTHER = 3;


    /*
    |--------------------------------------------------------------------------
    | Marital Status
    |--------------------------------------------------------------------------
    */

    const MARITAL_SINGLE = 1;
    const MARITAL_MARRIED = 2;
    const MARITAL_DIVORCED = 3;
    const MARITAL_WIDOWED = 4;
    const MARITAL_SEPARATED = 5;


    protected $fillable = [

        'employee_id',

        // Personal
        'first_name',
        'middle_name',
        'last_name',
        'display_name',
        'gender',
        'date_of_birth',
        'blood_group',

        // Family
        'father_name',
        'mother_name',
        'marital_status',
        'spouse_name',

        // Contact
        'personal_email',
        'personal_mobile',
        'alternate_mobile',

        // Emergency
        'emergency_contact_name',
        'emergency_contact_relation',
        'emergency_contact_mobile',

        // Current Address
        'current_address_line_1',
        'current_address_line_2',
        'current_country',
        'current_state',
        'current_district',
        'current_city',
        'current_area',
        'current_pincode',

        // Permanent Address
        'permanent_address_line_1',
        'permanent_address_line_2',
        'permanent_country',
        'permanent_state',
        'permanent_district',
        'permanent_city',
        'permanent_area',
        'permanent_pincode',

        'same_as_permanent_address',

        // Profile
        'profile_photo',
        'notes',

        'status',
    ];


    protected $casts = [

        'gender' => 'integer',

        'date_of_birth' => 'date',

        'marital_status' => 'integer',

        'same_as_permanent_address' => 'boolean',

        'status' => 'boolean',
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
}