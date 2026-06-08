<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends BaseModel
{

    use SoftDeletes;

    protected $table = "schools";

    protected $fillable = [
        'name',
        'school_code',
        'medium',
        'udies_no',
        'affli_no',
        'board',
        'category',
        'type',
        'adm_start',
        'adm_end',
        'phone',
        'email',
        'website',
        'address',
        'city',
        'state',
        'pincode',
        'latitude',
        'longitude',
        'principal_name',
        'tc_title',
        'fee_receipt_note',
        'tagline1',
        'tagline2',
        'facebook',
        'instagram',
        'youtube',
        'app_android_url',
        'app_ios_url',
        'app_fee_url',
        'app_window_url'
    ];

    public function planHistory()
    {
        return $this->hasMany(PlanPurchaseHistory::class);
    }
}
