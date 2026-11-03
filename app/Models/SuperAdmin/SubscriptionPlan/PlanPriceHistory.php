<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanPriceHistory extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'subscription_plan_id',

            'billing_cycle',

            'price',

            'setup_fee',

            'effective_from',

            'effective_to',

            'is_active',

            'remarks',

            'created_by'
      ];

      protected $casts = [

            'price' => 'decimal:2',

            'setup_fee' => 'decimal:2',

            'effective_from' => 'date',

            'effective_to' => 'date',

            'is_active' => 'boolean'
      ];

      public function plan()
      {
            return $this->belongsTo(
                  SubscriptionPlan::class,
                  'subscription_plan_id'
            );
      }
}
