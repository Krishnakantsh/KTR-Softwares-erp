<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionCoupon extends Model
{
      use SoftDeletes;
      protected $fillable = [

            'name',
            'code',
            'discount_type',
            'applicable_plans',
            'excluded_plans',
            'applicable_billing_cycles',
            'discount_value',

            'max_discount',

            'minimum_order_amount',

            'usage_limit',
            'used_count',

            'usage_per_customer',

            'valid_from',
            'valid_to',

            'is_first_purchase_only',

            'status',

            'description'
      ];

      protected $casts = [

            'valid_from' => 'datetime',
            'valid_to' => 'datetime',

            'is_first_purchase_only' => 'boolean',

            'status' => 'boolean'
      ];

      public function usages()
      {
            return $this->hasMany(
                  SubscriptionCouponUsage::class
            );
      }



      public function isValid()
      {
            return $this->status
                  && now()->between(
                        $this->valid_from,
                        $this->valid_to
                  );
      }

      public function calculateDiscount(
            float $amount
      ) {
            if (
                  $this->discount_type ===
                  'percentage'
            ) {

                  $discount =
                        (
                              $amount *
                              $this->discount_value
                        ) / 100;

                  if (
                        $this->max_discount
                  ) {

                        return min(
                              $discount,
                              $this->max_discount
                        );
                  }

                  return $discount;
            }

            return min(
                  $amount,
                  $this->discount_value
            );
      }
}
