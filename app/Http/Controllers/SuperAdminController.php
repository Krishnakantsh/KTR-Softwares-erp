<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\AllSchool;
use App\Models\School;
use App\Models\SchoolAppUser;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPlan;
use App\Services\Auth\SchoolAppUserService;
use App\Services\TenantService;
use App\Traits\CommonCrudOperations;
use App\Traits\DatabaseConnectionWriter;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Services\Subscription\TenantSubscriptionService;
use Illuminate\Http\JsonResponse;
use Throwable;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;



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

    use CommonCrudOperations, DatabaseConnectionWriter;

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
        $id = $request->input('id');

        $validator = Validator::make($request->all(), [
            'id' => [
                'nullable',
                'integer',
                'min:1',
                Rule::exists('all_schools', 'id'),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'username' => [
                'required',
                'string',
                'max:100',
                Rule::unique('all_schools', 'username')->ignore($id),
            ],

            'password' => [
                $id ? 'nullable' : 'required',
                'string',
                'min:8',
                'max:100',
            ],

            'db_name' => [
                'required',
                'string',
                'max:64',
                'regex:/^[a-zA-Z0-9_]+$/',
                Rule::unique('all_schools', 'db_name')->ignore($id),
            ],

            'db_group' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[a-zA-Z][a-zA-Z0-9_]*$/',
                Rule::notIn([
                    'default',
                    'mysql',
                    'tenant',
                    'sqlite',
                    'pgsql',
                    'redis',
                ]),
            ],

            'db_user' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('all_schools', 'db_user')->ignore($id),
            ],

            'db_pass' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email:rfc',
                'max:255',
                Rule::unique('all_schools', 'email')->ignore($id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'plan_id' => [
                'nullable',
                'integer',
                Rule::exists('subscription_plans', 'id'),
            ],

            'school_id' => [
                'nullable',
                'integer',
                Rule::exists('schools', 'id'),
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'role' => [
                'nullable',
                Rule::in(['Admin', 'Staff', 'Student']),
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ]);

        $validator->after(function ($validator) use ($request, $id) {
            $dbGroup = $request->input('db_group');

            if (!$dbGroup && $request->filled('name')) {
                $dbGroup = Str::slug($request->input('name'), '_');
            }

            if ($dbGroup && !preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $dbGroup)) {
                $validator->errors()->add(
                    'db_group',
                    'The generated database connection name is invalid.'
                );

                return;
            }

            if ($dbGroup && config("database.connections.{$dbGroup}") && !$id) {
                $validator->errors()->add(
                    'db_group',
                    'This database connection name is already configured.'
                );
            }
        });

        $validated = $validator->validate();

        $school = $id ? AllSchool::findOrFail($id) : new AllSchool();

        $connectionName = $validated['db_group']
            ?? Str::slug($validated['name'], '_');

        if (isset(config('database.connections')[$connectionName]) && !$id) {
            throw ValidationException::withMessages([
                'db_group' => ['This connection name already exists.'],
            ]);
        }

        $oldConnectionEntry = null;
        $connectionFileChanged = false;

        try {
            $school = DB::transaction(function () use (
                $validated,
                $school,
                $request,
                $connectionName,
                &$oldConnectionEntry,
                &$connectionFileChanged
            ) {
                $school->name = $validated['name'];
                $school->username = $validated['username'];
                $school->db_name = $validated['db_name'];

                if (array_key_exists('db_user', $validated)) {
                    $school->db_user = $validated['db_user'];
                }

                if (!empty($validated['password'])) {
                    $school->password = Hash::make($validated['password']);
                }

                if (array_key_exists('db_pass', $validated)) {
                    $school->db_pass = $validated['db_pass'];
                }

                $school->email = $validated['email'] ?? null;
                $school->phone = $validated['phone'] ?? null;
                $school->school_id = $validated['school_id'] ?? null;

                if (array_key_exists('is_active', $validated)) {
                    $school->is_active = $validated['is_active'];
                } elseif (!$school->exists) {
                    $school->is_active = true;
                }

                $school->save();

                if ($school->wasRecentlyCreated && !empty($validated['plan_id'])) {
                    $this->assignInitialSubscription($school, $request);
                }

                $oldConnectionEntry = config(
                    "database.connections.{$connectionName}"
                );

                $this->addConnection(
                    $connectionName,
                    $validated['db_name'],
                    $validated['db_user'] ?? '',
                    $validated['db_pass'] ?? ''
                );

                $connectionFileChanged = true;

                $loginData = [
                    'registration_id' => $school->id,
                    'school_id' => $school->id,
                    'mobile_no' => $school->phone,
                    'email' => $school->email,
                    'role' => $validated['role'] ?? 'Admin',
                ];

                if (!empty($validated['password'])) {
                    $loginData['password'] = $validated['password'];
                }

                $user = SchoolAppUserService::createOrUpdate($loginData);

                return $school->fresh();
            });

            return response()->json([
                'status' => true,
                'message' => $school->wasRecentlyCreated
                    ? 'School registered successfully.'
                    : 'School updated successfully.',
                'data' => [
                    'school' => $school,
                ],
            ]);
        } catch (Throwable $e) {
            report($e);

            // A database transaction cannot roll back filesystem changes.
            // Implement a dedicated, locked file rollback method here
            // if addConnection() modified database.php before the failure.

            return response()->json([
                'status' => false,
                'message' => 'School registration/update failed.',
            ], 500);
        }
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

    public function updatePassword(Request $request)
    {
        try {
            $validated = $request->validate([
                'old_pass' => ['required', 'string'],
                'new_pass' => ['required', 'string', 'min:8', 'max:12'],
                'confirm_new_pass' => ['required','string','same:new_pass',],
                'emp_id' => ['required'],
                'school_id' => ['required', 'integer'],
            ]);

            $appUser = SchoolAppUser::where(
                'registration_id',
                $validated['emp_id']
            )
            ->first();

            if (!$appUser) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found.',
                ], 404);
            }

            // Verify the existing password
            if (!Hash::check($validated['old_pass'], $appUser->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Old password does not match our records.',
                ], 422);
            }

            // Prevent changing to the same password
            if (Hash::check($validated['new_pass'], $appUser->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'New password must be different from the old password.',
                ], 422);
            }

            $appUser->password = Hash::make($validated['new_pass']);

            $appUser->save();

            return response()->json([
                'status' => true,
                'message' => 'Password has been updated successfully.',
            ]);


        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $th) {
            report($th);

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }
}
