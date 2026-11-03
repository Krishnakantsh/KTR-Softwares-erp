<?php


namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TenantService
{
    public static function connect(
        string $dbName,
        ?string $dbUser = null,
        ?string $dbPass = null
    ) {
        try {

            Config::set('database.connections.tenant', [
                'driver' => 'mysql',

                'host' => config(
                    'database.connections.mysql.host',
                    '127.0.0.1'
                ),

                'port' => config(
                    'database.connections.mysql.port',
                    '3306'
                ),

                'database' => $dbName,

                'username' => $dbUser ?? config(
                    'database.connections.mysql.username'
                ),

                'password' => $dbPass ?? config(
                    'database.connections.mysql.password'
                ),

                'unix_socket' => config(
                    'database.connections.mysql.unix_socket',
                    ''
                ),

                'charset' => 'utf8mb4',

                'collation' => 'utf8mb4_unicode_ci',

                'prefix' => '',

                'prefix_indexes' => true,

                'strict' => true,

                'engine' => null,
            ]);

            DB::purge('tenant');

            DB::reconnect('tenant');

            DB::setDefaultConnection('tenant');
        } catch (\Throwable $e) {

            Log::error('Tenant DB Connection Error', [
                'error' => $e->getMessage(),
                'db' => $dbName,
            ]);

            throw $e;
        }
    }

    public static function reset()
    {
        DB::purge('tenant');

        DB::setDefaultConnection('mysql');

        DB::purge('mysql');

        DB::reconnect('mysql');
    }
}
