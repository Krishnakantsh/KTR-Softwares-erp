<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class TenantService
{

    public static function connect(
        string $dbName,
        ?string $dbUser = null,
        ?string $dbPass = null,
        bool $makeDefault = false,
    ): void {
        try {
            $mysql = config('database.connections.mysql');

            Config::set('database.connections.tenant', [
                ...$mysql,
                'url' => null,
                'database' => $dbName,
                'username' => $dbUser ?? $mysql['username'],
                'password' => $dbPass ?? $mysql['password'],
            ]);

            DB::purge('tenant');

            DB::connection('tenant')->getPdo();

            if ($makeDefault) { DB::setDefaultConnection('tenant');}

        } catch (\Throwable $e) {
            DB::purge('tenant');

            Log::error('Tenant DB Connection Error', [
                'error' => $e->getMessage(),
                'db' => $dbName,
            ]);

            throw $e;
        }
    }

    public static function setDefault(string $connection): void
    {
        if (! in_array($connection, ['mysql', 'tenant'], true)) {
            throw new InvalidArgumentException(
                "Unsupported connection: {$connection}"
            );
        }

        if ($connection === 'tenant') {
            DB::connection('tenant')->getPdo();
        }

        DB::setDefaultConnection($connection);
    }

    public static function connection(string $connection = 'mysql')
    {
        if (! in_array($connection, ['mysql', 'tenant'], true)) {
            throw new InvalidArgumentException(
                "Unsupported connection: {$connection}"
            );
        }

        return DB::connection($connection);
    }

    public static function reset(): void
    {
        DB::setDefaultConnection('mysql');

        DB::purge('tenant');

        Config::set(
            'database.connections.tenant',
            config('database.connections.tenant')
        );
    }
}
