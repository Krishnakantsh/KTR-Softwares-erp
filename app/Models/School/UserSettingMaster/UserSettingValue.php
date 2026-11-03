<?php

namespace App\Models\School\UserSettingMaster;

use App\Models\AcademicSession;
use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettingValue extends Model
{
      protected $table = 'user_setting_values';

      protected $fillable = [
            'user_setting_master_id',
            'selected_setting',
            'school_id',
      ];

      public function setting(): BelongsTo
      {
            return $this->belongsTo(
                  UserSettingMaster::class,
                  'user_setting_master_id',
                  'id'
            );
      }

      public function school(): BelongsTo
      {
            return $this->belongsTo(AllSchool::class, 'school_id');
      }


      public function getSelectedArrayAttribute(): array
      {
            return $this->selected_setting
                  ? explode(',', $this->selected_setting)
                  : [];
      }

      public static function saveValue(
            int $settingId,
            int $schoolId,
            string $value
      ): self {
            return self::updateOrCreate(
                  [
                        'user_setting_master_id' => $settingId,
                        'school_id'              => $schoolId,
                  ],
                  [
                        'selected_setting' => $value,
                  ]
            );
      }
}
