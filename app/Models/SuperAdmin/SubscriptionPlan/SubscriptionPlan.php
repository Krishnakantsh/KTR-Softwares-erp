<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\Software;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'name',
            'code',
            'description',

            'monthly_price',
            'quarterly_price',
            'half_yearly_price',
            'yearly_price',

            'trial_days',

            'max_students',
            'max_users',
            'max_branches',

            'is_custom',

            'sort_order',

            'status'
      ];

      protected $casts = [

            'monthly_price' => 'decimal:2',
            'quarterly_price' => 'decimal:2',
            'half_yearly_price' => 'decimal:2',
            'yearly_price' => 'decimal:2',

            'is_custom' => 'boolean',
            'status' => 'boolean'
      ];

      // features

      public function features()
      {
            return $this->belongsToMany(
                  PlanFeature::class,
                  'plan_feature_mappings',
                  'subscription_plan_id',
                  'plan_feature_id'
            );
      }

      // subscriptions

      public function subscriptions()
      {
            return $this->hasMany(TenantSubscription::class);
      }

      public function priceHistories()
      {
            return $this->hasMany(
                  PlanPriceHistory::class
            );
      }

      public function software()
      {
            return $this->belongsTo(Software::class);
      }
}
