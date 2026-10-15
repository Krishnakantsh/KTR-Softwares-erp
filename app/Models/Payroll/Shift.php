<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class Shift extends BaseModel
{
      /*
      |--------------------------------------------------------------------------
      | Shift Types
      |--------------------------------------------------------------------------
      */

      const NORMAL = 1;
      const OVERNIGHT = 2;


      protected $fillable = [

            'school_id',
            'branch_id',

            'shift_name',
            'shift_code',

            'start_time',
            'end_time',

            'is_overnight',

            'has_break',
            'break_start_time',
            'break_end_time',

            'working_hours',
            'break_hours',

            'late_grace_minutes',
            'early_grace_minutes',

            'half_day_after_minutes',

            'overtime_allowed',
            'overtime_after_minutes',

            'late_mark_enabled',
            'early_out_enabled',

            'status',

            'description',
      ];


      protected $casts = [

            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',

            'break_start_time' => 'datetime:H:i',
            'break_end_time' => 'datetime:H:i',

            'is_overnight' => 'boolean',

            'has_break' => 'boolean',

            'working_hours' => 'decimal:2',
            'break_hours' => 'decimal:2',

            'late_grace_minutes' => 'integer',
            'early_grace_minutes' => 'integer',

            'half_day_after_minutes' => 'integer',

            'overtime_allowed' => 'boolean',
            'overtime_after_minutes' => 'integer',

            'late_mark_enabled' => 'boolean',
            'early_out_enabled' => 'boolean',

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
}
