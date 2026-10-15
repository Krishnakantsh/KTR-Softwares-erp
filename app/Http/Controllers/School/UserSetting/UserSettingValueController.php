<?php

namespace App\Http\Controllers\School\UserSetting;

use App\Http\Controllers\Controller;
use App\Models\School\UserSettingMaster\UserSettingMaster;
use App\Models\School\UserSettingMaster\UserSettingValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserSettingValueController extends Controller
{

    public function index()
    {
        return view('SuperAdmin.Pages.user_module_settings.user_setting_values');
    }

    public function fetchWithSchool(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school_id'     => 'required|integer|exists:all_schools,id',
            'module_id'     => 'required|integer|exists:modules_masters,id',
            'sub_module_id' => 'required|integer|exists:sub_modules_masters,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $schoolId = $request->school_id;

        $rows = UserSettingMaster::query()
            ->where('module_id', $request->module_id)
            ->where('sub_module_id', $request->sub_module_id)
            ->where('status', 1)
            ->leftJoin('user_setting_values', function ($join) use ($schoolId) {
                $join->on('user_setting_values.user_setting_master_id', '=', 'user_setting_masters.id')
                    ->where('user_setting_values.school_id', '=', $schoolId);
            })
            ->select([
                'user_setting_masters.*',
                DB::raw('user_setting_values.id as value_row_id'),
                DB::raw('user_setting_values.selected_setting as school_selected_setting'),
            ])
            ->orderBy('user_setting_masters.setting_title')
            ->get()
            ->map(function ($row) {
                $isOverridden = !is_null($row->value_row_id);

                $row->resolved_value = $isOverridden
                    ? $row->school_selected_setting
                    : $row->default_setting;

                $row->is_overridden = $isOverridden;

                return $row;
            });

        return response()->json([
            'status' => true,
            'data'   => $rows,
        ]);
    }

    // Get single setting (master + resolved value) for edit modal
    public function get($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school_id' => 'required|integer|exists:all_schools,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $master = UserSettingMaster::find($id);

        if (!$master) {
            return response()->json(['status' => false, 'message' => 'Setting not found']);
        }

        $valueRow = UserSettingValue::where('user_setting_master_id', $id)
            ->where('school_id', $request->school_id)
            ->first();

        $master->resolved_value = $valueRow ? $valueRow->selected_setting : $master->default_setting;
        $master->is_overridden  = (bool) $valueRow;

        return response()->json([
            'status' => true,
            'data'   => $master,
        ]);
    }

    // Create / update the school-specific value
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_setting_master_id' => 'required|integer|exists:user_setting_masters,id',
            'school_id'              => 'required|integer|exists:all_schools,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $master = UserSettingMaster::find($request->user_setting_master_id);

        // Normalize value based on setting_type
        $value = null;

        switch ((int) $master->setting_type) {
            case 1: // On/Off
                $value = $request->input('value', '0');
                break;

            case 2: // Options (single)
                $value = $request->input('value');
                break;

            case 3: // Options (multiple)
                $selected = $request->input('value', []);
                $value = json_encode(array_values((array) $selected));
                break;

            case 4: // Input
                $value = $request->input('value');
                break;
        }

        UserSettingValue::updateOrCreate(
            [
                'user_setting_master_id' => $request->user_setting_master_id,
                'school_id'              => $request->school_id,
            ],
            [
                'selected_setting' => $value,
            ]
        );

        return response()->json([
            'status'  => true,
            'message' => 'Setting updated for school successfully.',
        ]);
    }
}
