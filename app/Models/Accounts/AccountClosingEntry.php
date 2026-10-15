<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountClosingEntry extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'financial_year_id',
            'closing_date',
            'profit_amount',
            'loss_amount',
            'status'
      ];

      public function financialYear()
      {
            return $this->belongsTo(AcademicSession::class);
      }
}
