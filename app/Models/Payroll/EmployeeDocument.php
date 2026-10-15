<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;
use App\Models\User;

class EmployeeDocument extends BaseModel
{
      /*
      |--------------------------------------------------------------------------
      | Document Types
      |--------------------------------------------------------------------------
      */

      const TYPE_AADHAAR = 1;
      const TYPE_PAN = 2;
      const TYPE_SIGNATURE = 3;
      const TYPE_DRIVING_LICENSE = 4;
      const TYPE_VOTER_ID = 5;
      const TYPE_TENTH_MARKSHEET = 6;
      const TYPE_TWELFTH_MARKSHEET = 7;
      const TYPE_GRADUATION_MARKSHEET = 8;
      const TYPE_POST_GRADUATION_MARKSHEET = 9;
      const TYPE_CONTRACT_AGREEMENT = 10;
      const TYPE_MEDICAL_CERTIFICATE = 11;
      const TYPE_ADDRESS_PROOF = 12;
      const TYPE_OTHER = 13;


      /*
      |--------------------------------------------------------------------------
      | Verification Status
      |--------------------------------------------------------------------------
      */

      const VERIFICATION_PENDING = 1;
      const VERIFICATION_VERIFIED = 2;
      const VERIFICATION_REJECTED = 3;


      protected $fillable = [

            'employee_id',

            'document_type',

            'document_name',
            'document_number',

            'issuing_authority',

            'issue_date',
            'expiry_date',

            'file_path',
            'file_name',
            'file_extension',
            'file_size',
            'mime_type',

            'verification_status',

            'verified_by',
            'verified_at',
            'verification_remarks',

            'is_required',
            'is_primary',

            'status',

            'remarks',
      ];


      protected $casts = [

            'document_type' => 'integer',

            'issue_date' => 'date',
            'expiry_date' => 'date',

            'file_size' => 'integer',

            'verification_status' => 'integer',

            'verified_at' => 'datetime',

            'is_required' => 'boolean',
            'is_primary' => 'boolean',

            'status' => 'boolean',
      ];


      public function employee()
      {
            return $this->belongsTo(Employee::class);
      }

      public function verifiedBy()
      {
            return $this->belongsTo(
                  User::class,
                  'verified_by'
            );
      }
}
