<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoucherType extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'name',
            'prefix',
            'next_number',
            'status',
            'session_id',
            'school_id'

      ];

      public function vouchers()
      {
            return $this->hasMany(AccountVoucher::class);
      }
}
