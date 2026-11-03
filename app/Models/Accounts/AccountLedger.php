<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountLedger extends BaseModel
{
      use HasFactory, SoftDeletes;

      protected $fillable = [
            'account_group_id',
            'code',
            'name',
            'opening_balance',
            'opening_type',
            'phone',
            'email',
            'address',
            'pan_no',
            'gst_no',
            'is_cash',
            'is_bank',
            'freeze',
            'remarks',
            'status',
            'session_id',
            'school_id'
      ];

      protected $casts = [
            'is_cash' => 'boolean',
            'is_bank' => 'boolean',
            'freeze' => 'boolean',
            'status' => 'boolean'
      ];

      public function group()
      {
            return $this->belongsTo(AccountGroup::class, 'account_group_id');
      }

      public function entries()
      {
            return $this->hasMany(AccountEntry::class);
      }

      public function bankAccount()
      {
            return $this->hasOne(BankAccount::class);
      }
      public function reconciliations()
      {
            return $this->hasMany(BankReconciliation::class);
      }
}
