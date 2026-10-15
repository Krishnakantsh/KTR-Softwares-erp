<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountAttachment extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'account_voucher_id',
            'file',
            'file_name',
            'file_type'
      ];

      public function voucher()
      {
            return $this->belongsTo(AccountVoucher::class);
      }
}
