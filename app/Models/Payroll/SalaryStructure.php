<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class SalaryStructure extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Salary Basis
    |--------------------------------------------------------------------------
    */

    const BASIS_MONTHLY = 1;
    const BASIS_DAILY = 2;
    const BASIS_HOURLY = 3;


    /*
    |--------------------------------------------------------------------------
    | Calculation Type
    |--------------------------------------------------------------------------
    */

    const CALC_FIXED = 1;
    const CALC_COMPONENT = 2;
    const CALC_FORMULA = 3;


    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    const STATUS_DRAFT = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_INACTIVE = 3;
    const STATUS_ARCHIVED = 4;


    protected $fillable = [

        'school_id',
        'branch_id',

        'structure_code',
        'structure_name',
        'description',

        'salary_basis',
        'calculation_type',

        'effective_from',
        'effective_to',

        'is_taxable',
        'is_pf_applicable',
        'is_esi_applicable',

        'is_active',
        'status',
    ];


    protected $casts = [

        'salary_basis' => 'integer',

        'calculation_type' => 'integer',

        'effective_from' => 'date',
        'effective_to' => 'date',

        'is_taxable' => 'boolean',
        'is_pf_applicable' => 'boolean',
        'is_esi_applicable' => 'boolean',

        'is_active' => 'boolean',

        'status' => 'integer',
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

    public function components()
    {
        return $this->hasMany(
            SalaryStructureComponent::class
        );
    }

    public function employeeAssignments()
    {
        return $this->hasMany(
            EmployeeSalaryAssignment::class
        );
    }
}