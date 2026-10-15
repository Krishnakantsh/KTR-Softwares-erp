<?php

namespace App\Http\Controllers\SuperAdmin\Modules;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\Modules\ModulesMaster;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulesMasterController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('SuperAdmin.Pages.Modules.manageModule');
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_name'        => 'required|string|max:255',
            'module_order'       => 'nullable|integer',
            'default_txt_color'  => 'nullable|string|max:250',
            'default_bg_color'   => 'nullable|string|max:250',
            'module_icon'        => 'nullable',
        ]);

        DB::beginTransaction();

        try {

            $module = $request->filled('id')
                ? ModulesMaster::findOrFail($request->id)
                : new ModulesMaster();

            $module->module_name = $request->module_name;
            $module->module_icon = $request->module_icon;
            $module->module_order = $request->module_order ?? 0;
            $module->default_txt_color = $request->default_txt_color;
            $module->default_bg_color = $request->default_bg_color;

            $module->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $module->wasRecentlyCreated
                    ? 'Module added successfully.'
                    : 'Module updated successfully.',
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
            ModulesMaster::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            ModulesMaster::class,
            []
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            ModulesMaster::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            ModulesMaster::class,
            $request,
            []
        );
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:modules_masters,id'
        ]);

        $module = ModulesMaster::findOrFail($request->id);
        $module->delete();

        return response()->json([
            'status' => true,
            'message' => 'Module deleted successfully'
        ]);
    }
}
