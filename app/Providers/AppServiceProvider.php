<?php

namespace App\Providers;

use App\Models\SuperAdmin\Broadcast\Broadcast;
use App\Services\TenantService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
        View::composer('*', function ($view) {

            TenantService::connect(
                config('database.connections.mysql.database'),
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password')
            );

            if (!Auth::check() || app()->runningInConsole()) {
                return;
            }

            $user = Auth::user();

            if ($user->hasRole('Super Admin') || $user->hasRole('Staff')) {
                return;
            }

            if ($user->email) {
                $company = DB::table('all_schools')
                    ->where('username', $user->email)
                    ->first();

                $tenantId = $company->id;

                $now = Carbon::now();


                $activeBroadcast = Broadcast::where('status', 'active')
                    ->where('start_date', '<=', $now->toDateString())
                    ->where('end_date', '>=', $now->toDateString())
                    ->where(function ($query) use ($tenantId) {
                        $query->where('audience_type', 'all')
                            ->orWhere(function ($q) use ($tenantId) {
                                $q->where('audience_type', 'selected')
                                    ->whereJsonContains('tenant_json', (string)$tenantId);
                            });
                    })
                    ->whereDoesntHave('views', function ($query) use ($user, $tenantId) {
                        $query->where('tenant_id', $tenantId)
                            ->where('user_id', $user->id)
                            ->where(function ($q) {
                                $q->whereNotNull('dismissed_at')
                                    ->orWhereNotNull('acknowledged_at');
                            });
                    })
                    ->orderByRaw("
                    CASE priority
                        WHEN 'critical' THEN 1
                        WHEN 'high' THEN 2
                        WHEN 'normal' THEN 3
                        WHEN 'low' THEN 4
                        ELSE 5
                    END
                ")
                    ->orderBy('display_order')
                    ->first();

                $view->with('currentBroadcast', $activeBroadcast);
            }



            //  TenantService::reset();



        });
    }
}
