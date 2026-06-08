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

    public function handle()
    {
        
        $action = $this->argument('action');

        $tenants = DB::table('all_schools')
            ->where('is_active', 1)
            ->get();

        foreach ($tenants as $tenant) {

            $this->info("\n===============================");
            $this->info("Processing DB: " . $tenant->db_name);

            try {

                // ✅ STEP 1: CONNECT TENANT DB
                TenantService::connect(
                    $tenant->db_name,
                    env('DB_USERNAME'),
                    env('DB_PASSWORD')
                );

                $this->info("Connected DB: " . DB::connection()->getDatabaseName());

                // ✅ STEP 2: RUN BASED ON ACTION
                if ($action === 'rollback') {

                    Artisan::call('migrate:rollback', [
                        '--force' => true
                    ]);
                } elseif ($action === 'fresh') {

                    Artisan::call('migrate:fresh', [
                        '--force' => true
                    ]);
                } else {

                    // 🔥 THIS IS MAIN LINE (IMPORTANT)
                    Artisan::call('migrate', [
                        '--force' => true
                    ]);
                }

                // ✅ STEP 3: SHOW REAL OUTPUT
                $this->line(Artisan::output());


                TenantService::reset();

                $this->info("Done: " . $tenant->db_name);
            } catch (\Exception $e) {

                $this->error("Failed: " . $tenant->db_name);
                $this->error($e->getMessage());
            }
        }

        $this->info("\nAll tenant migrations completed.");
    }
}
// for migrate

// php artisan tenants:migrate

// for rollback

// php artisan tenants:migrate rollback