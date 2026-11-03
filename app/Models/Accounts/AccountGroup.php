<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountGroup extends BaseModel
{


      use HasFactory, SoftDeletes;

      protected $fillable = [
            'parent_id',
            'name',
            'nature',
            'level',
            'affects_gross_profit',
            'sort_order',
            'status',
            'session_id',
            'school_id'
      ];

      protected $casts = [
            'affects_gross_profit' => 'boolean',
            'status' => 'boolean'
      ];

      public function parent()
      {
            return $this->belongsTo(AccountGroup::class, 'parent_id');
      }

      public function children()
      {
            return $this->hasMany(AccountGroup::class, 'parent_id');
      }

      public function ledgers()
      {
            return $this->hasMany(AccountLedger::class);
      }
}
