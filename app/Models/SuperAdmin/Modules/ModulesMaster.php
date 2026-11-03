<?php

namespace App\Models\SuperAdmin\Modules;

use App\Models\School\UserSettingMaster\UserSettingMaster;
use App\Models\SuperAdmin\SubModules\SubModulesMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModulesMaster extends Model
{


      protected $fillable = [
            'module_icon',
            'module_name',
            'default_txt_color',
            'default_bg_color',
      ];


      public function subModules()
      {
            return $this->hasMany(SubModulesMaster::class, 'module_id', 'id')
                  ->orderBy('sub_module_order');
      }

      public function schoolSettings()
      {
            return $this->hasMany(SchoolModuleSetting::class, 'module_id', 'id');
      }

      public function settingFor(int $schoolId, int $sessionId)
      {
            return $this->schoolSettings()
                  ->where('school_id', $schoolId)
                  ->first();
      }

      public function userSettings(): HasMany
      {
            return $this->hasMany(UserSettingMaster::class, 'module_id');
      }
}
