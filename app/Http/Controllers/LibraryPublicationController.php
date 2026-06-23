<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibraryPublication;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonCrudOperations;
use Illuminate\Support\Facades\Auth;

class LibraryPublicationController extends Controller
{
    use CommonCrudOperations;



    public function store(Request $request)
    {
        $request->validate([
            'publication_name' => 'required|string|max:255',
            'status'           => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'school_id' => null,
                'session_id' => activeSession()->id,

                'publication_name' => $request->publication_name,

                'slug' => Str::slug($request->publication_name),

                'description' => $request->description,

                'status' => (int) $request->status,

                'updated_by' => Auth::id(),
            ];

            if ($request->filled('id')) {

                LibraryPublication::where('id', $request->id)
                    ->update($data);
            } else {

                $data['created_by'] =  Auth::id();

                LibraryPublication::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('id')
                    ? 'Publication updated successfully'
                    : 'Publication added successfully'
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
            LibraryPublication::class
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryPublication::class,
            $request
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            LibraryPublication::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryPublication::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            LibraryPublication::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryPublication::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryPublication::class,
            $request
        );
    }
}
