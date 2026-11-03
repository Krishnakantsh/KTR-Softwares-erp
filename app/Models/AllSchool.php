<?php

namespace App\Models;

use App\Models\SuperAdmin\Modules\SchoolModuleSetting;
use App\Models\SuperAdmin\Notification\NotificationLog;
use App\Models\SuperAdmin\SubModules\SchoolSubModuleSetting;
use App\Models\SuperAdmin\SubModules\SubModulesMaster;
use App\Models\SuperAdmin\SubscriptionPlan\FeatureOverride;
use App\Models\SuperAdmin\SubscriptionPlan\RenewalReminder;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionCouponUsage;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionInvoice;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPayment;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionTransaction;
use App\Models\SuperAdmin\SubscriptionPlan\TenantAddon;
use App\Models\SuperAdmin\SubscriptionPlan\TenantSubscription;
use App\Models\SuperAdmin\SubscriptionPlan\TenantUsage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllSchool extends Model
{
    use SoftDeletes;

    protected $table = 'all_schools';

    protected $connection = 'mysql';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'username',
        'password',

        'db_name',
        'db_pass',
        'db_user',

        'plan_id',
        'school_id',

        'start_date',
        'valid_upto',
        'grace_period',

        'is_active',

        'email',
        'phone',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'valid_upto' => 'date',
    ];

    public function subscriptions()
    {
        return $this->hasMany(
            TenantSubscription::class,
            'tenant_id',
            'id'
        );
    }

    public function invoices()
    {
        return $this->hasMany(
            SubscriptionInvoice::class
        );
    }

    public function payments()
    {
        return $this->hasMany(
            SubscriptionPayment::class
        );
    }

    public function couponUsages()
    {
        return $this->hasMany(
            SubscriptionCouponUsage::class
        );
    }

    public function addons()
    {
        return $this->hasMany(
            TenantAddon::class
        );
    }

    public function featureOverrides()
    {
        return $this->hasMany(
            FeatureOverride::class
        );
    }

    public function usage()
    {
        return $this->hasOne(
            TenantUsage::class
        );
    }

    public function transactions()
    {
        return $this->hasMany(
            SubscriptionTransaction::class
        );
    }

    public function renewalReminders()
    {
        return $this->hasMany(
            RenewalReminder::class
        );
    }

    public function notificationLogs()
    {
        return $this->hasMany(
            NotificationLog::class
        );
    }

    public function modules()
    {
        return $this->hasMany(
            SchoolModuleSetting::class,
            'school_id',
            'id'
        );
    }


    public function subModules()
    {
        return $this->hasMany(
            SchoolSubModuleSetting::class,
            'school_id',
            'id'
        );
    }
}
