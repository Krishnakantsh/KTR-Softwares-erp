<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryCategory extends BaseModel
{
      use HasFactory, SoftDeletes;

      protected $fillable = [
            'school_id',
            'session_id',
            'category_name',
            'description',
            'status',
            'created_by',
            'updated_by'
      ];

      public function books()
      {
            return $this->hasMany(LibraryBook::class, 'category_id');
      }
}
