<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionInvoiceItem extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'invoice_id',

            'item_type',
            'reference_id',

            'title',
            'description',

            'quantity',
            'rate',
            'amount'
      ];

      protected $casts = [

            'quantity' => 'decimal:2',
            'rate' => 'decimal:2',
            'amount' => 'decimal:2'
      ];

      public function invoice()
      {
            return $this->belongsTo(
                  SubscriptionInvoice::class
            );
      }
}
