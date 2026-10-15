<?php

namespace App\Http\Controllers\School\UserSetting;

use App\Http\Controllers\Controller;
use App\Models\School\UserSettingMaster\UserSettingMaster;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSettingMasterController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('SuperAdmin.Pages.user_module_settings.user_setting_master');
    }

    public function store(Request $request)
    {
        $request->validate([
            'setting_title'           => 'required|string|max:255',
            'setting_key'             => 'required|string|max:255',
            'setting_type'            => 'required|in:1,2,3',
            'module_id'               => 'required|exists:modules_masters,id',
            'sub_module_id'           => 'required|exists:sub_modules_masters,id',

            'options'                 => 'nullable',
            'default_setting_on_off'  => 'nullable|boolean',
            'default_setting_input'   => 'nullable|string|max:255',

            'in_admin_hand'           => 'nullable|boolean',
            'status'                  => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $setting = $request->filled('id')
                ? UserSettingMaster::findOrFail($request->id)
                : new UserSettingMaster();

            $setting->setting_title = $request->setting_title;
            $setting->setting_key = $request->setting_key;
            $setting->setting_type = $request->setting_type;
            $setting->module_id = $request->module_id;
            $setting->sub_module_id = $request->sub_module_id;
            $setting->in_admin_hand = $request->in_admin_hand ?? 0;
            $setting->status = $request->status ?? 1;

            $setting->options = null;
            $defaultSetting = null;

            switch ((int) $request->setting_type) {

                // 1 = ON/OFF
                case 1:
                    $defaultSetting = $request->default_setting_on_off ?? 0;
                    break;

                // 2 = OPTIONS
                case 2:

                    $options = is_array($request->options)
                        ? $request->options
                        : json_decode($request->options, true);

                    $setting->options = json_encode($options);

                    if (is_array($options)) {
                        foreach ($options as $option) {
                            if (!empty($option['is_default'])) {
                                $defaultSetting = $option['key'];
                                break;
                            }
                        }
                    }

                    break;

                // 3 = TEXT INPUT
                case 3:
                    $defaultSetting = $request->default_setting_input ?? '';
                    break;
            }

            $setting->default_setting = $defaultSetting;

            $setting->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $setting->wasRecentlyCreated
                    ? 'User setting added successfully.'
                    : 'User setting updated successfully.',
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
            UserSettingMaster::class,
            []
        );
    }

    public function fetchWith(Request $request)
    {
        return $this->commonFetch(
            UserSettingMaster::class,
            ['module', 'subModule'],
            [
                'module_id' => $request->module_id,
                'sub_module_id' => $request->sub_module_id
            ]
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            UserSettingMaster::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            UserSettingMaster::class,
            $request,
            ['module', 'subModule']
        );
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:user_setting_masters,id'
        ]);

        $setting = UserSettingMaster::findOrFail($request->id);
        $setting->delete();

        return response()->json([
            'status' => true,
            'message' => 'User setting deleted successfully.'
        ]);
    }
}
