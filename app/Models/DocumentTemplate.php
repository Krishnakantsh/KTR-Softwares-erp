<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentTemplate extends Model
{
      use SoftDeletes;
      
      protected $fillable = [
            'school_id',
            'session_id',
            'document_category_id',
            'template_name',
            'template_code',
            'description',
            'orientation',
            'page_size',
            'width',
            'height',
            'background_image',
            'header_image',
            'footer_image',
            'watermark_image',
            'html_content',
            'css_content',
            'js_content',
            'show_header',
            'show_footer',
            'show_page_number',
            'is_default',
            'status',
            'created_by',
            'updated_by'
      ];

      public function category()
      {
            return $this->belongsTo(
                  DocumentCategory::class,
                  'document_category_id',
                  'id'
            );
      }

      public function school()
      {
            return $this->belongsTo(
                  School::class,
                  'school_id',
                  'id'
            );
      }

      public function session()
      {
            return $this->belongsTo(
                  AcademicSession::class,
                  'session_id',
                  'id'
            );
      }
}
