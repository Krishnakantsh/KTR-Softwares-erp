<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\CommonCrudOperations;
use App\Models\DocumentCategory;

class DocumentCategoryController extends Controller
{
    use CommonCrudOperations;




    public function fetch()
    {
        return $this->commonFetch(
            DocumentCategory::class,
            []
        );
    }


    public function show(Request $request)
    {
        return $this->commonShow(
            DocumentCategory::class,
            $request,
            []
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
        ]);

        DB::beginTransaction();

        try {

            $slug = Str::slug($request->name);

            // duplicate

            $duplicate = $this->isDuplicate(
                DocumentCategory::class,
                [
                    'name' => $request->name,
                    'session_id' => activeSession()->id
                ],
                $request->document_category_id
            );

            if ($duplicate) {

                return response()->json([
                    'status' => false,
                    'message' => 'Category already exists'
                ]);
            }

            // create update

            DocumentCategory::updateOrCreate(

                [
                    'id' => $request->document_category_id
                ],

                [
                    'name' => $request->name,
                    'slug' => $slug,
                    'description' => $request->description,
                    'status' => $request->boolean('status'),
                    'session_id' => activeSession()->id
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('document_category_id')
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

    public function status(Request $request)
    {
        return $this->toggleStatus(
            DocumentCategory::class,
            $request
        );
    }


    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            DocumentCategory::class,
            $request
        );
    }


    public function trash()
    {
        return $this->commonTrash(
            DocumentCategory::class
        );
    }


    public function restore(Request $request)
    {
        return $this->commonRestore(
            DocumentCategory::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            DocumentCategory::class,
            $request
        );
    }
}
