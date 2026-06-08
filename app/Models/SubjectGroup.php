<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectGroup extends BaseModel
{
    use SoftDeletes;

    protected $table = 'subject_groups';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'session_id',
        'status'
    ];

    protected $casts = [];

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'subject_group_id');
    }
}
