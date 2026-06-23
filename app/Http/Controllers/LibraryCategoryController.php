<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibraryCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonCrudOperations;
use Illuminate\Support\Facades\Auth;

class LibraryCategoryController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend.Normal.Pages.Library.category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'status'        => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'school_id' =>null,
                'session_id' => activeSession()->id,

                'category_name' => $request->category_name,

                'slug' => $request->slug
                    ? Str::slug($request->slug)
                    : Str::slug($request->category_name),

                'description' => $request->description,

                'status' => (int) $request->status,

                'updated_by' => Auth::id(),
            ];

            if ($request->filled('id')) {

                LibraryCategory::where('id', $request->id)
                    ->update($data);
            } else {

                $data['created_by'] =  Auth::id();

                LibraryCategory::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('id')
                    ? 'Category updated successfully'
                    : 'Category added successfully'
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
            LibraryCategory::class
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryCategory::class,
            $request
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            LibraryCategory::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryCategory::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            LibraryCategory::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryCategory::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryCategory::class,
            $request
        );
    }
}
