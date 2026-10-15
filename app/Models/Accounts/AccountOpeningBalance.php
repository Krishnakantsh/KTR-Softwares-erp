<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountOpeningBalance extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'financial_year_id',
            'account_ledger_id',
            'amount',
            'type',
            'session_id',
            'school_id'
      ];

      public function financialYear()
      {
            return $this->belongsTo(AcademicSession::class);
      }

      public function ledger()
      {
            return $this->belongsTo(AccountLedger::class, 'account_ledger_id');
      }
}
