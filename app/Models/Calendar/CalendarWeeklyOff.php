<?php

namespace App\Models\Calendar;

use App\Models\AcademicSession;
use App\Models\BaseModel;
use App\Models\SchoolAppUser;

class CalendarWeeklyOff extends BaseModel
{
      protected $fillable = [

            'school_id',
            'session_id',

            'day_of_week',

            'applicable_to',

            'off_type',
            'weeks',

            'is_active',

            'created_by',
            'updated_by',
      ];


      protected $casts = [

            'weeks' => 'array',

            'is_active' => 'boolean',
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


      public function session()
      {
            return $this->belongsTo(AcademicSession::class);
      }


      public function creator()
      {
            return $this->belongsTo(SchoolAppUser::class, 'created_by');
      }


      public function updater()
      {
            return $this->belongsTo(SchoolAppUser::class, 'updated_by');
      }
}
