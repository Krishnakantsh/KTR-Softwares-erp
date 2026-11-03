<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ClassMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Traits\CommonCrudOperations;

class ClassMasterController extends Controller
{

    use CommonCrudOperations;



    public function index()
    {
        return view('School.Pages.Master.class_master');
    }



    public function fetchWith()
    {

        return $this->commonFetch(
            ClassMaster::class,
            ['classSections'],
            [],
            'created_at',
            'asc'
        );
    }



    public function fetch()
    {

        return $this->commonFetch(
            ClassMaster::class
        );
    }



    public function showWith(Request $request)
    {

        return $this->commonShow(
            ClassMaster::class,
            $request,
            ['classSections']
        );
    }



    public function show(Request $request)
    {

        return $this->commonShow(
            ClassMaster::class,
            $request
        );
    }



    public function save(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {

            $slug = Str::slug($request->name);



            $duplicate = ClassMaster::where('name', $request->name)

                ->when($request->filled('class_id'), function ($query) use ($request) {

                    $query->where('id', '!=', $request->class_id);
                })

                ->exists();

            if ($duplicate) {

                return response()->json([
                    'status' => false,
                    'message' => 'Class already exists'
                ]);
            }


            ClassMaster::updateOrCreate(

                [
                    'id' => $request->class_id
                ],

                [

                    'name' => $request->name,

                    'slug' => $slug,

                    'session_id' => activeSession()->id ?? null,

                    'status' => $request->status ?? true,

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('class_id')
                    ? 'Class updated successfully'
                    : 'Class added successfully'

            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([

                'status' => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }


    public function status(Request $request)
    {

        return $this->toggleStatus(
            ClassMaster::class,
            $request
        );
    }


    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            ClassMaster::class,
            $request
        );
    }


    public function trash()
    {

        return $this->commonTrash(
            ClassMaster::class
        );
    }



    public function restore(Request $request)
    {

        return $this->commonRestore(
            ClassMaster::class,
            $request
        );
    }


    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            ClassMaster::class,
            $request
        );
    }
}
