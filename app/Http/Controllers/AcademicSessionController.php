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


    public function change(Request $request)
    {

        $validated = $request->validate([
            'session_id' => 'required|integer|exists:academic_sessions,id',
        ]);

        try {

            DB::beginTransaction();


            $session = AcademicSession::where('id', $validated['session_id'])
                ->where('status', 1)
                ->first();

            if (!$session) {

                return back()->with(
                    'error',
                    'Selected session is invalid or inactive.'
                );
            }


            AcademicSession::query()->update([
                'is_active' => 0
            ]);


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
}
