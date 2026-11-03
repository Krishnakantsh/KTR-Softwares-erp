<?php

namespace App\Models\Complaints;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ComplaintStatusHistory extends BaseModel
{
      use HasFactory;

      protected $fillable = [
            'complaint_id',
            'old_status',
            'new_status',
            'remarks',
            'changed_by_type',
            'changed_by_id',
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
    | Complaint Status
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

      public function complaint()
      {
            return $this->belongsTo(Complaint::class);
      }

      /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

      public static function statusList()
      {
            return [
                  self::OPEN          => 'Open',
                  self::UNDER_REVIEW  => 'Under Review',
                  self::IN_PROGRESS   => 'In Progress',
                  self::RESOLVED      => 'Resolved',
                  self::CLOSED        => 'Closed',
                  self::REOPENED      => 'Reopened',
                  self::REJECTED      => 'Rejected',
            ];
      }
}
