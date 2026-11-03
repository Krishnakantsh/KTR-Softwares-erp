<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantUsage extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'tenant_id',

            'students_count',
            'users_count',
            'teachers_count',
            'branches_count',

            'sms_count',
            'whatsapp_count',

            'storage_used_gb',

            'api_requests_count',

            'last_calculated_at'
      ];

      protected $casts = [

            'storage_used_gb' => 'decimal:2',

            'last_calculated_at' => 'datetime'
      ];

      public function tenant()
      {
            return $this->belongsTo(
                  AllSchool::class
            );
      }
}
