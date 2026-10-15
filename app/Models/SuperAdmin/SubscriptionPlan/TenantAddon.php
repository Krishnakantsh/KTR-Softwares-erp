<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantAddon extends Model
{
      use SoftDeletes;

      protected $table = 'tenant_add_ons';

      protected $fillable = [

            'tenant_id',

            'tenant_subscription_id',

            'add_on_module_id',

            'billing_cycle',

            'start_date',
            'end_date',

            'setup_fee',

            'amount',

            'auto_renew',

            'status',

            'activated_at',
            'expired_at',
            'cancelled_at',
            'subscription_invoice_id',

            'metadata',

            'remarks'
      ];

      protected $casts = [

            'start_date' => 'date',
            'end_date' => 'date',

            'activated_at' => 'datetime',
            'expired_at' => 'datetime',
            'cancelled_at' => 'datetime',

            'setup_fee' => 'decimal:2',
            'amount' => 'decimal:2',

            'auto_renew' => 'boolean',

            'metadata' => 'array'
      ];

      public function tenant()
      {
            return $this->belongsTo(
                  AllSchool::class
            );
      }

      public function subscription()
      {
            return $this->belongsTo(
                  TenantSubscription::class,
                  'tenant_subscription_id'
            );
      }

      public function addon()
      {
            return $this->belongsTo(
                  AddOnModule::class,
                  'add_on_module_id'
            );
      }

      public function isActive()
      {
            return $this->status === 'active';
      }

      public function isExpired()
      {
            return $this->end_date
                  && now()->gt($this->end_date);
      }

      public function remainingDays()
      {
            if (!$this->end_date) {
                  return null;
            }

            return now()->diffInDays(
                  $this->end_date,
                  false
            );
      }
}
