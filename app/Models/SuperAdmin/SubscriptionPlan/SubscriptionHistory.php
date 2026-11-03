<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionHistory extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'tenant_subscription_id',
            'tenant_id',

            'old_plan_id',
            'new_plan_id',

            'action',

            'amount',

            'meta',

            'remarks',

            'created_by'
      ];

      protected $casts = [

            'amount' => 'decimal:2',

            'meta' => 'array'
      ];

      public function subscription()
      {
            return $this->belongsTo(
                  TenantSubscription::class,
                  'tenant_subscription_id'
            );
      }

      public function tenant()
      {
            return $this->belongsTo(
                  AllSchool::class
            );
      }

      public function oldPlan()
      {
            return $this->belongsTo(
                  SubscriptionPlan::class,
                  'old_plan_id'
            );
      }

      public function newPlan()
      {
            return $this->belongsTo(
                  SubscriptionPlan::class,
                  'new_plan_id'
            );
      }
}
