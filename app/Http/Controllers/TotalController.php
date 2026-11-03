<?php

namespace App\Http\Controllers;

use App\Models\Total;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Validator;
use Throwable;

class TotalController extends Controller
{

    public function session_check()
    {
        if (!empty(activeSession()->id)) {
            return  activeSession()->id;
        };
        return "Active Academic Session not found";
    }


    public function index()
    {
        $totals = Total::all();

        return response()->json([
            "status" => true,
            'data' => $totals
        ]);
    }

    public function testingPage()
    {
        return view('Frontend/Normal/Admin_Pages/test');
    }


    public function create() {}


    public function store(Request $request)
    {
        $createdTotal = Total::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json([
            "status" => true,
            'data' => $createdTotal
        ]);
    }




    public function run(Request $request): StreamedResponse
    {
        return response()->stream(function () use ($request) {

            // Disable PHP output buffering for streaming.
            while (ob_get_level() > 0) {
                ob_end_flush();
            }

            $send = function (array $event): void {
                echo 'data: ' . json_encode(
                    $event,
                    JSON_UNESCAPED_UNICODE
                        | JSON_INVALID_UTF8_SUBSTITUTE
                ) . "\n\n";

                if (ob_get_level() > 0) {
                    ob_flush();
                }

                flush();
            };

            try {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => ['required', 'string', 'max:100'],
                    ]
                );

                if ($validator->fails()) {
                    $send([
                        'type' => 'error',
                        'message' => 'Validation failed.',
                        'errors' => $validator->errors()->toArray(),
                    ]);

                    return;
                }

                // STEP 1: Validate input.
                $send([
                    'type' => 'step',
                    'step' => 1,
                    'status' => 'running',
                    'message' => 'Step 1 started.',
                ]);

                usleep(500000); // Testing only: 0.5 seconds.

                $step1 = [
                    'name' => trim($request->input('name')),
                    'valid' => true,
                ];

                $send([
                    'type' => 'step',
                    'step' => 1,
                    'status' => 'completed',
                    'response' => $step1,
                ]);

                // STEP 2: Use Step 1 output.
                $send([
                    'type' => 'step',
                    'step' => 2,
                    'status' => 'running',
                    'message' => 'Step 2 started.',
                ]);

                usleep(500000); // Testing only.

                $step2 = [
                    'display_name' => strtoupper($step1['name']),
                    'length' => strlen($step1['name']),
                ];

                $send([
                    'type' => 'step',
                    'step' => 2,
                    'status' => 'completed',
                    'response' => $step2,
                ]);

                // STEP 3: Use Step 2 output.
                $send([
                    'type' => 'step',
                    'step' => 3,
                    'status' => 'running',
                    'message' => 'Step 3 started.',
                ]);

                usleep(500000); // Testing only.

                $step3 = [
                    'result' => $step2['display_name'],
                    'character_count' => $step2['length'],
                    'success' => true,
                ];

                $send([
                    'type' => 'step',
                    'step' => 3,
                    'status' => 'completed',
                    'response' => $step3,
                ]);

                // Final event.
                $send([
                    'type' => 'done',
                    'status' => 'completed',
                    'message' => 'Workflow completed successfully.',
                    'response' => $step3,
                ]);
            } catch (Throwable $e) {
                report($e);

                $send([
                    'type' => 'error',
                    'message' => 'Workflow failed.',
                ]);
            }
        }, 200, [
            'Content-Type' => 'text/event-stream; charset=UTF-8',
            'Cache-Control' => 'no-cache, no-transform',
            'X-Accel-Buffering' => 'no',
        ]);
    }
}
