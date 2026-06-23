<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryBookRenewHistory extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'library_book_id',
            'old_due_date',
            'new_due_date',
            'remarks',
            'renewed_by'
      ];

      public function bookIssue()
      {
            return $this->belongsTo(LibraryIssue::class, 'library_book_id');
      }
}
