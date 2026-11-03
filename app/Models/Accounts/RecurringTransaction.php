<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecurringTransaction extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'voucher_type_id',
            'frequency',
            'next_run',
            'status'
      ];

      public function voucherType()
      {
            return $this->belongsTo(VoucherType::class);
      }
}
