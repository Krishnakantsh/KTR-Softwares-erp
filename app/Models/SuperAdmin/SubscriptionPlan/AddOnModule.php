<?php

namespace App\Models\SuperAdmin\SubscriptionPlan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddOnModule extends Model
{
       use SoftDeletes;

  protected $fillable = [

        'name',
        'code',
        'slug',

        'description',

        'setup_fee',

        'monthly_price',
        'quarterly_price',
        'half_yearly_price',
        'yearly_price',

        'is_recurring',
        'plan_feature_id',

    
        'status',

        'sort_order',

        'metadata'
    ];

    protected $casts = [

        'setup_fee' => 'decimal:2',

        'monthly_price' => 'decimal:2',
        'quarterly_price' => 'decimal:2',
        'half_yearly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',

        'is_recurring' => 'boolean',

        'status' => 'boolean',

        'metadata' => 'array'
    ];

    public function tenantAddons()
    {
        return $this->hasMany(
            TenantAddon::class,
            'add_on_module_id'
        );
    }
}
