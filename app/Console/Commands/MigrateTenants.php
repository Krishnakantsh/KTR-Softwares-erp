<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Services\TenantService;

class MigrateTenants extends Command
{
    protected $signature = 'tenants:migrate {action=migrate}';
    protected $description = 'Run migrations for all tenant databases';

    // public function handle()
    // {

    //     $action = $this->argument('action');

    //     // $path = 'database/migrations/tenant';
    //     $path = 'database/migrations/tenant/Tasks';

    //     $tenants = DB::table('all_schools')
    //         ->where('is_active', 1)
    //         ->get();

    //     foreach ($tenants as $tenant) {

    //         $this->info("\n===============================");
    //         $this->info("Processing DB: " . $tenant->db_name);

    //         try {

    //             TenantService::connect(
    //                 $tenant->db_name,
    //                 env('DB_USERNAME'),
    //                 env('DB_PASSWORD')
    //             );

    //             $this->info("Connected DB: " . DB::connection()->getDatabaseName());


    //             if ($action === 'rollback') {

    //                 Artisan::call('migrate:rollback', [
    //                     '--force' => true,
    //                     '--path' => $path,
    //                 ]);
    //             } elseif ($action === 'fresh') {

    //                 Artisan::call('migrate:fresh', [
    //                     '--force' => true,
    //                     '--path' => $path,
    //                 ]);
    //             } else {


    //                 Artisan::call('migrate', [
    //                     '--force' => true,
    //                     '--path' => $path,
    //                 ]);
    //             }


    //             $this->line(Artisan::output());


    //             TenantService::reset();

    //             $this->info("Done: " . $tenant->db_name);
    //         } catch (\Exception $e) {

    //             $this->error("Failed: " . $tenant->db_name);
    //             $this->error($e->getMessage());
    //         }
    //     }

    //     $this->info("\nAll tenant migrations completed.");
    // }

    public function handle()
    {
        $action = $this->argument('action');
        $path = 'database/migrations/tenant/Tasks';

        $tenants = DB::connection('mysql')
            ->table('all_schools')
            ->where('is_active', 1)
            ->get();

        foreach ($tenants as $tenant) {
            $this->newLine();
            $this->info('===============================');
            $this->info('Processing DB: ' . $tenant->db_name);

            try {
                TenantService::connect(
                    $tenant->db_name,
                    $tenant->db_user ?: env('DB_USERNAME'),
                    $tenant->db_pass ?: env('DB_PASSWORD')
                );

                // Verify the actual tenant connection
                $connection = DB::connection('tenant');
                $connection->getPdo();

                $this->info(
                    'Connected DB: ' . $connection->getDatabaseName()
                );

                if ($connection->getDatabaseName() !== $tenant->db_name) {
                    throw new \RuntimeException(
                        'Tenant database mismatch. Expected: '
                            . $tenant->db_name
                            . ', Connected: '
                            . $connection->getDatabaseName()
                    );
                }

                $options = [
                    '--database' => 'tenant',
                    '--path' => $path,
                    '--force' => true,
                ];

                if ($action === 'rollback') {
                    Artisan::call('migrate:rollback', $options);
                } elseif ($action === 'fresh') {
                    Artisan::call('migrate:fresh', $options);
                } elseif ($action === 'migrate') {
                    Artisan::call('migrate', $options);
                } else {
                    throw new \InvalidArgumentException(
                        'Invalid action: ' . $action
                    );
                }

                $this->line(Artisan::output());
                $this->info('Done: ' . $tenant->db_name);
            } catch (\Throwable $e) {
                $this->error('Failed: ' . $tenant->db_name);
                $this->error($e->getMessage());
            } finally {
                TenantService::reset();
            }
        }

        $this->info("\nTenant migration process completed.");

        return self::SUCCESS;
    }
}
// for migrate

// php artisan tenants:migrate

// for rollback

// php artisan tenants:migrate rollback