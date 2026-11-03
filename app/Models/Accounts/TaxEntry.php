<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxEntry extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'account_entry_id',
            'tax_master_id',
            'amount'
      ];

      public function entry()
      {
            return $this->belongsTo(AccountEntry::class, 'account_entry_id');
      }

      public function taxMaster()
      {
            return $this->belongsTo(TaxMaster::class);
      }
}
