<?php

namespace App\Http\Controllers\SuperAdmin\SubModules;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\SubModules\SubModulesMaster;
use App\Services\FileService;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubModulesMasterController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('SuperAdmin/Pages/SubModules/manageSubModules');
    }

    public function list()
    {
        return view('SuperAdmin.Pages.SubModules.sub_module_list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id'          => 'required|exists:modules_masters,id',
            'sub_module_name'    => 'required|string|max:255',
            'sub_module_url'     => 'required|string|max:255',
            'sub_module_order'   => 'nullable|integer',
            'dashboard_permission' => 'nullable|boolean',
            'eng_video_url'      => 'nullable|string|max:255',
            'hin_video_url'      => 'nullable|string|max:255',
            'submodule_sortname' => 'required|string|max:100',
            'sub_module_icon'    => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {

            $subModule = $request->filled('id')
                ? SubModulesMaster::findOrFail($request->id)
                : new SubModulesMaster();

            $subModule->module_id = $request->module_id;
            $subModule->sub_module_icon = $request->sub_module_icon;
            $subModule->sub_module_name = $request->sub_module_name;
            $subModule->sub_module_url = $request->sub_module_url;
            $subModule->sub_module_order = $request->sub_module_order ?? 0;
            $subModule->dashboard_permission = $request->boolean('dashboard_permission');
            $subModule->eng_video_url = $request->eng_video_url;
            $subModule->hin_video_url = $request->hin_video_url;
            $subModule->submodule_sortname = $request->submodule_sortname;

            $subModule->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $subModule->wasRecentlyCreated
                    ? 'Sub Module added successfully.'
                    : 'Sub Module updated successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            SubModulesMaster::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            SubModulesMaster::class,
            ['module']
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            SubModulesMaster::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            SubModulesMaster::class,
            $request,
            ['module']
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            SubModulesMaster::class,
            $request
        );
    }


    public function byModule(Request $request)
    {

        return $this->commonFetch(
            SubModulesMaster::class,
            ['module'],
            ['module_id' => $request->module_id]
        );
    }
}
