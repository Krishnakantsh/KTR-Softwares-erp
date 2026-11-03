<?php

namespace App\Models\Calendar;

use App\Models\BaseModel;
use App\Models\SchoolAppUser;

class CalendarEventType extends BaseModel
{
      protected $fillable = [

            'school_id',

            'name',
            'slug',

            'color',
            'icon',

            'description',

            'is_holiday',
            'is_active',

            'created_by',
            'updated_by',
      ];


      protected $casts = [

            'is_holiday' => 'boolean',
            'is_active'  => 'boolean',
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
            return $this->hasMany(CalendarEvent::class, 'event_type_id');
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
