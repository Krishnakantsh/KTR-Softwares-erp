<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmployeeBankAccount extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Verification Status
    |--------------------------------------------------------------------------
    */

    const VERIFICATION_PENDING = 1;
    const VERIFICATION_VERIFIED = 2;
    const VERIFICATION_REJECTED = 3;


    protected $fillable = [

        'employee_id',

        'account_holder_name',
        'account_number',
        'account_type',

        'bank_name',
        'branch_name',

        'ifsc_code',
        'swift_code',

        'bank_city',
        'bank_state',

        'is_primary',
        'is_salary_account',

        'verification_status',

        'verified_by',
        'verified_at',
        'verification_remarks',

        'cancelled_cheque',
        'passbook_file',

        'status',

        'remarks',
    ];


    protected $casts = [

        'is_primary' => 'boolean',

        'is_salary_account' => 'boolean',

        'verification_status' => 'integer',

        'verified_at' => 'datetime',

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

    public function verifiedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'verified_by'
        );
    }
}