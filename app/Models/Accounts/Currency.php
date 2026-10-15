<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'name',
            'code',
            'symbol',
            'exchange_rate',
            'is_base',
            'status'
      ];
}
