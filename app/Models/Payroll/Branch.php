<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class Branch extends BaseModel
{
      protected $fillable = [

            'school_id',

            'branch_code',
            'branch_name',
            'display_name',

            'email',
            'phone',
            'alternate_phone',

            'country',
            'state',
            'district',
            'city',
            'area',
            'pincode',
            'address',

            'latitude',
            'longitude',

            'branch_head_id',

            'office_start_time',
            'office_end_time',

            'opening_date',

            'logo',
            'cover_image',

            'gst_number',
            'registration_number',
            'affiliation_number',

            'is_head_office',
            'is_active',

            'description'
      ];

      protected $casts = [

            'opening_date' => 'date',

            'office_start_time' => 'datetime:H:i',
            'office_end_time'   => 'datetime:H:i',

            'latitude'  => 'decimal:7',
            'longitude' => 'decimal:7',

            'is_head_office' => 'boolean',
            'is_active'      => 'boolean',
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

      public function branchHead()
      {
            return $this->belongsTo(Employee::class, 'branch_head_id');
      }

      public function employees()
      {
            return $this->hasMany(Employee::class);
      }

      public function departments()
      {
            return $this->hasMany(Department::class);
      }

      public function designations()
      {
            return $this->hasMany(Designation::class);
      }

      public function shifts()
      {
            return $this->hasMany(Shift::class);
      }

      // public function holidays()
      // {
      //       return $this->hasMany(Holiday::class);
      // }
}
