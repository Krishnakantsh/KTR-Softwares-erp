<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountAuditLog extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'account_voucher_id',
            'action',
            'old_data',
            'new_data',
            'user_id'
      ];

      protected $casts = [
            'old_data' => 'array',
            'new_data' => 'array'
      ];

      public function voucher()
      {
            return $this->belongsTo(AccountVoucher::class);
      }
}
