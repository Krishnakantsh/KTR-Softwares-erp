<?php

namespace App\Models\FeeModule;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentFeeAssignmentDetail extends BaseModel
{
      use SoftDeletes;

      protected $table = 'student_fee_assignment_details';

      protected $primaryKey = 'id';

      protected $fillable = [
            'student_fee_assignment_id',
            'fee_structure_detail_id',
            'fee_head_id',
            'fee_installment_detail_id',
            'amount',
            'is_optional',
            'allow_concession',
            'allow_fine',
            'display_order',
            'status',
      ];

      protected $casts = [
            'amount' => 'decimal:2',
            'is_optional' => 'boolean',
            'allow_concession' => 'boolean',
            'allow_fine' => 'boolean',
            'status' => 'boolean',
      ];

      /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

      public function assignment()
      {
            return $this->belongsTo(
                  StudentFeeAssignment::class,
                  'student_fee_assignment_id'
            );
      }

      public function feeHead()
      {
            return $this->belongsTo(
                  FeeHead::class,
                  'fee_head_id'
            );
      }

      public function installment()
      {
            return $this->belongsTo(
                  FeeInstallmentDetail::class,
                  'fee_installment_detail_id'
            );
      }

      public function feeStructureDetail()
      {
            return $this->belongsTo(
                  FeeStructureDetail::class,
                  'fee_structure_detail_id'
            );
      }
}
