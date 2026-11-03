<?php

namespace App\Models\SuperAdmin\Notification;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationTemplate extends  Model
{
      use SoftDeletes;

      protected $fillable = [

            'name',

            'template_key',

            'language',

            'title',

            'content',

            'variables',

            'description',

            'is_system',

            'is_active',
      ];

      protected $casts = [

            'variables' => 'array',

            'is_system' => 'boolean',

            'is_active' => 'boolean',
      ];

      /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

      public function logs()
      {
            return $this->hasMany(NotificationLog::class);
      }

      /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

      public function scopeActive($query)
      {
            return $query->where('is_active', true);
      }

      public function scopeTemplateKey($query, string $templateKey)
      {
            return $query->where('template_key', $templateKey);
      }

      public function scopeLanguage($query, string $language = 'en')
      {
            return $query->where('language', $language);
      }
}
