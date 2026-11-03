<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountBudget extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'financial_year_id',
            'budget_head_id',
            'amount'
      ];

      public function financialYear()
      {
            return $this->belongsTo(AcademicSession::class);
      }

      public function budgetHead()
      {
            return $this->belongsTo(AccountBudgetHead::class, 'budget_head_id');
      }
}
