<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AcademicSession;
use App\Services\TenantService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AutoGenerateAcademicSession extends Command
{
    protected $signature = 'academic:auto-session';

    protected $description = 'Auto create new academic session every year';

    public function handle()
    {
        $this->info('==============================');
        $this->info('Academic Session Command Start');
        $this->info('==============================');

        /*
        |--------------------------------------------------------------------------
        | GET ALL ACTIVE TENANTS
        |--------------------------------------------------------------------------
        */

        $tenants = DB::table('all_schools')
            ->where('is_active', 1)
            ->get();


        if ($tenants->isEmpty()) {
            $this->error('No active tenants found');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | LOOP ALL TENANTS
        |--------------------------------------------------------------------------
        */

        foreach ($tenants as $tenant) {

            DB::beginTransaction();

            try {

                $this->info('');
                $this->info('========================================');
                $this->info('Processing Tenant : ' . $tenant->db_name);
                $this->info('========================================');

                /*
                |--------------------------------------------------------------------------
                | CONNECT TENANT DATABASE
                |--------------------------------------------------------------------------
                */

                TenantService::connect(
                    $tenant->db_name,
                    env('DB_USERNAME'),
                    env('DB_PASSWORD')
                );

                $this->info('Connected Database : ' . DB::connection()->getDatabaseName());

                /*
                |--------------------------------------------------------------------------
                | CHECK ACTIVE SESSION
                |--------------------------------------------------------------------------
                */

                $currentSession = AcademicSession::where('is_active', true)->first();

                if ($currentSession) {

                    $this->info('Active Session Found : ' . $currentSession->name);

                } else {

                    $this->info('No Active Session Found');
                }

                /*
                |--------------------------------------------------------------------------
                | FIRST TIME SESSION CREATE
                |--------------------------------------------------------------------------
                */

                if (!$currentSession) {

                    $currentYear = now()->year;

                    if (now()->month < 4) {

                        $startYear = $currentYear - 1;
                        $endYear = $currentYear;

                    } else {

                        $startYear = $currentYear;
                        $endYear = $currentYear + 1;
                    }

                    $name = $startYear . '-' . $endYear;

                    $this->info('Creating First Session : ' . $name);

                    $session = AcademicSession::create([

                        'name' => $name,

                        'start_year' => $startYear,
                        'end_year' => $endYear,

                        'start_date' => Carbon::create($startYear, 4, 1),
                        'end_date' => Carbon::create($endYear, 3, 31),

                        'slug' => Str::slug($name),

                        'status' => true,
                        'is_active' => true
                    ]);

                    $this->info('Session Created Successfully');
                    $this->info('Session ID : ' . $session->id);

                    DB::commit();

                    $this->info('Tenant Completed : ' . $tenant->db_name);

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | CREATE NEW SESSION ONLY ON 1 APRIL
                |--------------------------------------------------------------------------
                */

                if (!(now()->month == 4 && now()->day == 1)) {

                    $this->info('Today is not session creation day');

                    DB::commit();

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | NEXT SESSION CALCULATION
                |--------------------------------------------------------------------------
                */

                $newStartYear = $currentSession->start_year + 1;
                $newEndYear = $currentSession->end_year + 1;

                $newName = $newStartYear . '-' . $newEndYear;

                $this->info('Next Session Name : ' . $newName);

                /*
                |--------------------------------------------------------------------------
                | CHECK SESSION EXISTS
                |--------------------------------------------------------------------------
                */

                $alreadyExists = AcademicSession::where('name', $newName)->exists();

                if ($alreadyExists) {

                    $this->info('Session Already Exists');

                    DB::commit();

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | DEACTIVATE OLD SESSION
                |--------------------------------------------------------------------------
                */

                AcademicSession::where('is_active', true)
                    ->update([
                        'is_active' => false
                    ]);

                $this->info('Old Active Session Deactivated');

                /*
                |--------------------------------------------------------------------------
                | CREATE NEW SESSION
                |--------------------------------------------------------------------------
                */

                $newSession = AcademicSession::create([

                    'name' => $newName,

                    'start_year' => $newStartYear,
                    'end_year' => $newEndYear,

                    'start_date' => Carbon::create($newStartYear, 4, 1),
                    'end_date' => Carbon::create($newEndYear, 3, 31),

                    'slug' => Str::slug($newName),

                    'status' => true,
                    'is_active' => true
                ]);

                $this->info('New Session Created Successfully');
                $this->info('New Session ID : ' . $newSession->id);

                DB::commit();

                $this->info('Tenant Completed : ' . $tenant->db_name);

            } catch (\Exception $e) {

                DB::rollBack();

                $this->error('');
                $this->error('========================================');
                $this->error('TENANT FAILED : ' . $tenant->db_name);
                $this->error('========================================');

                $this->error('ERROR : ' . $e->getMessage());
                $this->error('LINE : ' . $e->getLine());
                $this->error('FILE : ' . $e->getFile());

            } finally {

                /*
                |--------------------------------------------------------------------------
                | RESET TENANT CONNECTION
                |--------------------------------------------------------------------------
                */

                TenantService::reset();

                $this->info('Tenant Connection Reset');
            }
        }

        $this->info('');
        $this->info('================================');
        $this->info('Academic Session Command Finished');
        $this->info('================================');
    }
}