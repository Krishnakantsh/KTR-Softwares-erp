<?php

namespace App\Models\Complaints;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class ComplaintWatcher extends BaseModel
{
      use HasFactory;

      protected $fillable = [
            'complaint_id',
            'watcher_type',
            'watcher_id',
            'can_view',
            'can_comment',
            'notify',
            'last_seen_at',
      ];

      protected $casts = [
            'can_view'    => 'boolean',
            'can_comment' => 'boolean',
            'notify'      => 'boolean',
            'last_seen_at' => 'datetime',
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

      /*
      |--------------------------------------------------------------------------
      | Scopes
      |--------------------------------------------------------------------------
      */

      public function scopeAdmins($query)
      {
            return $query->where('watcher_type', self::ADMIN);
      }

      public function scopeStaff($query)
      {
            return $query->where('watcher_type', self::STAFF);
      }

      public function scopeStudents($query)
      {
            return $query->where('watcher_type', self::STUDENT);
      }

      public function scopeNotificationEnabled($query)
      {
            return $query->where('notify', true);
      }
}
