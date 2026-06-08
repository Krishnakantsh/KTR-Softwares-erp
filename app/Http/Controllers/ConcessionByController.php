<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\ConcessionBy;
use App\Traits\CommonCrudOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConcessionByController extends Controller
{

    use CommonCrudOperations;

    public function index()
    {

        return view('Frontend.Normal.Pages.Settings.general_settings');
    }

    public function store(Request $request)
    {

        $request->validate([

            'name'   => 'required|string|max:255',

        ]);

        DB::beginTransaction();

        try {

            $data = [

                'name' => $request->name,

                'session_id' => activeSession()->id,

                'slug' => $request->slug
                    ? Str::slug($request->slug)
                    : Str::slug($request->name),

                'status' => 1,

            ];

            if ($request->filled('id')) {

                ConcessionBy::where('id', $request->id)
                    ->update($data);
            } else {

                ConcessionBy::create($data);
            }

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('id')
                    ? 'Concession By updated successfully'
                    : 'Concession By added successfully'

            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([

                'status' => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }

    public function fetch()
    {

        return $this->commonFetch(
            ConcessionBy::class
        );
    }

    public function show(Request $request)
    {

        return $this->commonShow(
            ConcessionBy::class,
            $request
        );
    }

    public function status(Request $request)
    {

        return $this->toggleStatus(
            ConcessionBy::class,
            $request
        );
    }

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            ConcessionBy::class,
            $request
        );
    }

    public function trash()
    {

        return $this->commonTrash(
            ConcessionBy::class
        );
    }

    public function restore(Request $request)
    {

        return $this->commonRestore(
            ConcessionBy::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            ConcessionBy::class,
            $request
        );
    }
}
