<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LibraryIssue extends BaseModel
{
      use SoftDeletes;

      protected $table = 'library_issues';

      protected $primaryKey = 'id';

      protected $fillable = [
            'school_id',
            'session_id',
            'book_id',
            'member_type',
            'member_id',
            'issue_date',
            'due_date',
            'return_date',
            'issue_days',
            'fine_amount',
            'gst_amount',
            'total_fine_amount',
            'status',
            'remarks',
            'created_by',
            'updated_by',
      ];

      protected $casts = [
            'school_id'         => 'integer',
            'session_id'        => 'integer',
            'book_id'           => 'integer',
            'member_id'         => 'integer',
            'issue_date'        => 'date',
            'due_date'          => 'date',
            'return_date'       => 'date',
            'issue_days'        => 'integer',
            'fine_amount'       => 'decimal:2',
            'gst_amount'        => 'decimal:2',
            'total_fine_amount' => 'decimal:2',
            'created_by'        => 'integer',
            'updated_by'        => 'integer',
      ];


      public function book(): BelongsTo
      {
            return $this->belongsTo(LibraryBook::class, 'book_id');
      }


      public function school(): BelongsTo
      {
            return $this->belongsTo(School::class, 'school_id');
      }


      public function session(): BelongsTo
      {
            return $this->belongsTo(AcademicSession::class, 'session_id');
      }


      public function createdBy(): BelongsTo
      {
            return $this->belongsTo(User::class, 'created_by');
      }


      public function updatedBy(): BelongsTo
      {
            return $this->belongsTo(User::class, 'updated_by');
      }


      public function student(): BelongsTo
      {
            return $this->belongsTo(Student::class, 'member_id');
      }

      // staff

      //     public function staff(): BelongsTo
      //     {
      //         return $this->belongsTo(Employee::class, 'member_id');
      //     }

      // member dynamic

      public function getMemberAttribute()
      {
            return $this->member_type === 'student'
                  ? $this->student
                  : $this->staff;
      }


      public function getIsReturnedAttribute(): bool
      {
            return $this->status === 'returned';
      }


      public function getIsOverdueAttribute(): bool
      {
            return $this->status === 'issued'
                  && now()->gt($this->due_date);
      }

      public function getOverdueDaysAttribute(): int
      {
            if (!$this->is_overdue) {
                  return 0;
            }

            return now()->diffInDays($this->due_date);
      }
}
