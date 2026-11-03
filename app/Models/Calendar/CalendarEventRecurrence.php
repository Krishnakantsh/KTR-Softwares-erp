<?php

namespace App\Models\Calendar;

use App\Models\BaseModel;
use App\Models\SchoolAppUser;

class CalendarEventRecurrence extends BaseModel
{
      protected $fillable = [

            'school_id',

            'frequency',
            'interval',

            'days_of_week',

            'day_of_month',
            'week_of_month',
            'week_day',

            'starts_on',
            'ends_on',

            'occurrences',

            'is_active',

            'created_by',
            'updated_by',
      ];


      protected $casts = [

            'interval' => 'integer',

            'days_of_week' => 'array',

            'day_of_month' => 'integer',
            'week_of_month' => 'integer',

            'starts_on' => 'date',
            'ends_on' => 'date',

            'occurrences' => 'integer',

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


      public function events()
      {
            return $this->hasMany(
                  CalendarEvent::class,
                  'recurrence_id'
            );
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
