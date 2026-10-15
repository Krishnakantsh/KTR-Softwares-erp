<?php

namespace App\Models\Complaints;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends BaseModel
{
      use HasFactory, SoftDeletes;

      protected $fillable = [
            'school_id',
            'session_id',
            'complaint_no',
            'complaint_type_id',
            'subject',
            'description',
            'priority',
            'status',
            'raised_by_type',
            'raised_by_id',
            'against_type',
            'against_id',
            'resolved_by_type',
            'resolved_by_id',
            'resolved_at',
            'closed_by_type',
            'closed_by_id',
            'closed_at',
            'status_flag',
      ];

      protected $casts = [
            'resolved_at' => 'datetime',
            'closed_at'   => 'datetime',
            'status_flag' => 'boolean',
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
      | Priority
      |--------------------------------------------------------------------------
      */

      const LOW = 1;
      const MEDIUM = 2;
      const HIGH = 3;
      const CRITICAL = 4;

      /*
      |--------------------------------------------------------------------------
      | Status
      |--------------------------------------------------------------------------
      */

      const OPEN = 1;
      const UNDER_REVIEW = 2;
      const IN_PROGRESS = 3;
      const RESOLVED = 4;
      const CLOSED = 5;
      const REOPENED = 6;
      const REJECTED = 7;

      /*
      |--------------------------------------------------------------------------
      | Relationships
      |--------------------------------------------------------------------------
      */

      public function complaintType()
      {
            return $this->belongsTo(ComplaintType::class);
      }

      public function messages()
      {
            return $this->hasMany(ComplaintMessage::class);
      }

      public function attachments()
      {
            return $this->hasMany(ComplaintAttachment::class);
      }

      public function statusHistories()
      {
            return $this->hasMany(ComplaintStatusHistory::class);
      }

      /*
      |--------------------------------------------------------------------------
      | Scopes
      |--------------------------------------------------------------------------
      */

      public function scopeOpen($query)
      {
            return $query->where('status', self::OPEN);
      }

      public function scopeResolved($query)
      {
            return $query->where('status', self::RESOLVED);
      }

      public function scopeClosed($query)
      {
            return $query->where('status', self::CLOSED);
      }

      public function scopeByStatus($query, $status)
      {
            return $query->where('status', $status);
      }

      /*
      |--------------------------------------------------------------------------
      | Helpers
      |--------------------------------------------------------------------------
      */

      public static function statusList()
      {
            return [
                  self::OPEN => 'Open',
                  self::UNDER_REVIEW => 'Under Review',
                  self::IN_PROGRESS => 'In Progress',
                  self::RESOLVED => 'Resolved',
                  self::CLOSED => 'Closed',
                  self::REOPENED => 'Reopened',
                  self::REJECTED => 'Rejected',
            ];
      }

      public static function priorityList()
      {
            return [
                  self::LOW => 'Low',
                  self::MEDIUM => 'Medium',
                  self::HIGH => 'High',
                  self::CRITICAL => 'Critical',
            ];
      }
}
