<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeRate extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'from_currency_id',
            'to_currency_id',
            'rate',
            'rate_date'
      ];

      public function fromCurrency()
      {
            return $this->belongsTo(Currency::class, 'from_currency_id');
      }

      public function toCurrency()
      {
            return $this->belongsTo(Currency::class, 'to_currency_id');
      }
}
