<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\House;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\CommonCrudOperations;

class HouseController extends Controller
{

    use CommonCrudOperations;

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        return view('Frontend.Normal.Pages.Settings.general_settings');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE & UPDATE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'name'   => 'required|string|max:255',

            'status' => 'nullable|boolean',

        ]);

        DB::beginTransaction();

        try {

            $data = [

                'name' => $request->name,

                'session_id' => activeSession()->id,

                'slug' => $request->slug
                    ? Str::slug($request->slug)
                    : Str::slug($request->name),

                'status' => (int) $request->status,

            ];

            if ($request->filled('id')) {

                House::where('id', $request->id)
                    ->update($data);
            } else {

                House::create($data);
            }

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('id')
                    ? 'House updated successfully'
                    : 'House added successfully'

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
    | FETCH ALL
    |--------------------------------------------------------------------------
    */

    public function fetch()
    {

        return $this->commonFetch(
            House::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE
    |--------------------------------------------------------------------------
    */

    public function show(Request $request)
    {

        return $this->commonShow(
            House::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CHANGE STATUS
    |--------------------------------------------------------------------------
    */

    public function status(Request $request)
    {

        return $this->toggleStatus(
            House::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            House::class,
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
            House::class
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
            House::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FORCE DELETE
    |--------------------------------------------------------------------------
    */

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            House::class,
            $request
        );
    }
}
