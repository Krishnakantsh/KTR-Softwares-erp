<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountEntry extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'account_voucher_id',
            'account_ledger_id',
            'debit',
            'credit',
            'remarks',
            'session_id',
            'school_id'
      ];

      public function voucher()
      {
            return $this->belongsTo(AccountVoucher::class, 'account_voucher_id');
      }

      public function ledger()
      {
            return $this->belongsTo(AccountLedger::class, 'account_ledger_id');
      }

      public function tags()
      {
            return $this->belongsToMany(
                  AccountTag::class,
                  'account_entry_tags'
            );
      }
}
