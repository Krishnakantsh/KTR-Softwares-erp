<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\ConcessionType;
use App\Traits\CommonCrudOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConcessionTypeController extends Controller
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

                ConcessionType::where('id', $request->id)
                    ->update($data);
            } else {

                ConcessionType::create($data);
            }

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('id')
                    ? 'Concession Type updated successfully'
                    : 'Concession Type added successfully'

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
            ConcessionType::class
        );
    }

    public function show(Request $request)
    {

        return $this->commonShow(
            ConcessionType::class,
            $request
        );
    }

    public function status(Request $request)
    {

        return $this->toggleStatus(
            ConcessionType::class,
            $request
        );
    }

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            ConcessionType::class,
            $request
        );
    }

    public function trash()
    {

        return $this->commonTrash(
            ConcessionType::class
        );
    }

    public function restore(Request $request)
    {

        return $this->commonRestore(
            ConcessionType::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            ConcessionType::class,
            $request
        );
    }
}
