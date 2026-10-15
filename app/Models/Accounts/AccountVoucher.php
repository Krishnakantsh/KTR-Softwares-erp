<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountVoucher extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'financial_year_id',
            'voucher_type_id',
            'cost_center_id',
            'voucher_no',
            'voucher_date',
            'reference_no',
            'narration',
            'total_amount',
            'status',
            'session_id',
            'school_id'

      ];

      public function entries()
      {
            return $this->hasMany(AccountEntry::class);
      }

      public function voucherType()
      {
            return $this->belongsTo(VoucherType::class);
      }

      public function financialYear()
      {
            return $this->belongsTo(AcademicSession::class);
      }

      public function costCenter()
      {
            return $this->belongsTo(AccountCostCenter::class, 'cost_center_id');
      }

      public function attachments()
      {
            return $this->hasMany(AccountAttachment::class);
      }

      public function comments()
      {
            return $this->hasMany(AccountComment::class);
      }

      public function auditLogs()
      {
            return $this->hasMany(AccountAuditLog::class);
      }
}
