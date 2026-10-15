<?php

namespace App\Models\FeeModule;

use App\Models\AllSchool;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class FeeInstallmentDetail extends BaseModel
{
      use SoftDeletes;

      protected $table = 'fee_installment_details';

      protected $fillable = [
            'school_id',
            'fee_installment_master_id',
            'installment_name',
            'installment_order',
            'start_month',
            'end_month',
            'due_day',
            'fine_after_days',
            'status',
      ];

      protected $casts = [

            'status' => 'boolean'
      ];

      public function master()
      {
            return $this->belongsTo(
                  FeeInstallmentMaster::class,
                  'fee_installment_master_id'
            );
      }

      public function school()
      {
            return $this->belongsTo(AllSchool::class);
      }

      public static function monthOptions(): array
      {
            return [
                  1  => 'January',
                  2  => 'February',
                  3  => 'March',
                  4  => 'April',
                  5  => 'May',
                  6  => 'June',
                  7  => 'July',
                  8  => 'August',
                  9  => 'September',
                  10 => 'October',
                  11 => 'November',
                  12 => 'December',
            ];
      }
}
