<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckEntry extends BaseModel
{
      use SoftDeletes;


      protected $fillable = [
            'account_voucher_id',
            'cheque_no',
            'cheque_date',
            'clear_date',
            'status',
            'session_id',
            'school_id',

      ];

      protected $primary_key = "";

      protected $casts = [];
}
