<?php

namespace App\Models\Complaints;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintType extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_id',
        'complaint_for',
        'type_name',
        'description',
        'default_priority',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Complaint For
    |--------------------------------------------------------------------------
    */

    const FOR_ADMIN = 1;
    const FOR_STAFF = 2;
    const FOR_STUDENT = 3;

    /*
    |--------------------------------------------------------------------------
    | Priority
    |--------------------------------------------------------------------------
    */

    const LOW = 1;
    const MEDIUM = 2;
    const HIGH = 3;
    const CRITICAL = 4;

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeForAdmin($query)
    {
        return $query->where('complaint_for', self::FOR_ADMIN);
    }

    public function scopeForStaff($query)
    {
        return $query->where('complaint_for', self::FOR_STAFF);
    }

    public function scopeForStudent($query)
    {
        return $query->where('complaint_for', self::FOR_STUDENT);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public static function priorityList()
    {
        return [
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
            self::CRITICAL => 'Critical',
        ];
    }

    public static function complaintForList()
    {
        return [
            self::FOR_ADMIN => 'Admin',
            self::FOR_STAFF => 'Staff',
            self::FOR_STUDENT => 'Student',
        ];
    }
}
