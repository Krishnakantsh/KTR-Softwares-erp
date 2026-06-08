<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SmsTemplate;
use App\Traits\CommonCrudOperations;

class SmsTemplateController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        // return view('Frontend/Normal/Pages/SMS/templates');
    }

    public function fetch()
    {
        return $this->commonFetch(
            SmsTemplate::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            SmsTemplate::class,
            ['templateType']
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            SmsTemplate::class,
            $request,
          []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            SmsTemplate::class,
            $request,
              ['templateType']
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'template_id'       => 'nullable|string|max:255',
            'template_title'    => 'required|string|max:255',
            'template_typeId'   => 'required|exists:sms_template_types,id',
            'template_language' => 'nullable|string|max:255',
            'template_company'  => 'nullable|string|max:255',
            'template_senderId' => 'nullable|string|max:255',
            'sms'               => 'required|string',
            'status'            => 'required|in:permanent,temporary',
        ]);

        DB::beginTransaction();

        try {

            if ($request->filled('id')) {

                $smsTemplate = SmsTemplate::findOrFail($request->id);

                $duplicate = $this->isDuplicate(
                    SmsTemplate::class,
                    [
                        'template_title'  => $request->template_title,
                        'template_typeId' => $request->template_typeId
                    ],
                    $request->id
                );

                if ($duplicate) {

                    return response()->json([
                        'status' => false,
                        'message' => 'SMS template already exists'
                    ]);
                }

                $smsTemplate->update([
                    'template_id'       => $request->template_id,
                    'template_title'    => $request->template_title,
                    'template_typeId'   => $request->template_typeId,
                    'template_language' => $request->template_language,
                    'template_company'  => $request->template_company,
                    'template_senderId' => $request->template_senderId,
                    'sms'               => $request->sms,
                    'status'            => $request->status,
                          'session_id' => activeSession()->id ?? null
                ]);

                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'SMS template updated successfully'
                ]);
            }

            $exists = $this->isDuplicate(
                SmsTemplate::class,
                [
                    'template_title'  => $request->template_title,
                    'template_typeId' => $request->template_typeId
                ]
            );

            if ($exists) {

                return response()->json([
                    'status' => false,
                    'message' => 'SMS template already exists'
                ]);
            }

            SmsTemplate::create([
                'template_id'       => $request->template_id,
                'template_title'    => $request->template_title,
                'template_typeId'   => $request->template_typeId,
                'template_language' => $request->template_language,
                'template_company'  => $request->template_company,
                'template_senderId' => $request->template_senderId,
                'sms'               => $request->sms,
                'status'            => $request->status,
                      'session_id' => activeSession()->id ?? null
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'SMS template added successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            SmsTemplate::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            SmsTemplate::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            SmsTemplate::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            SmsTemplate::class,
            $request
        );
    }
}
