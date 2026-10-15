<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxMaster extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'name',
            'percentage',
            'type',
            'status'
      ];

      public function taxEntries()
      {
            return $this->hasMany(TaxEntry::class);
      }
}
