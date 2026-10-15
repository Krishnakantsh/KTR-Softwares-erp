<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmployeeSalaryAssignment extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Revision Types
    |--------------------------------------------------------------------------
    */

    const REVISION_INITIAL = 1;
    const REVISION_INCREMENT = 2;
    const REVISION_PROMOTION = 3;
    const REVISION_DEMOTION = 4;
    const REVISION_SALARY_REVISION = 5;
    const REVISION_TRANSFER = 6;
    const REVISION_CORRECTION = 7;
    const REVISION_OTHER = 8;


    /*
    |--------------------------------------------------------------------------
    | Approval Status
    |--------------------------------------------------------------------------
    */

    const APPROVAL_DRAFT = 1;
    const APPROVAL_PENDING = 2;
    const APPROVAL_APPROVED = 3;
    const APPROVAL_REJECTED = 4;
    const APPROVAL_CANCELLED = 5;


    protected $fillable = [

        'employee_id',
        'salary_structure_id',

        'assignment_number',

        'effective_from',
        'effective_to',

        'gross_salary',
        'ctc',
        'basic_salary',

        'revision_number',
        'revision_type',

        'approval_status',

        'approved_by',
        'approved_at',
        'approval_remarks',

        'is_current',
        'status',

        'remarks',
    ];


    protected $casts = [

        'effective_from' => 'date',
        'effective_to' => 'date',

        'gross_salary' => 'decimal:2',
        'ctc' => 'decimal:2',
        'basic_salary' => 'decimal:2',

        'revision_number' => 'integer',
        'revision_type' => 'integer',

        'approval_status' => 'integer',

        'approved_at' => 'datetime',

        'is_current' => 'boolean',
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

    public function salaryStructure()
    {
        return $this->belongsTo(
            SalaryStructure::class
        );
    }

    public function approvedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'approved_by'
        );
    }
}