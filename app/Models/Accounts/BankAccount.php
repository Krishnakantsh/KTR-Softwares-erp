<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'account_ledger_id',
            'bank_name',
            'branch',
            'account_number',
            'ifsc_code',
            'upi_id',
            'session_id',
            'school_id',
      ];
}
