<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPayment extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'tenant_id',
            'invoice_id',

            'payment_no',

            'payment_date',

            'amount',

            'payment_method',
            'gateway',

            'transaction_id',

            'gateway_payment_id',
            'gateway_order_id',
            'gateway_signature',

            'gateway_response',

            'status',

            'remarks',

            'received_by'
      ];

      protected $casts = [

            'payment_date' => 'datetime',

            'amount' => 'decimal:2',

            'gateway_response' => 'array'
      ];

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

      public function refunds()
      {
            return $this->hasMany(
                  SubscriptionPaymentRefund::class
            );
      }
}
