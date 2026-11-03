<?php

namespace App\Models\Tasks;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectTask  extends BaseModel
{
      use SoftDeletes;

      protected $table = 'project_tasks';

      // Status constants
      public const STATUS_NOT_STARTED = 'not_started';
      public const STATUS_IN_PROCESS = 'in_process';
      public const STATUS_RE_ASSIGN = 're_assign';
      public const STATUS_UNDER_REVIEWING = 'under_reviewing';
      public const STATUS_ON_HOLD = 'on_hold';
      public const STATUS_BLOCKED = 'blocked';
      public const STATUS_PENDING_APPROVAL = 'pending_approval';
      public const STATUS_REVISION_REQUIRED = 'revision_required';
      public const STATUS_COMPLETED = 'completed';
      public const STATUS_CANCELLED = 'cancelled';
      public const STATUS_REOPENED = 'reopened';

      public const STATUSES = [
            'not_started',
            'in_process',
            're_assign',
            'under_reviewing',
            'on_hold',
            'blocked',
            'pending_approval',
            'revision_required',
            'completed',
            'cancelled',
            'reopened',
      ];

      // Priority constants
      public const PRIORITY_LOW = 'low';
      public const PRIORITY_MEDIUM = 'medium';
      public const PRIORITY_HIGH = 'high';
      public const PRIORITY_URGENT = 'urgent';

      public const PRIORITIES = [
            'low',
            'medium',
            'high',
            'urgent',
      ];

      protected $fillable = [
            'project_id',
            'task_code',
            'team_id',
            'task_title',
            'task_slug',
            'description',
            'staff_ids',
            'priority',
            'status',
            'start_date',
            'due_date',
            'completed_at',
            'progress',
            'created_by',
            'updated_by',
      ];

      protected function casts(): array
      {
            return [
                  'project_id' => 'integer',
                  'staff_ids' => 'array',
                  'start_date' => 'date',
                  'due_date' => 'date',
                  'completed_at' => 'datetime',
                  'progress' => 'integer',
                  'created_by' => 'integer',
                  'updated_by' => 'integer',
                  'team_id' => 'integer',
            ];
      }

      public function project(): BelongsTo
      {
            return $this->belongsTo(Project::class, 'project_id');
      }


      public function comments()
      {
            return $this->hasMany(TaskCommunication::class, 'task_id');
      }
}
