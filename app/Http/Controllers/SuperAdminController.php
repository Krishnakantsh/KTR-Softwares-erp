<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\AllSchool;
use App\Models\School;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPlan;
use App\Services\Auth\SchoolAppUserService;
use App\Services\TenantService;
use App\Traits\CommonCrudOperations;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Services\Subscription\TenantSubscriptionService;
use Illuminate\Http\JsonResponse;
use Throwable;

class SuperAdminController extends Controller
{

    protected $subscriptionService;

    protected const PRIVILEGE_MAP = [
        'Super Admin' => 1,
        'Admin'       => 2,
        'Staff'       => 3,
        'Student'     => 4,
    ];

    public function __construct(
        TenantSubscriptionService $subscriptionService
    ) {
        $this->subscriptionService = $subscriptionService;
    }

    use CommonCrudOperations;

    // super-admin view access 

    public function dashboard()
    {
        return view('SuperAdmin/Pages/dashboard');
    }
    public function registerManageView()
    {
        return view('SuperAdmin/Pages/school/register');
    }
    public function completeSchoolProcess()
    {
        return view('SuperAdmin/Pages/school/complete_school_process');
    }
    public function manageSubscriptionPlan()
    {
        return view('SuperAdmin/Pages/subscriptionPlan/manageSubscriptionPlan');
    }
    public function managePlanFeatures()
    {
        return view('SuperAdmin/Pages/subscriptionPlan/managePlanFeatures');
    }
    public function planFeaturesMapping()
    {
        return view('SuperAdmin/Pages/subscriptionPlan/planFeaturesMapping');
    }
    public function planChanging()
    {
        return view('SuperAdmin/Pages/subscriptionPlan/planChanging');
    }

    public function allSchools()
    {
        return view('SuperAdmin/Pages/school/allschools');
    }

    public function fetchAllSchools(Request $request)
    {
        return $this->commonFetch(AllSchool::class);
    }


    public function fetchAllTenants(Request $request)
    {
        $schools = AllSchool::with(['subscriptions' => function ($q) {
            $q->with('plan:id,name')->latest('created_at');
        }])
            ->latest()
            ->paginate(10);

        $schools->getCollection()->transform(function ($school) {

            $current = $school->subscriptions->firstWhere('status', 'active')
                ?? $school->subscriptions->first();

            $school->current_subscription = $current ? [
                'plan_name'      => $current->plan->name ?? '-',
                'status'         => $current->status,
                'billing_cycle'  => $current->billing_cycle,
                'final_amount'   => $current->final_amount,
                'start_date'     => optional($current->start_date)->format('d M Y'),
                'end_date'       => optional($current->end_date)->format('d M Y'),
                'days_remaining' => $current->end_date
                    ? now()->diffInDays($current->end_date, false)
                    : null,
            ] : null;

            unset($school->subscriptions);
            return $school;
        });

        return response()->json([
            'status' => true,
            'data'   => $schools,
        ]);
    }

    public function show(Request $request)
    {
        return $this->commonGet(AllSchool::class, [], ['id' => $request->id], null, null, null, null, 'first');
    }

    public function makeSchoolProfile(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'school_code' => 'nullable|string|max:100',
            'board'       => 'nullable|string|max:100',

            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'website'     => 'nullable|url|max:255',

            'city'        => 'nullable|string|max:100',
            'state'       => 'nullable|string|max:100',
            'pincode'     => 'nullable|string|max:10',
        ]);

        $db_name = $request->db_name;

        try {

            // connect tenant db
            TenantService::connect(
                $db_name,
                env('DB_USERNAME'),
                env('DB_PASSWORD')
            );

            // tenant transaction
            DB::beginTransaction();

            $currentSession = AcademicSession::where('is_active', true)->first();

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

                AcademicSession::create([
                    'name'       => $name,
                    'start_year' => $startYear,
                    'end_year'   => $endYear,
                    'start_date' => Carbon::create($startYear, 4, 1),
                    'end_date'   => Carbon::create($endYear, 3, 31),
                    'slug'       => Str::slug($name),
                    'status'     => true,
                    'is_active'  => true,
                ]);
            }

            $createdSchool = School::create([
                'name'        => $request->name,
                'school_code' => $request->school_code,
                'board'       => $request->board,
                'phone'       => $request->phone,
                'email'       => $request->email,
                'website'     => $request->website,
                'city'        => $request->city,
                'state'       => $request->state,
                'pincode'     => $request->pincode,
            ]);

            DB::commit();

            TenantService::reset();

            DB::beginTransaction();

            $masterSchool = AllSchool::where('db_name', $db_name)->firstOrFail();

            $masterSchool->update([
                'school_id' => $createdSchool->id,
            ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'School profile created successfully.',
            ]);
        } catch (Exception $e) {

            try {
                DB::rollBack();
            } catch (Exception $ex) {
            }

            TenantService::reset();

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function toggleStatus(Request $request)
    {

        try {
            $request->validate([
                'school_id' => 'required|exists:all_schools,id',
                'is_active' => 'required|in:1,0'
            ]);

            // find school data

            $school = $this->commonGet(AllSchool::class, [], ['id' => $request->school_id], null, null, null, null, 'first');

            $school->is_active = $request->is_active;

            $school->save();
            return response()->json([
                'status' => true,
                'message' => 'Status has been changed successfully'
            ]);
        } catch (Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function register(Request $request): JsonResponse
    {
        $id = $request->id;

        $request->validate([
            'name'       => 'required|string|max:255',
            'username'   => 'required|string|max:100|unique:all_schools,username,' . $id,
            'password'   => $id
                ? 'nullable|string|min:6|max:100'
                : 'required|string|min:6|max:100',

            'db_name'    => 'required|string|max:100|unique:all_schools,db_name,' . $id,
            'db_user'    => 'nullable|string|max:100|unique:all_schools,db_user,' . $id,
            'db_pass'    => 'nullable|string|max:100',

            'email'      => 'nullable|email|max:255|unique:all_schools,email,' . $id,
            'phone'      => 'nullable|string|max:20',

            'plan_id'    => 'nullable|exists:subscription_plans,id',
            'school_id'  => 'nullable|exists:schools,id',
            'start_date' => 'nullable|date',

            'role'       => 'nullable|in:Admin,Staff,Student',
        ]);


        return DB::transaction(function () use ($request, $id): JsonResponse {

            $schoolData = [
                'name'      => $request->name,
                'username'  => $request->username,
                'db_name'   => $request->db_name,
                'db_user'   => $request->db_user,
                'password'   => $request->password,
                'db_pass'   => $request->db_pass,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'school_id' => $request->school_id,
                'is_active' => $request->boolean('is_active', true),
            ];


            $school = AllSchool::updateOrCreate(['id' => $id], $schoolData);

            if ($school->wasRecentlyCreated && $request->filled('plan_id')) {
                $this->assignInitialSubscription($school, $request);
            }

            // NOTE: this now creates the login record in `school_app_users`
            // (central DB, tenant-agnostic — see SchoolAppUser model),
            // NOT in the `users` table. `users` is reserved for Super Admins.

            $loginData = [
                    'registration_id' => $school->id,
                    'school_id'       => schoolId(),
                    'mobile_no'       => $school->mobile,
                    'email'           => $school->email,
                    'password'        => $request->password,
                    'role'            => 'Admin',
            ];

            // $user = $this->upsertTenantUser($request, $school);

            $user =   SchoolAppUserService::createOrUpdate($loginData);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $school->wasRecentlyCreated
                    ? 'School registered successfully.'
                    : 'School updated successfully.',
                'data' => [
                    'school' => $school->fresh(),
                    'user'   => $user->load('roles'),
                ],
            ]);
        });
    }

    private function assignInitialSubscription(AllSchool $school, Request $request): void
    {

        $plan = SubscriptionPlan::findOrFail($request->plan_id);

        $isTrial = (bool) $plan->is_trial;

        $price = 0;

        switch ($request->billing_cycle) {
            case 'yearly':
                $price = $plan->yearly_price;
                break;
            case 'half_yearly':
                $price = $plan->half_yearly_price;
                break;
            case 'quarterly':
                $price = $plan->quarterly_price;
                break;
            case 'monthly':
                $price = $plan->monthly_price;
                break;
            default:
                $price = $plan->yearly_price;
                break;
        }

        $this->subscriptionService->create([
            'tenant_id'            => $school->id,
            'subscription_plan_id' => $plan->id,
            'billing_cycle'        => $request->billing_cycle,
            'start_date'           => $request->filled('start_date') ? $request->start_date : now()->toDateString(),

            'amount'               => $price,
            'discount'             => 0,
            'tax'                  => 0,

            'status'               => $isTrial ? 'trial' : 'active',

            'auto_renew'           => false,
            'is_trial'             => $isTrial,

            // Trial window — only meaningful when is_trial is true
            'trial_start_date'     => $isTrial ? now()->toDateString()          : null,
            'trial_end_date'       => $isTrial
                ? now()->addDays($plan->trial_days ?? 14)->toDateString()
                : null,

            'remarks'              => 'Initial subscription assigned on tenant registration.',
        ]);
    }
    
    // private function upsertTenantUser(Request $request, AllSchool $school): SchoolAppUser
    // {
    //     $mobileNo = $request->phone;
    //     $role     = $request->input('role', 'Admin');

    //     $userData = [
    //         'email'             => $request->email,
    //         'school_id'         => $school->id,
    //         'is_active'         => true,
    //     ];

    //     if ($request->filled('password')) {
    //         $hashed = Hash::make($request->password);

    //         $userData['password'] = $hashed;

    //         $userData['user_key'] = base64_encode($request->password);
    //     }

    //     $user = SchoolAppUser::updateOrCreate(
    //         ['mobile_no' => $mobileNo],
    //         $userData
    //     );

    //     $user->syncRoles([$role]);

    //     return $user;
    // }

    public function getSubscriptionData(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|integer'
        ]);

        $tenantId = $request->tenant_id;

        $currentPlan = DB::table('tenant_subscriptions')
            ->where('tenant_id', $tenantId)
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->first();

        if ($currentPlan) {

            $currentPlan->start_date_formatted = Carbon::parse($currentPlan->start_date)->format('d M, Y');
            $currentPlan->end_date_formatted = Carbon::parse($currentPlan->end_date)->format('d M, Y');
        }

        $history = DB::table('subscription_histories')
            ->where('tenant_id', $tenantId)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();

        $formattedHistory = $history->map(function ($item) {
            return [
                'id' => $item->id,
                'action' => $item->action,
                'amount' => $item->amount,
                'remarks' => $item->remarks,
                'created_date_formatted' => Carbon::parse($item->created_at)->format('d M Y H:i:s')
            ];
        });


        return response()->json([
            'success' => true,
            'currentPlan' => $currentPlan,
            'history' => $formattedHistory
        ]);
    }

}
