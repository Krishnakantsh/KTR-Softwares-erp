<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TenantInitializer
{
    public static function syncSchool($company): void
    {
        try {
           
            if (empty($company->email)) {
                Log::warning('Tenant sync skipped: Email missing for company ID ' . ($company->id ?? 'N/A'));
                return;
            }

            $data = [
                'name'  => $company->name ?? 'N/A',
                'phone' => $company->phone ?? null,
            ];

            DB::connection('tenant')->transaction(function () use ($company, $data) {

                DB::connection('tenant')
                    ->table('schools')
                    ->updateOrInsert(
                        ['email' => $company->email], 
                        array_merge($data, [
                            'updated_at' => now(),
                        ])
                    );
            });

        } catch (\Exception $e) {
         
            Log::error('Tenant syncSchool failed: ' . $e->getMessage(), [
                'company_id' => $company->id ?? null,
                'email'      => $company->email ?? null,
            ]);
        }
    }
}