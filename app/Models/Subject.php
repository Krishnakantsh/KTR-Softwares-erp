<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends BaseModel
{
    use SoftDeletes;

    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'slug',
        'session_id',
        'status',
        'subject_group_id'
    ];

    protected $primary_key = "id";

    public function group()
    {
        return $this->belongsTo(SubjectGroup::class, 'subject_group_id');
    }

    public function classes()
    {
        return $this->belongsToMany(ClassMaster::class, 'subject_links', 'subject_id', 'class_id')
            ->withPivot('status')
            ->withTimestamps();
    }
}
