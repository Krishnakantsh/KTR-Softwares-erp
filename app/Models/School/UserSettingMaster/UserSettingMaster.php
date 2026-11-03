<?php

namespace App\Models\School\UserSettingMaster;

use App\Models\School\UserSettingMaster\UserSettingValue;
use App\Models\SuperAdmin\Modules\ModulesMaster;
use App\Models\SuperAdmin\SubModules\SubModulesMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserSettingMaster extends Model
{
      protected $table = 'user_setting_masters';

      public const TYPE_ON_OFF          = 1;
      public const TYPE_OPTIONS         = 2;
      public const TYPE_OPTIONS_MULTI   = 3;
      public const TYPE_INPUT           = 4;

      protected $fillable = [
            'setting_title',
            'setting_key',
            'module_id',
            'sub_module_id',
            'setting_type',
            'options',
            'default_setting',
            'in_admin_hand',
            'status',
      ];

      protected $casts = [
            'options'        => 'array',
            'in_admin_hand'  => 'boolean',
            'status'         => 'boolean',
            'setting_type'   => 'integer',
      ];


      public function module(): BelongsTo
      {
            return $this->belongsTo(ModulesMaster::class, 'module_id');
      }


      public function subModule(): BelongsTo
      {
            return $this->belongsTo(SubModulesMaster::class, 'sub_module_id');
      }


      public function values(): HasMany
      {
            return $this->hasMany(
                  UserSettingValue::class,
                  'user_setting_master_id',
                  'id'
            );
      }

      /**
       * Convenience: get the value for a specific school + session.
       */
      public function valueFor(int $schoolId, int $sessionId)
      {
            return $this->values()
                  ->where('school_id', $schoolId)
                  ->where('session_id', $sessionId)
                  ->value('selected_setting');
      }

      /**
       * Scope: only active/enabled settings.
       */
      public function scopeActive($query)
      {
            return $query->where('status', 1);
      }

      /**
       * Scope: filter by module + sub_module together (common lookup).
       */
      public function scopeForModule($query, int $moduleId, ?int $subModuleId = null)
      {
            $query->where('module_id', $moduleId);

            if ($subModuleId) {
                  $query->where('sub_module_id', $subModuleId);
            }

            return $query;
      }
}
