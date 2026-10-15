<?php

namespace App\Models\FeeModule;

use App\Models\AllSchool;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeHeadApplicability extends BaseModel
{
      use HasFactory, SoftDeletes;

      protected $table = 'fee_head_applicabilities';

      protected $fillable = [

            'school_id',

            'fee_head_id',

            'applicability_key',

            'applicability_value',

            'status',
      ];

      protected $casts = [

            'status' => 'boolean',
      ];

      /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

      public function feeHead()
      {
            return $this->belongsTo(FeeHead::class, 'fee_head_id');
      }

      public function school()
      {
            return $this->belongsTo(AllSchool::class, 'school_id');
      }

      /*
      |--------------------------------------------------------------------------
      | Query Scopes
      |--------------------------------------------------------------------------
      */

      public function scopeGender($query)
      {
            return $query->where('applicability_key', 'gender');
      }

      public function scopeStudentType($query)
      {
            return $query->where('applicability_key', 'student_type');
      }

      public function scopeFeeType($query)
      {
            return $query->where('applicability_key', 'fee_type');
      }

      /*
      |--------------------------------------------------------------------------
      | Applicability Keys
      |--------------------------------------------------------------------------
      */

      const KEY_GENDER       = 'gender';
      const KEY_STUDENT_TYPE = 'student_type';
      const KEY_FEE_TYPE     = 'fee_type';

      /**
       * Master list of keys -> allowed values -> display labels.
       * Used for both validation and building the checkbox UI.
       */
      public static function keyOptions(): array
      {
            return [
                  self::KEY_GENDER => [
                        'label'  => 'Gender',
                        'values' => [
                              'all'   => 'All',
                              'boys'  => 'Boys',
                              'girls' => 'Girls',
                        ],
                  ],
                  self::KEY_STUDENT_TYPE => [
                        'label'  => 'Student Type',
                        'values' => [
                              'all' => 'All',
                              'new' => 'New',
                              'old' => 'Old',
                        ],
                  ],
                  self::KEY_FEE_TYPE => [
                        'label'  => 'Fee Type',
                        'values' => [
                              'all'      => 'All',
                              'regular'  => 'Regular',
                              'rte'      => 'RTE',
                              'repeater' => 'Repeater',
                        ],
                  ],
            ];
      }
}
