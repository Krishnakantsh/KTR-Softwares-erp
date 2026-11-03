<?php

namespace App\Models\Tasks;

use App\Models\BaseModel;
use App\Models\Payroll\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTeam extends BaseModel
{
      use SoftDeletes;

      protected $table = 'project_teams';

      protected $fillable = [
            'team_name',
            'team_code',
            'team_slug',
            'staff_ids',
            'status',
      ];

      protected $casts = [
            'staff_ids' => 'array',
            'status'    => 'boolean',
      ];

      // Staff table se mapping (staff_ids array ke through)
      public function getMembersAttribute()
      {
            $ids = $this->staff_ids ?? [];

            return empty($ids)
                  ? collect()
                  : Employee::with('staffEmploymentDetails.designation')->whereIn('id', $ids)->get();
      }
}
