<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountLockPeriod extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'from_date',
            'to_date',
            'reason',
            'status'
      ];
}
