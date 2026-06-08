<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentCategory extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'name',
            'slug',
            'description',
            'status',
            'session_id'
      ];

      public function templates()
      {
            return $this->hasMany(
                  DocumentTemplate::class,
                  'document_category_id',
                  'id'
            );
      }
}
