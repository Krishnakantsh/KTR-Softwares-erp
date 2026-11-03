<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class PlanFeatureMapping extends Model
{
      use SoftDeletes;

      protected $fillable = [
            'subscription_plan_id',
            'plan_feature_id'
      ];

      public function plan()
      {
            return $this->belongsTo(
                  SubscriptionPlan::class
            );
      }

      public function feature()
      {
            return $this->belongsTo(
                  PlanFeature::class
            );
      }
}
