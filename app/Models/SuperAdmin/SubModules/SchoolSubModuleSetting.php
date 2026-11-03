<?php

namespace App\Models\SuperAdmin\SubModules;

use App\Models\AllSchool;
use App\Models\SuperAdmin\Modules\ModulesMaster;
use Illuminate\Database\Eloquent\Model;

class SchoolSubModuleSetting extends Model
{
      protected $table = 'school_sub_module_settings';

      protected $fillable = [
            'sub_module_id',
            'school_id',
            'is_active',
            'is_report',
            'txt_color',
            'bg_color',
      ];

      protected $casts = [
            'is_active'                => 'boolean',
            'is_report'                => 'boolean',
      ];


      public function subModule()
      {
            return $this->belongsTo(SubModulesMaster::class, 'sub_module_id', 'id');
      }

      public function school()
      {
            return $this->belongsTo(
                  AllSchool::class,
                  'school_id',
                  'id'
            );
      }


      public function scopeActive($query)
      {
            return $query->where('is_active', 1);
      }

      public function scopeForSchoolSession($query, int $schoolId, int $sessionId)
      {
            return $query->where('school_id', $schoolId)->where('session_id', $sessionId);
      }

      public function getEffectiveTxtColorAttribute()
      {
            return $this->txt_color ?: $this->subModule?->module?->default_txt_color;
      }

      public function getEffectiveBgColorAttribute()
      {
            return $this->bg_color ?: $this->subModule?->module?->default_bg_color;
      }
}
