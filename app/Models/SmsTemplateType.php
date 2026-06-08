<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsTemplateType extends BaseModel
{
      use SoftDeletes;

      protected $table = "sms_template_types";

      protected $fillable = [
            'name',
            'slug',
            'status',
            'session_id'
      ];

      protected $primaryKey = "id";

      public function templates()
      {
            return $this->hasMany(
                  SmsTemplate::class,
                  'template_typeId',
                  'id'
            );
      }
}
