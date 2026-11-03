<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
      public function getConnectionName()
    {
        if ($this->connection !== null) {
            return $this->connection;
        }

        if (request()->is('api/*')) {
            return 'tenant';
        }
        
        if (session()->has('tenant_db')) {
            return 'tenant';
        }

        return config('database.default', 'mysql');
    }
}
