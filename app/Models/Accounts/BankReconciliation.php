<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankReconciliation extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'account_ledger_id',
            'statement_date',
            'book_balance',
            'bank_balance',
            'difference',
            'status',
            'remarks'
      ];

      public function ledger()
      {
            return $this->belongsTo(AccountLedger::class, 'account_ledger_id');
      }
}
