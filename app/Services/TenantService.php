<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TenantService
{

    public static function connect(string $dbName, ?string $dbUser = null, ?string $dbPass = null)
    {
        try {

            Config::set('database.connections.tenant', [
                'driver' => 'mysql',
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT'),
                'database' => $dbName,
                'username' => $dbUser ?? env('DB_USERNAME'),
                'password' => $dbPass ?? env('DB_PASSWORD'),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'strict' => true,
                'engine' => null,
            ]);

            DB::purge('tenant');
            DB::reconnect('tenant');

            DB::setDefaultConnection('tenant');
            
        } catch (\Exception $e) {

            Log::error('Tenant DB Connection Error', [
                'error' => $e->getMessage(),
                'db' => $dbName
            ]);

            throw $e;
        }
    }


    // public static function reset()
    // {
    //     DB::setDefaultConnection(config('database.default'));
    // }

    public static function reset()
{
    DB::purge('tenant');
    DB::setDefaultConnection(config('database.default'));
}
}
