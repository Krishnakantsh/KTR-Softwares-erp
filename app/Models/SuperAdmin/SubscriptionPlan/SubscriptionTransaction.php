<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionTransaction extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'tenant_id',

            'tenant_subscription_id',

            'event_type',

            'reference_type',

            'reference_id',

            'amount',

            'old_values',

            'new_values',

            'metadata',

            'description',

            'created_by',

            'event_at'
      ];

      protected $casts = [

            'amount' => 'decimal:2',

            'old_values' => 'array',

            'new_values' => 'array',

            'metadata' => 'array',

            'event_at' => 'datetime'
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
