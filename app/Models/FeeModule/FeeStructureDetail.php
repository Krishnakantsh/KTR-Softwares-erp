<?php

namespace App\Models\FeeModule;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class FeeStructureDetail extends BaseModel
{
         use SoftDeletes;

      protected $fillable = [

            'fee_structure_id',

            'fee_head_id',

            'fee_installment_detail_id',

            'amount',

            'is_optional',

            'allow_concession',

            'allow_fine',

            'display_order',

            'status'
      ];

      protected $casts = [

            'amount' => 'decimal:2',

            'is_optional' => 'boolean',

            'allow_concession' => 'boolean',

            'allow_fine' => 'boolean',

            'status' => 'boolean'
      ];

      public function structure()
      {
            return $this->belongsTo(FeeStructure::class, 'fee_structure_id');
      }

      public function feeHead()
      {
            return $this->belongsTo(FeeHead::class);
      }

      public function installment()
      {
            return $this->belongsTo(
                  FeeInstallmentDetail::class,
                  'fee_installment_detail_id'
            );
      }
}
