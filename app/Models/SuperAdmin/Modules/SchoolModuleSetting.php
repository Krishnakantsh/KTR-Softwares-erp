<?php

namespace App\Models\SuperAdmin\Modules;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;

class SchoolModuleSetting extends Model
{
      protected $table = 'school_module_settings';

      protected $fillable = [
            'module_id',
            'school_id',
            'session_id',
            'is_active',
            'is_disable',
            'txt_color',
            'bg_color',
            'module_order',
      ];

      protected $casts = [
            'is_active'   => 'boolean',
            'is_disable'  => 'boolean',
      ];

      public function module()
      {
            return $this->belongsTo(ModulesMaster::class, 'module_id', 'id');
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
            return $query->where('is_active', 1)->where('is_disable', 0);
      }

      public function scopeForSchoolSession($query, int $schoolId, int $sessionId)
      {
            return $query->where('school_id', $schoolId)->where('session_id', $sessionId);
      }

      public function getEffectiveTxtColorAttribute()
      {
            return $this->txt_color ?: $this->module?->default_txt_color;
      }

      public function getEffectiveBgColorAttribute()
      {
            return $this->bg_color ?: $this->module?->default_bg_color;
      }
}
