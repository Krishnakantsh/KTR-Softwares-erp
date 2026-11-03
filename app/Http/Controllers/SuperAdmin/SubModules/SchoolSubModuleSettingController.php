<?php

namespace App\Http\Controllers\SuperAdmin\SubModules;

use App\Http\Controllers\Controller;
use App\Models\AllSchool;
use App\Models\SuperAdmin\SubModules\SchoolSubModuleSetting;
use App\Models\SuperAdmin\SubModules\SubModulesMaster;
use App\Traits\CommonCrudOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class SchoolSubModuleSettingController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('SuperAdmin/Pages/SubModules/AssignSubModuleToSchool');
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id'     => 'required|exists:all_schools,id',
            'submodules'    => 'nullable|array',
            'submodules.*'  => 'exists:sub_modules_masters,id',
        ]);

        DB::beginTransaction();

        try {

            $schoolId           = $request->school_id;
            $selectedSubModules = $request->submodules ?? [];

            if (count($selectedSubModules)) {

                SchoolSubModuleSetting::where('school_id', $schoolId)
                    ->whereNotIn('sub_module_id', $selectedSubModules)
                    ->delete();
            } else {

                SchoolSubModuleSetting::where('school_id', $schoolId)->delete();
            }

            if (!empty($selectedSubModules)) {

                $now = now();

                $records = [];

                foreach ($selectedSubModules as $subModuleId) {

                    $records[] = [
                        'school_id'      => $schoolId,
                        'sub_module_id'  => $subModuleId,
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ];
                }

                SchoolSubModuleSetting::upsert(
                    $records,
                    ['school_id', 'sub_module_id'],
                    [
                        'updated_at'
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Tenant sub modules synchronized successfully.',
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
            SchoolSubModuleSetting::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            SchoolSubModuleSetting::class,
            ['subModule']
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            SchoolSubModuleSetting::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            SchoolSubModuleSetting::class,
            $request,
            ['subModule']
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            SchoolSubModuleSetting::class,
            $request
        );
    }


    // extra routes

    public function SubModuleMapping(Request $request)
    {
        try {


            $request->validate([
                'id' => 'required|exists:all_schools,id'
            ]);

            $allSubModules = $this->commonFetch(
                SubModulesMaster::class,
                ['module'],
                [],
                'created_at',
                'desc',
                null,
                null,
                'collection'
            );

            $school = AllSchool::with('subModules')
                ->findOrFail($request->id);

            // dd($school);    

            $connectedSubModulesIds = $school->subModules->pluck('sub_module_id')->toArray();


            return response()->json([
                'status' => true,
                'message' => 'Details fetched successfully.',
                'allSubModules' => $allSubModules,
                'connectedSubModulesIds' => $connectedSubModulesIds
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage() ?? 'Something went wrong !!! ',
            ]);
        }
    }
}
