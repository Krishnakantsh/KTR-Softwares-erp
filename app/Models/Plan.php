<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $table = "plans";

    protected $fillable = [
        'plan_name',
        'plane_code',
        'slug',
        'pricing',
        'min_pricing',
        'status',
    ];
}
