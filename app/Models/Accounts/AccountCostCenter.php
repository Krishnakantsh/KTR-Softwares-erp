<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountCostCenter extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'name',
            'code',
            'description',
            'status',
            'session_id',
            'school_id'
      ];

      public function vouchers()
      {
            return $this->hasMany(AccountVoucher::class, 'cost_center_id');
      }
}
