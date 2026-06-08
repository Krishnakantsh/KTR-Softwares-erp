<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Services\FileService;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function getSetting()
    {
        return view('Frontend/Normal/Pages/Schools/Settings/setting_and_permissions');
    }

   

    public function index()
    {
        $details = School::first();

        if (!$details) {
            $details = new School();
        }


        return view('Frontend/Normal/Pages/Schools/update_school', compact('details'));
    }

    public function create() {}



    public function saveSchool(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
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

            return response()->json([
                'status' => true,
                'message' => $request->id ? 'Updated Successfully' : 'Stored Successfully'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        //
    }
}
