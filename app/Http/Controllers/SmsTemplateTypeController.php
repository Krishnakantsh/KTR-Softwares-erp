<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\SmsTemplate;
use App\Models\SmsTemplateType;
use App\Traits\CommonCrudOperations;

class SmsTemplateTypeController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend/Normal/Pages/SMS/template-types');
    }

    public function fetch()
    {
        return $this->commonFetch(
            SmsTemplateType::class,
            []
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            SmsTemplateType::class,
            $request,
            []
        );
    }
    public function fetchWith()
    {
        return $this->commonFetch(
            SmsTemplateType::class,
            ['templates']
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            SmsTemplateType::class,
            $request,
            ['templates']
        );
    }

    public function store(Request $request)
    {



        $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        DB::beginTransaction();

        try {

            $slug = Str::slug($request->name);

            if ($request->filled('id')) {

                $templateType = SmsTemplateType::findOrFail($request->id);

                $duplicate = $this->isDuplicate(
                    SmsTemplateType::class,
                    [
                        'name' => $request->name
                    ],
                    $request->id
                );

                if ($duplicate) {

                    return response()->json([
                        'status' => false,
                        'message' => 'Template type already exists'
                    ]);
                }

                $templateType->update([
                    'name'   => $request->name,
                    'slug'   => $slug,
                    'status' => $request->status,
                    'session_id' => activeSession()->id ?? null
                ]);

                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'Template type updated successfully'
                ]);
            }

            $exists = $this->isDuplicate(
                SmsTemplateType::class,
                [
                    'name' => $request->name
                ]
            );

            if ($exists) {

                return response()->json([
                    'status' => false,
                    'message' => 'Template type already exists'
                ]);
            }

            SmsTemplateType::create([
                'name'   => $request->name,
                'slug'   => $slug,
                'status' => $request->status,
                'session_id' => activeSession()->id ?? null
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Template type added successfully'
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
            SmsTemplateType::class,
            $request
        );
    }


    public function destroy(Request $request)
    {
        $availableRelatedTemplates = SmsTemplate::where('template_typeId', $request->id)->count();

        if ($availableRelatedTemplates > 0) {
            return response()->json([
                'status' => false,
                'message' => "Can't delete it. First delete related templates"
            ]);
        }

        return $this->commonDestroy(
            SmsTemplateType::class,
            $request
        );
    }

    

    public function trash()
    {
        return $this->commonTrash(
            SmsTemplateType::class
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
            SmsTemplateType::class,
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
            SmsTemplateType::class,
            $request
        );
    }
}
