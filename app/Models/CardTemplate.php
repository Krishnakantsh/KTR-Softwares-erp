<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardTemplate extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'school_id',
        'template_name',
        'card_type',
        'card_size',
        'width',
        'height',
        'front_background',
        'back_background',
        'logo',
        'watermark',
        'theme_color',
        'is_default',
        'status'
    ];

    public function elements()
    {
        return $this->hasMany(
            CardTemplateElement::class
        );
    }
}