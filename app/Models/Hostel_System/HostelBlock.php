<?php

namespace App\Models\Hostel_System;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class HostelBlock extends BaseModel
{
    use SoftDeletes;

    protected $guarded = [];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
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