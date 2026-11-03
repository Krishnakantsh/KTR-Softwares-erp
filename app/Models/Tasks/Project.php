<?php

namespace App\Models\Tasks;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'uuid',
            'school_id',
            'name',
            'project_key',
            'slug',
            'description',
            'project_type',
            'status',
            'priority',
            'owner',
            'project_manager_id',
            'client_id',
            'start_date',
            'target_end_date',
            'actual_start_at',
            'completed_at',
            'budget_amount',
            'currency_code',
            'progress_percent',
            'visibility',
            'settings',
            'created_by',
            'updated_by',
      ];

      protected function casts(): array
      {
            return [
                  'start_date' => 'date',
                  'target_end_date' => 'date',
                  'actual_start_at' => 'datetime',
                  'completed_at' => 'datetime',
                  'budget_amount' => 'decimal:2',
                  'progress_percent' => 'integer',
                  'settings' => 'array',
            ];
      }

      protected static function booted(): void
      {
            static::creating(function (Project $project) {
                  if (empty($project->uuid)) {
                        $project->uuid = (string) Str::uuid();
                  }
            });
      }
}
