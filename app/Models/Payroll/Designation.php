<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class Designation extends BaseModel
{
      protected $fillable = [

            'school_id',
            'branch_id',
            'department_id',

            'designation_name',
            'designation_code',

            'hierarchy_level',

            'description',

            'is_teaching_staff',

            'status'
      ];

      protected $casts = [

            'hierarchy_level' => 'integer',

            'is_teaching_staff' => 'boolean',

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

      public function department()
      {
            return $this->belongsTo(Department::class);
      }

      public function employees()
      {
            return $this->hasMany(Employee::class);
      }
}
