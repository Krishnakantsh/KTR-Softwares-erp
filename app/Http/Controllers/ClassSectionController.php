<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ClassMaster;
use App\Models\ClassSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\CommonCrudOperations;

class ClassSectionController extends Controller
{

    use CommonCrudOperations;

    /*
    |--------------------------------------------------------------------------
    | INDEX PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('Frontend.Normal.Pages.Master.class_section');
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL SECTIONS WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetchWith()
    {

        return $this->commonFetch(
            ClassSection::class,
            ['classMaster']
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL SECTIONS WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetch()
    {
        return $this->commonFetch(
            ClassSection::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE SECTION WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function showWith(Request $request)
    {
        return $this->commonShow(
            ClassSection::class,
            $request,
            ['classMaster']
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE SECTION WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function show(Request $request)
    {
        return $this->commonShow(
            ClassSection::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE & UPDATE SECTIONS
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'class_id' => 'required|integer|exists:class_masters,id',

            'sections' => 'required|array|min:1',

            'sections.*' => 'required|string|max:255',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | CHECK CLASS
            |--------------------------------------------------------------------------
            */

            $class = ClassMaster::find($request->class_id);

            if (!$class) {

                return response()->json([

                    'status' => false,

                    'message' => 'Class not found'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | REMOVE EMPTY VALUES
            |--------------------------------------------------------------------------
            */

            $sections = array_values(

                array_filter($request->sections)

            );

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE CHECK INSIDE ARRAY
            |--------------------------------------------------------------------------
            */

            $duplicates = array_diff_assoc(
                $sections,
                array_unique($sections)
            );

            if (!empty($duplicates)) {

                return response()->json([

                    'status' => false,

                    'message' => 'Duplicate sections are not allowed'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | FETCH EXISTING SECTIONS
            |--------------------------------------------------------------------------
            */

            $existingSections = ClassSection::where(
                'class_master_id',
                $request->class_id
            )

                ->orderBy('id')

                ->get();

            $existingCount = $existingSections->count();

            $newCount = count($sections);

            /*
            |--------------------------------------------------------------------------
            | UPDATE EXISTING
            |--------------------------------------------------------------------------
            */

            for ($i = 0; $i < min($existingCount, $newCount); $i++) {

                $existingSections[$i]->update([

                    'name' => $sections[$i],

                    'slug' => Str::slug($sections[$i]),

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE NEW
            |--------------------------------------------------------------------------
            */

            if ($newCount > $existingCount) {

                $insertData = [];

                for ($i = $existingCount; $i < $newCount; $i++) {

                    $insertData[] = [

                        'class_master_id' => $request->class_id,

                        'name' => $sections[$i],

                        'slug' => Str::slug($sections[$i]),

                        'session_id' => activeSession()->id ?? null,

                        'status' => true,

                        'created_at' => now(),

                        'updated_at' => now(),

                    ];
                }

                ClassSection::insert($insertData);
            }

            /*
            |--------------------------------------------------------------------------
            | DELETE EXTRA
            |--------------------------------------------------------------------------
            */

            if ($existingCount > $newCount) {

                for ($i = $newCount; $i < $existingCount; $i++) {

                    $existingSections[$i]->delete();
                }
            }

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => 'Sections synced successfully'

            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([

                'status' => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE SECTION STATUS
    |--------------------------------------------------------------------------
    */

    public function status(Request $request)
    {

        return $this->toggleStatus(
            ClassSection::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPORARY DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            ClassSection::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TRASH LIST
    |--------------------------------------------------------------------------
    */

    public function trash()
    {

        return $this->commonTrash(
            ClassSection::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE
    |--------------------------------------------------------------------------
    */

    public function restore(Request $request)
    {

        return $this->commonRestore(
            ClassSection::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PERMANENT DELETE
    |--------------------------------------------------------------------------
    */

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            ClassSection::class,
            $request
        );
    }
}
