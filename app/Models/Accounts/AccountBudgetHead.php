<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountBudgetHead extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'name',
            'description',
            'status'
      ];

      public function budgets()
      {
            return $this->hasMany(AccountBudget::class, 'budget_head_id');
      }
}
