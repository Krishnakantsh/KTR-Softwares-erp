<?php

namespace App\Models\Tasks;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskCommunication extends BaseModel
{
      use SoftDeletes;

      protected $table = 'task_communications';

      protected $fillable = [
            'task_id',
            'user_id',
            'message',
            'file_path',
            'file_name',
            'file_type',
            'file_size',
            'user_name',
            'user_profile',
            'created_by',
            'updated_by',
            'deleted_by',
      ];

      protected function casts(): array
      {
            return [
                  'task_id' => 'integer',
                  'user_id' => 'integer',
                  'file_size' => 'integer',
                  'created_by' => 'integer',
                  'updated_by' => 'integer',
                  'deleted_by' => 'integer',
                  'deleted_at' => 'datetime',
            ];
      }

      protected function filePath(): Attribute
      {
            return Attribute::get(fn($value) => $this->toFullUrl($value));
      }

      protected function userProfile(): Attribute
      {
            return Attribute::get(fn($value) => $this->toFullUrl($value));
      }

      private function toFullUrl(?string $value): ?string
      {
            if (!$value) {
                  return null;
            }

            return preg_match('/^https?:\/\//', $value) ? $value : asset($value);
      }

      public function task(): BelongsTo
      {
            return $this->belongsTo(ProjectTask::class, 'task_id');
      }
}
