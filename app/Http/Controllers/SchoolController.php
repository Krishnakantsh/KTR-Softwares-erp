<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\TransportMonth;
use App\Services\FileService;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function getSetting()
    {
        return view('School.Pages.Schools/Settings/setting_and_permissions');
    }
    public function updateMonthOrderAndSetting()
    {
        return view('School.Pages.Master/months_setting');
    }


    public function index()
    {
        $details = School::first();

        if (!$details) {
            $details = new School();
        }

        return view('School.Pages.Schools/update_school', compact('details'));
    }

    public function get()
    {
        $details = School::first();

        if (!$details) {
            $details = new School();
        }
        return response()->json([
            'status' => true,
            'data' => $details
        ]);
    }

    public function saveSchool(Request $request)
    {
        try {

            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email',
            ]);



            $fileFields = [
                'logo',
                'small_logo',
                'long_logo',
                'favicon',
                'board_logo',
                'header_image',
                'report_card_header_mage',
                'school_stamp',
                'principal_sign',
                'manager_sign',
                'vice_president_sign',
                'head_mistress',
                'exam_incharge_sign',
                'fees_qr_code',
            ];


            if ($request->id) {
                $school = School::findOrFail($request->id);
            } else {
                $school = new School();
            }

            $school->fill($request->except($fileFields));

            $name_slug = Str::slug($request->name);


            foreach ($fileFields as $field) {

                $file = $request->file($field);

                if ($request->id) {

                    $school->$field = FileService::update(
                        $file,
                        'uploads/' . $name_slug,
                        $school->$field
                    );
                } else {

                    if ($file) {
                        $school->$field = FileService::upload(
                            $file,
                            'uploads/' . $name_slug,
                        );
                    }
                }
            }

            $school->save();

            // return response()->json([
            //     'status' => true,
            //     'message' => $request->id ? 'Updated Successfully' : 'Stored Successfully'
            // ]);


            return back()->with('success', 'update successfully');
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function sessionMonthReorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|integer',
            'order.*.sort_order' => 'required|integer',
        ]);

        try {
            foreach ($request->order as $item) {
                TransportMonth::where('id', $item['id'])->update([
                    'sort_order' => $item['sort_order']
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Order updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong while updating order.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function sessionSetupForSchool(Request $request)
    {
        try {

            $request->validate([
                'start_month' => 'nullable',
                'session_end' => 'nullable',
                'session_start' => 'nullable',
                'starting_recept_no' => 'nullable',
            ]);


            $school =  School::first();

            $school->start_month = $request->start_month;
            $school->session_end = $request->session_end;
            $school->session_start = $request->session_start;
            $school->starting_recept_no = $request->starting_recept_no;

            $school->save();

            return response()->json([
                'status' => true,
                'message' =>'Updated Successfully' ,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
