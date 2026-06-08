<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsTemplate extends BaseModel
{
      use SoftDeletes;

      protected $table = "sms_templates";

      protected $fillable = [
            'template_typeId',
            'template_id',
            'template_title',
            'template_language',
            'template_company',
            'template_senderId',
            'sms',
            'status',
            'session_id'
      ];

      protected $primary_key = "id";

      public function templateType()
      {
            return $this->belongsTo(
                  SmsTemplateType::class,
                  'template_typeId',
                  'id'
            );
      }
}
