<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountComment extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'account_voucher_id',
            'comment',
            'user_id'
      ];

      public function voucher()
      {
            return $this->belongsTo(AccountVoucher::class);
      }
}
