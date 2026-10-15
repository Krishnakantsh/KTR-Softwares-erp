<?php

namespace App\Models\Calendar;

use App\Models\AcademicSession;
use App\Models\BaseModel;
use App\Models\SchoolAppUser;

class CalendarEvent extends BaseModel
{
      protected $fillable = [

            'school_id',
            'session_id',
            'event_type_id',

            'title',
            'slug',
            'description',

            'start_date',
            'end_date',

            'start_time',
            'end_time',

            'is_full_day',

            'is_holiday',
            'holiday_type',

            'applicable_to',

            'location',
            'color',

            'priority',

            'is_recurring',
            'recurrence_id',

            'status',

            'created_by',
            'updated_by',
      ];


      protected $casts = [

            'start_date' => 'date',
            'end_date'   => 'date',

            'is_full_day' => 'boolean',
            'is_holiday'  => 'boolean',
            'is_recurring' => 'boolean',
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

      public function eventType()
      {
            return $this->belongsTo(CalendarEventType::class, 'event_type_id');
      }

      public function recurrence()
      {
            return $this->belongsTo(
                  CalendarEventRecurrence::class,
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
