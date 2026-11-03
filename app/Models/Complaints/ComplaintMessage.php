<?php

namespace App\Models\Complaints;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintMessage extends BaseModel
{
      use HasFactory, SoftDeletes;

      protected $fillable = [
            'complaint_id',
            'message_type',
            'message',
            'created_by_type',
            'created_by_id',
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
      | Message Types
      |--------------------------------------------------------------------------
      */

      const COMMENT = 1;
      const FEEDBACK = 2;
      const INTERNAL_NOTE = 3;

      /*
      |--------------------------------------------------------------------------
      | Relationships
      |--------------------------------------------------------------------------
      */

      public function complaint()
      {
            return $this->belongsTo(Complaint::class);
      }

      /*
      |--------------------------------------------------------------------------
      | Scopes
      |--------------------------------------------------------------------------
      */

      public function scopeComments($query)
      {
            return $query->where('message_type', self::COMMENT);
      }

      public function scopeFeedback($query)
      {
            return $query->where('message_type', self::FEEDBACK);
      }

      public function scopeInternalNotes($query)
      {
            return $query->where('message_type', self::INTERNAL_NOTE);
      }

      public function scopeActive($query)
      {
            return $query->where('status', true);
      }

      /*
      |--------------------------------------------------------------------------
      | Helpers
      |--------------------------------------------------------------------------
      */

      public static function messageTypes()
      {
            return [
                  self::COMMENT       => 'Comment',
                  self::FEEDBACK      => 'Feedback',
                  self::INTERNAL_NOTE => 'Internal Note',
            ];
      }
}
