<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionInvoice extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'tenant_id',
            'tenant_subscription_id',

            'invoice_no',

            'invoice_date',
            'due_date',

            'billing_period_from',
            'billing_period_to',

            'subtotal',
            'discount_amount',
            'tax_amount',

            'paid_amount',
            'grand_total',
            'due_amount',

            'invoice_type',

            'payment_status',
            'status',

            'remarks'
      ];

      protected $casts = [

            'invoice_date' => 'date',
            'due_date' => 'date',

            'billing_period_from' => 'date',
            'billing_period_to' => 'date',

            'subtotal' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'grand_total' => 'decimal:2',
            'due_amount' => 'decimal:2'
      ];

      public function tenant()
      {
            return $this->belongsTo(AllSchool::class);
      }

      public function subscription()
      {
            return $this->belongsTo(
                  TenantSubscription::class,
                  'tenant_subscription_id'
            );
      }

      public function items()
      {
            return $this->hasMany(
                  SubscriptionInvoiceItem::class
            );
      }

      public function payments()
      {
            return $this->hasMany(
                  SubscriptionPayment::class
            );
      }
}
