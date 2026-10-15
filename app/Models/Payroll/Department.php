<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class Department extends BaseModel
{
      protected $fillable = [

            'school_id',
            'branch_id',

            'department_name',
            'department_code',

            'email',
            'phone',

            'department_head_id',

            'description',

            'status'
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

      public function departmentHead()
      {
            return $this->belongsTo(Employee::class, 'department_head_id');
      }

      public function employees()
      {
            return $this->hasMany(Employee::class);
      }

      public function designations()
      {
            return $this->hasMany(Designation::class);
      }
}
