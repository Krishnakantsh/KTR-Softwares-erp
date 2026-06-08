<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanPurchaseHistory extends Model
{
    use SoftDeletes;

    protected $table = "plan_purchase_histories";


    protected $fillable = [
        'plan_id',
        'school_id',
        'next_renewable_date',
        'purchase_date',
        'renew_at',
        'grace_period',
        'status',
    ];


    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
