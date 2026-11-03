<?php

namespace App\Models\FeeModule;

use App\Models\BaseModel;

use App\Models\AllSchool;
use Illuminate\Database\Eloquent\SoftDeletes;


class FeeInstallmentMaster extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [

            'school_id',

            'installment_name',

            'installment_code',

            'description',

            'status'
      ];

      protected $casts = [

            'status' => 'boolean'
      ];

      public function details()
      {
            return $this->hasMany(FeeInstallmentDetail::class, 'fee_installment_master_id')
                  ->orderBy('installment_order');
      }

      public function school()
      {
            return $this->belongsTo(AllSchool::class);
      }
}
