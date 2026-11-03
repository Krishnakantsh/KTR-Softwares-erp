<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmployeeKycInformation extends BaseModel
{
    protected $fillable = [

        'employee_id',

        'aadhaar_number',
        'aadhaar_verified',

        'pan_number',
        'pan_verified',

        'passport_number',
        'passport_issue_date',
        'passport_expiry_date',

        'voter_id',

        'driving_license_number',
        'driving_license_expiry_date',

        'nationality',
        'religion',
        'category',

        'uan_number',
        'pf_number',
        'esic_number',
        'tan_number',

        'kyc_verified',

        'verified_by',
        'verified_at',
        'verification_remarks',

        'status',
    ];

    protected $casts = [

        'aadhaar_verified' => 'boolean',
        'pan_verified' => 'boolean',

        'passport_issue_date' => 'date',
        'passport_expiry_date' => 'date',

        'driving_license_expiry_date' => 'date',

        'kyc_verified' => 'boolean',

        'verified_at' => 'datetime',

        'status' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'verified_by'
        );
    }
}