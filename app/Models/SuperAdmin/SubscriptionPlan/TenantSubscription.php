<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantSubscription extends Model
{
      use SoftDeletes;

      protected $fillable = [

            'tenant_id',
            'subscription_plan_id',

            'billing_cycle',

            'start_date',
            'end_date',

            'is_trial',
            'trial_start_date',
            'trial_end_date',

            'amount',
            'discount',
            'tax',
            'final_amount',

            'status',

            'auto_renew',
            'renewal_count',

            'remarks'
      ];

      protected $casts = [

            'start_date' => 'date',
            'end_date' => 'date',

            'trial_start_date' => 'date',
            'trial_end_date' => 'date',

            'is_trial' => 'boolean',
            'auto_renew' => 'boolean',

            'amount' => 'decimal:2',
            'discount' => 'decimal:2',
            'tax' => 'decimal:2',
            'final_amount' => 'decimal:2'
      ];

      public function tenant()
      {
            return $this->belongsTo(
                  AllSchool::class,
                  'tenant_id',
                  'id'
            );
      }

      // plan

      public function plan()
      {
            return $this->belongsTo(
                  SubscriptionPlan::class,
                  'subscription_plan_id'
            );
      }

      // history

      public function histories()
      {
            return $this->hasMany(
                  SubscriptionHistory::class
            );
      }

      public function isActive()
      {
            return $this->status === 'active';
      }

      public function isTrial()
      {
            return $this->status === 'trial';
      }
      public function isExpired()
      {
            return now()->gt($this->end_date);
      }
      public function remainingDays()
      {
            return now()->diffInDays(
                  $this->end_date,
                  false
            );
      }
      public function scopeActive($query)
      {
            return $query->where(
                  'status',
                  'active'
            );
      }
      public function scopeExpired($query)
      {
            return $query->whereDate(
                  'end_date',
                  '<',
                  now()
            );
      }

      public function scopeTrial($query)
      {
            return $query->where(
                  'status',
                  'trial'
            );
      }
      // public function activeSubscription()
      // {
      //       return $this->hasOne(
      //             TenantSubscription::class
      //       )
      //             ->whereIn('status', [
      //                   'trial',
      //                   'active',
      //                   'grace_period'
      //             ]);
      // }

      public function activeSubscription()
      {
            return $this->hasOne(
                  TenantSubscription::class,
                  'tenant_id',
                  'id'
            )->whereIn('status', [
                  'trial',
                  'active',
                  'grace_period'
            ]);
      }

      
      public function transactions()
      {
            return $this->hasMany(
                  SubscriptionTransaction::class
            );
      }

      public function renewalReminders()
      {
            return $this->hasMany(
                  RenewalReminder::class
            );
      }
}
