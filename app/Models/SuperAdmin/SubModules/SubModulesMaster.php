<?php

namespace App\Models\SuperAdmin\SubModules;

use App\Models\School\UserSettingMaster\UserSettingMaster;
use App\Models\SuperAdmin\Modules\ModulesMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubModulesMaster extends Model
{


      protected $fillable = [
            'module_id',
            'sub_module_icon',
            'sub_module_name',
            'sub_module_url',
            'sub_module_order',
            'dashboard_permission',
            'eng_video_url',
            'hin_video_url',
            'submodule_sortname',
      ];

      protected $casts = [
            'dashboard_permission' => 'boolean',
      ];

      public function module()
      {
            return $this->belongsTo(ModulesMaster::class, 'module_id', 'id');
      }

      public function schoolSettings()
      {
            return $this->hasMany(SchoolSubModuleSetting::class, 'sub_module_id', 'id');
      }

      public function settingFor(int $schoolId, int $sessionId)
      {
            return $this->schoolSettings()
                  ->where('school_id', $schoolId)
                  ->first();
      }

      public function userSettings(): HasMany
      {
            return $this->hasMany(UserSettingMaster::class, 'sub_module_id');
      }
}
