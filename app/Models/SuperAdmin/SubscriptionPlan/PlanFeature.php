<?php


namespace App\Models\SuperAdmin\SubscriptionPlan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanFeature extends Model
{
      use SoftDeletes;

      protected $fillable = [
            'name',
            'slug',
            'module_name',
            'description',
            'status'
      ];

      protected $casts = [
            'status' => 'boolean'
      ];

      public function plans()
      {
            return $this->belongsToMany(
                  SubscriptionPlan::class,
                  'plan_feature_mappings',
                  'plan_feature_id',
                  'subscription_plan_id'
            );
      }

      public function overrides()
      {
            return $this->hasMany(
                  FeatureOverride::class,
                  'plan_feature_id'
            );
      }
}
