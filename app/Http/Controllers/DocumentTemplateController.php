<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\DocumentTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonCrudOperations;
use App\Services\FileService;
use Illuminate\Support\Facades\Auth;

class DocumentTemplateController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view(
            'Frontend/Normal/Pages/document_generate/build_document'
        );
    }

    // fetch

    public function fetchWith()
    {
        return $this->commonFetch(
            DocumentTemplate::class,
            ['category']
        );
    }

    // fetch

    public function fetch()
    {
        return $this->commonFetch(
            DocumentTemplate::class,
            []
        );
    }

    // show

    public function show(Request $request)
    {
        return $this->commonShow(
            DocumentTemplate::class,
            $request,
            ['category']
        );
    }
    public function showWith(Request $request)
    {
        return $this->commonShow(
            DocumentTemplate::class,
            $request,
            []
        );
    }

    // store

    // store

    public function store(Request $request)
    {
        $request->validate([
            'template_name' => 'required|string|max:255',
            'document_category_id' => 'required|exists:document_categories,id',
            'orientation' => 'required|in:portrait,landscape',
            'page_size' => 'required'
        ]);

        DB::beginTransaction();

        try {

            $schoolId = 1;

            // duplicate

            $duplicate = $this->isDuplicate(
                DocumentTemplate::class,
                [
                    'template_name' => $request->template_name,
                    'document_category_id' => $request->document_category_id,
                    'school_id' => $schoolId
                ],
                $request->document_template_id
            );

            if ($duplicate) {

                return response()->json([
                    'status' => false,
                    'message' => 'Template already exists'
                ]);
            }

            // existing template

            $existingTemplate = null;

            if ($request->filled('document_template_id')) {

                $existingTemplate = DocumentTemplate::findOrFail(
                    $request->document_template_id
                );
            }

            // default template

            if ($request->boolean('is_default')) {

                DocumentTemplate::where([
                    'session_id' => activeSession()->id,
                    'document_category_id' => $request->document_category_id
                ])
                    ->when(
                        $request->document_template_id,
                        fn($q) => $q->where(
                            'id',
                            '!=',
                            $request->document_template_id
                        )
                    )
                    ->update([
                        'is_default' => false
                    ]);
            }

            // images

            $images = [
                'background_image',
                'header_image',
                'footer_image',
                'watermark_image'
            ];

            $uploadedFiles = [];

            foreach ($images as $image) {

                $uploadedFiles[$image] = $existingTemplate->{$image} ?? null;

                if ($request->hasFile($image)) {

                    $uploadedFiles[$image] = FileService::update(

                        $request->file($image),

                        'uploads/document/templates',

                        $existingTemplate->{$image} ?? null
                    );
                }
            }

            // create update

            $template = DocumentTemplate::updateOrCreate(

                [
                    'id' => $request->document_template_id
                ],

                [
                    'school_id' => $schoolId,

                    'session_id' => activeSession()->id,

                    'document_category_id' => $request->document_category_id,

                    'template_name' => $request->template_name,

                    'template_code' => $request->template_code,

                    'description' => $request->description,

                    'orientation' => $request->orientation,

                    'page_size' => $request->page_size,

                    'width' => $request->width,

                    'height' => $request->height,

                    'background_image' => $uploadedFiles['background_image'],

                    'header_image' => $uploadedFiles['header_image'],

                    'footer_image' => $uploadedFiles['footer_image'],

                    'watermark_image' => $uploadedFiles['watermark_image'],

                    'html_content' => $request->html_content,

                    'css_content' => $request->css_content,

                    'js_content' => $request->js_content,

                    'show_header' => $request->boolean('show_header'),

                    'show_footer' => $request->boolean('show_footer'),

                    'show_page_number' => $request->boolean('show_page_number'),

                    'is_default' => $request->boolean('is_default'),

                    'status' => $request->boolean('status'),

                    'created_by' => $existingTemplate->created_by ?? Auth::id(),

                    'updated_by' => Auth::id(),
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('document_template_id')
                    ? 'Template updated successfully'
                    : 'Template added successfully',
                'data' => $template
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // status

    public function status(Request $request)
    {
        return $this->toggleStatus(
            DocumentTemplate::class,
            $request
        );
    }

    // delete

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            DocumentTemplate::class,
            $request
        );
    }

    // trash

    public function trash()
    {
        return $this->commonTrash(
            DocumentTemplate::class
        );
    }

    // restore

    public function restore(Request $request)
    {
        return $this->commonRestore(
            DocumentTemplate::class,
            $request
        );
    }

    // force delete

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            DocumentTemplate::class,
            $request
        );
    }
}
