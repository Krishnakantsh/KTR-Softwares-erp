<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RenewalReminder extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'tenant_id',

            'tenant_subscription_id',

            'reminder_type',

            'days_before',

            'expiry_date',

            'channel',

            'status',

            'scheduled_at',

            'sent_at',

            'message',

            'metadata',

            'failure_reason'
      ];

      protected $casts = [

            'expiry_date' => 'date',

            'scheduled_at' => 'datetime',

            'sent_at' => 'datetime',

            'metadata' => 'array'
      ];

      public function tenant()
      {
            return $this->belongsTo(
                  AllSchool::class
            );
      }

      public function subscription()
      {
            return $this->belongsTo(
                  TenantSubscription::class,
                  'tenant_subscription_id'
            );
      }
}
