<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SchoolAppUser extends Model implements AuthenticatableContract, JWTSubject
{
      use SoftDeletes, HasRoles, Authenticatable, HasApiTokens;

      protected $connection = 'mysql';

      protected $table = 'school_app_users';

      protected $fillable = [
            'registration_id',
            'mobile_no',
            'email',
            'password',
            'user_key',
            'notification_token',
            'check_flag',
            'switch_branch_permission',
            'is_active',
            'login_status',
            'school_id',
      ];

      protected $casts = [
            'registration_id' => 'integer',
            'check_flag' => 'integer',
            'is_active' => 'boolean',
            'login_status' => 'integer',
            'school_id' => 'integer',
      ];

      public function school()
      {
            return $this->belongsTo(AllSchool::class, 'school_id');
      }

      public function getJWTIdentifier()
      {
            return $this->getKey();
      }

      public function getJWTCustomClaims(): array
      {
            return [];
      }
}
