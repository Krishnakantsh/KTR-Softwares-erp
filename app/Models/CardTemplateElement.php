<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardTemplateElement extends Model
{
    protected $fillable = [

        'card_template_id',
        'side',
        'element_name',
        'element_type',
        'element_value',
        'x',
        'y',
        'width',
        'height',
        'rotation',
        'z_index',
        'font_family',
        'font_size',
        'font_weight',
        'text_color',
        'background_color',
        'text_align',
        'is_locked',
        'is_hidden'
    ];

    public function template()
    {
        return $this->belongsTo(
            CardTemplate::class,
            'card_template_id'
        );
    }
}