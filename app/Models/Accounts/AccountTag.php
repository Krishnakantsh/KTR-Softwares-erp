<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountTag extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'name',
            'color',
            'status'
      ];

      public function entries()
      {
            return $this->belongsToMany(
                  AccountEntry::class,
                  'account_entry_tags'
            );
      }
}
