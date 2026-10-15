<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPaymentRefund extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'payment_id',
            'tenant_id',
            'invoice_id',

            'refund_no',

            'refund_date',

            'refund_amount',

            'refund_type',

            'refund_transaction_id',

            'gateway_refund_id',

            'gateway_response',

            'status',

            'reason',

            'processed_by'
      ];

      protected $casts = [

            'refund_date' => 'datetime',

            'refund_amount' => 'decimal:2',

            'gateway_response' => 'array'
      ];

      public function payment()
      {
            return $this->belongsTo(
                  SubscriptionPayment::class
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
