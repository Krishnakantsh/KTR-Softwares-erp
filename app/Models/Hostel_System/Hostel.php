<?php

namespace App\Models\Hostel_System;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hostel extends BaseModel
{
    use SoftDeletes;

    protected $guarded = [];

    public function blocks()
    {
        return $this->hasMany(HostelBlock::class);
    }

    public function floors()
    {
        return $this->hasMany(HostelFloor::class);
    }

    public function rooms()
    {
        return $this->hasMany(RoomMaster::class);
    }
}