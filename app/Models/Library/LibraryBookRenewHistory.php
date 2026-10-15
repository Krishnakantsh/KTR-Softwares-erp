<?php

namespace App\Models\Library;

use App\Models\BaseModel;


class LibraryBookRenewHistory extends BaseModel
{

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
