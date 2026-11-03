<?php

namespace App\Models\FeeModule;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeCollectionDetail extends BaseModel
{

         use SoftDeletes;
      protected $fillable = [

            'fee_collection_id',

            'student_fee_ledger_id',

            'amount',

            'concession_amount',

            'fine_amount',

            'paid_amount'
      ];

      protected $casts = [

            'amount' => 'decimal:2',

            'concession_amount' => 'decimal:2',

            'fine_amount' => 'decimal:2',

            'paid_amount' => 'decimal:2'
      ];

      public function collection()
      {
            return $this->belongsTo(FeeCollection::class, 'fee_collection_id');
      }

      // public function ledger()
      // {
      //       return $this->belongsTo(StudentFeeLedger::class, 'student_fee_ledger_id');
      // }
}
