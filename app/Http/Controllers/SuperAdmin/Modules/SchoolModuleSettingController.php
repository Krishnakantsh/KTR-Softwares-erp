<?php

namespace App\Http\Controllers\SuperAdmin\Modules;

use App\Http\Controllers\Controller;
use App\Models\AllSchool;
use App\Models\SuperAdmin\Modules\ModulesMaster;
use App\Models\SuperAdmin\Modules\SchoolModuleSetting;
use App\Traits\CommonCrudOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class SchoolModuleSettingController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('SuperAdmin.Pages.Modules.AssignModuleToSchool');
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required|exists:all_schools,id',
            'modules' => 'nullable|array',
            'modules.*' => 'exists:modules_masters,id',
        ]);

        DB::beginTransaction();

        try {

            $schoolId = $request->school_id;
            $selectedModules = $request->modules ?? [];

            if (count($selectedModules)) {

                SchoolModuleSetting::where('school_id', $schoolId)
                    ->whereNotIn('module_id', $selectedModules)
                    ->delete();
            } else {

                SchoolModuleSetting::where('school_id', $schoolId)->delete();
            }

            if (!empty($selectedModules)) {

                $now = now();

                $records = [];

                foreach ($selectedModules as $moduleId) {

                    $records[] = [
                        'school_id'  => $schoolId,
                        'module_id'  => $moduleId,
                        'is_active'  => 1,
                        'is_disable' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                SchoolModuleSetting::upsert(
                    $records,
                    ['school_id', 'module_id'],
                    [
                        'is_active',
                        'is_disable',
                        'updated_at'
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Tenant modules synchronized successfully.',
            ]);
        } catch (Throwable $th) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            SchoolModuleSetting::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            SchoolModuleSetting::class,
            ['module']
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            SchoolModuleSetting::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            SchoolModuleSetting::class,
            $request,
            ['module']
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            SchoolModuleSetting::class,
            $request
        );
    }


    // extra routes 

    public function ModuleMapping(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required|exists:all_schools,id'
            ]);


            $allModules = $this->commonFetch(
                ModulesMaster::class,
                [],
                [],
                'created_at',
                'desc',
                null,
                null,
                'collection'
            );

            $plan = AllSchool::with('modules')
                ->findOrFail($request->id);

            $connectedModulesIds = $plan->modules->pluck('module_id')->toArray();

            return response()->json([
                'status' => true,
                'message' => 'Details fetched successfully.',
                'allModules' => $allModules,
                'schoolModuleSettings' => $connectedModulesIds
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage() ?? 'Something went wrong !!! ',

            ]);
        }
    }
}
