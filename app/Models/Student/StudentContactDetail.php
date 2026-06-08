<?php

namespace App\Models\Student;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentContactDetail extends BaseModel
{
    use SoftDeletes;

    protected $table = 'student_contact_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',

        'present_address',
        'present_city',
        'present_postal_code',

        'permanent_address',
        'permanent_city',
        'permanent_postal_code',

        'post_office',
        'police_station',
        'district',
        'tehsil',

        'birth_place',
        'country',

        'contact_person_phone',
        'contact_person_email',
        'contact_person_address',
    ];

    protected $casts = [];

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }
}