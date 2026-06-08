<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getConnectionName()
    {

        if (session()->has('tenant_db')) {
            return 'tenant';
        }

        return config('database.default');
    }
}
