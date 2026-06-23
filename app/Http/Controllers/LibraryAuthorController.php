<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibraryAuthor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonCrudOperations;
use Illuminate\Support\Facades\Auth;

class LibraryAuthorController extends Controller
{
    use CommonCrudOperations;


    public function store(Request $request)
    {



        $request->validate([
            'author_name' => 'required|string|max:255',
            'status'      => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'school_id'    => null,
                'session_id'   => activeSession()->id,

                'author_name'  => $request->author_name,

                'slug'         =>  Str::slug($request->author_name),

                'description'  => $request->description,

                'status'       => (int) $request->status,

                'updated_by'   => Auth::id(),
            ];

            if ($request->filled('author_id')) {

                LibraryAuthor::where('id', $request->author_id)
                    ->update($data);
            } else {

                $data['created_by'] =  Auth::id();

                LibraryAuthor::create($data);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $request->filled('id')
                    ? 'Author updated successfully'
                    : 'Author added successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // fetch

    public function fetch()
    {
        return $this->commonFetch(
            LibraryAuthor::class
        );
    }

    // show

    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryAuthor::class,
            $request
        );
    }

    // status

    public function status(Request $request)
    {
        return $this->toggleStatus(
            LibraryAuthor::class,
            $request
        );
    }

    // delete

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryAuthor::class,
            $request
        );
    }

    // trash

    public function trash()
    {
        return $this->commonTrash(
            LibraryAuthor::class
        );
    }

    // restore

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryAuthor::class,
            $request
        );
    }

    // force delete

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryAuthor::class,
            $request
        );
    }
}
