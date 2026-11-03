<?php

namespace App\Models\Complaints;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintAttachment extends BaseModel
{
      use HasFactory, SoftDeletes;

      protected $fillable = [
            'complaint_id',
            'complaint_message_id',
            'file_name',
            'original_name',
            'file_type',
            'file_extension',
            'file_size',
            'file_path',
            'uploaded_by_type',
            'uploaded_by_id',
            'status',
      ];

      protected $casts = [
            'status' => 'boolean',
      ];

      /*
      |--------------------------------------------------------------------------
      | Entity Types
      |--------------------------------------------------------------------------
      */

      const ADMIN = 1;
      const STAFF = 2;
      const STUDENT = 3;

      /*
      |--------------------------------------------------------------------------
      | Relationships
      |--------------------------------------------------------------------------
      */

      public function complaint()
      {
            return $this->belongsTo(Complaint::class);
      }

      public function message()
      {
            return $this->belongsTo(ComplaintMessage::class, 'complaint_message_id');
      }

      /*
      |--------------------------------------------------------------------------
      | Scopes
      |--------------------------------------------------------------------------
      */

      public function scopeActive($query)
      {
            return $query->where('status', true);
      }
}
