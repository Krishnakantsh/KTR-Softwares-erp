<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmploymentType extends BaseModel
{
    protected $fillable = [

        'school_id',
        'branch_id',

        'employment_type_name',
        'employment_type_code',

        'description',

        'status',
    ];

    protected $casts = [

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

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}