<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\StreamMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Traits\CommonCrudOperations;

class StreamMasterController extends Controller
{
    use CommonCrudOperations;

    /*
    |--------------------------------------------------------------------------
    | INDEX PAGE (DO NOT TOUCH)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('Frontend/Normal/Pages/Master/stream_master');
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL STREAMS WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetchWith()
    {
        return $this->commonFetch(
            StreamMaster::class,

        );
    }


    /*
    |--------------------------------------------------------------------------
    | FETCH ALL STREAMS
    |--------------------------------------------------------------------------
    */

    public function fetch()
    {
        return $this->commonFetch(
            StreamMaster::class,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE STREAM
    |--------------------------------------------------------------------------
    */
    public function showWith(Request $request)
    {
        return $this->commonShow(
            StreamMaster::class,
            $request,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE STREAM
    |--------------------------------------------------------------------------
    */
    public function show(Request $request)
    {
        return $this->commonShow(
            StreamMaster::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE & UPDATE (DO NOT TOUCH)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {

            $sessionId = activeSession()->id ?? null;
            $slug = Str::slug($request->name);

            /*
            |--------------------------------------------------------------------------
            | UPDATE STREAM
            |--------------------------------------------------------------------------
            */
            if ($request->filled('stream_id')) {

                $stream = StreamMaster::where('session_id', $sessionId)
                    ->findOrFail($request->stream_id);

                $duplicate = StreamMaster::where('session_id', $sessionId)
                    ->where('name', $request->name)
                    ->where('id', '!=', $request->stream_id)
                    ->exists();

                if ($duplicate) {

                    return response()->json([
                        'status' => false,
                        'message' => 'Stream already exists'
                    ]);
                }

                $stream->update([
                    'name' => $request->name,
                    'slug' => $slug,
                ]);

                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'Stream updated successfully'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE STREAM
            |--------------------------------------------------------------------------
            */
            $exists = StreamMaster::where('session_id', $sessionId)
                ->where('name', $request->name)
                ->exists();

            if ($exists) {

                return response()->json([
                    'status' => false,
                    'message' => 'Stream already exists'
                ]);
            }

            StreamMaster::create([
                'name' => $request->name,
                'slug' => $slug,
                'session_id' => $sessionId,
                'status' => true
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Stream added successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS (NEW ADDED)
    |--------------------------------------------------------------------------
    */
    public function status(Request $request)
    {
        return $this->toggleStatus(
            StreamMaster::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPORARY DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            StreamMaster::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TRASH LIST
    |--------------------------------------------------------------------------
    */
    public function trash()
    {
        return $this->commonTrash(
            StreamMaster::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE STREAM
    |--------------------------------------------------------------------------
    */
    public function restore(Request $request)
    {
        return $this->commonRestore(
            StreamMaster::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PERMANENT DELETE
    |--------------------------------------------------------------------------
    */
    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            StreamMaster::class,
            $request
        );
    }
}
