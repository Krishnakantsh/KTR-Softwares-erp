<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureOverride extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'tenant_id',

            'plan_feature_id',

            'is_enabled',

            'start_date',

            'end_date',

            'reason',

            'created_by'
      ];

      protected $casts = [

            'is_enabled' => 'boolean',

            'start_date' => 'date',

            'end_date' => 'date'
      ];

      public function tenant()
      {
            return $this->belongsTo(
                  AllSchool::class
            );
      }

      public function feature()
      {
            return $this->belongsTo(
                  PlanFeature::class,
                  'plan_feature_id'
            );
      }
}
