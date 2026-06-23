<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LibraryDamage extends BaseModel
{
      use SoftDeletes;

      protected $table = 'library_damages';

      protected $primaryKey = 'id';

      protected $fillable = [
            'school_id',
            'session_id',
            'book_id',
            'quantity',
            'damage_date',
            'remarks',
            'created_by',
            'updated_by',
      ];

      protected $casts = [
            'school_id'   => 'integer',
            'session_id'  => 'integer',
            'book_id'     => 'integer',
            'quantity'    => 'integer',
            'damage_date' => 'date',
            'created_by'  => 'integer',
            'updated_by'  => 'integer',
      ];

      // book

      public function book(): BelongsTo
      {
            return $this->belongsTo(LibraryBook::class, 'book_id');
      }

      // school

      public function school(): BelongsTo
      {
            return $this->belongsTo(School::class, 'school_id');
      }

      // session

      public function session(): BelongsTo
      {
            return $this->belongsTo(AcademicSession::class, 'session_id');
      }

      // created by

      public function createdBy(): BelongsTo
      {
            return $this->belongsTo(User::class, 'created_by');
      }

      // updated by

      public function updatedBy(): BelongsTo
      {
            return $this->belongsTo(User::class, 'updated_by');
      }
}
