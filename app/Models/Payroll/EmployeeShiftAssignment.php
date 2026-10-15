<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmployeeShiftAssignment extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Assignment Types
    |--------------------------------------------------------------------------
    */

    const TYPE_REGULAR = 1;
    const TYPE_TEMPORARY = 2;
    const TYPE_EMERGENCY = 3;
    const TYPE_ROTATION = 4;


    /*
    |--------------------------------------------------------------------------
    | Source Types
    |--------------------------------------------------------------------------
    */

    const SOURCE_MANUAL = 1;
    const SOURCE_SYSTEM = 2;
    const SOURCE_IMPORT = 3;


    protected $fillable = [

        'employee_id',
        'shift_id',

        'effective_from',
        'effective_to',

        'assignment_type',
        'source_type',

        'status',

        'remarks',
    ];


    protected $casts = [

        'effective_from' => 'date',
        'effective_to' => 'date',

        'assignment_type' => 'integer',
        'source_type' => 'integer',

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

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}