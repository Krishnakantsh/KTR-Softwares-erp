<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionCouponUsage extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'coupon_id',

            'tenant_id',

            'invoice_id',

            'invoice_amount',

            'discount_amount',

            'usage_type',

            'used_at',
            'tenant_subscription_id',

            'meta'
      ];

      protected $casts = [

            'used_at' => 'datetime',

            'invoice_amount' => 'decimal:2',

            'discount_amount' => 'decimal:2',

            'meta' => 'array'
      ];

      public function coupon()
      {
            return $this->belongsTo(
                  SubscriptionCoupon::class
            );
      }

      public function tenant()
      {
            return $this->belongsTo(
                  AllSchool::class
            );
      }

      public function invoice()
      {
            return $this->belongsTo(
                  SubscriptionInvoice::class
            );
      }
}
