<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicSessionController extends Controller
{

    public function fetch()
    {

        $sessions = AcademicSession::latest()->get();

        return response()->json([
            "status" => true,
            "data" => $sessions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function change(Request $request)
    {
        /**
         * Validate Request
         */
        $validated = $request->validate([
            'session_id' => 'required|integer|exists:academic_sessions,id',
        ]);

        try {

            DB::beginTransaction();

            /**
             * Check Session Exists & Active
             */
            $session = AcademicSession::where('id', $validated['session_id'])
                ->where('status', 1)
                ->first();

            if (!$session) {

                return back()->with(
                    'error',
                    'Selected session is invalid or inactive.'
                );
            }

            /**
             * Reset All Sessions
             */
            AcademicSession::query()->update([
                'is_active' => 0
            ]);

            /**
             * Activate Selected Session
             */
            $session->update([
                'is_active' => 1
            ]);

            DB::commit();

            return back()->with(
                'success',
                'Academic session changed successfully.'
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Something went wrong while changing session.'
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicSession $academicSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicSession $academicSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicSession $academicSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicSession $academicSession)
    {
        //
    }
}
