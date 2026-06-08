<?php

namespace App\Models\Hostel_System;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends BaseModel
{
    use SoftDeletes;

    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany(RoomMaster::class);
    }
}