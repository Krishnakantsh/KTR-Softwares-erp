<?php

namespace App\Http\Controllers\Hostel_System;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hostel_System\Hostel;
use App\Traits\CommonCrudOperations;

class HostelController extends Controller
{

    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend/Normal/Pages/Hostels/manage_hostel');
    }

    public function store(Request $request)
    {

        $request->validate([

            'hostel_name' => 'required|string|max:255',

            'hostel_code' => 'nullable|string|max:100',

            'warden_name' => 'nullable|string|max:255',

            'warden_mobile' => 'nullable|string|max:20',

            'address' => 'nullable|string',

            'total_blocks' => 'nullable|integer|min:0',

            'total_rooms' => 'nullable|integer|min:0',

            'capacity' => 'nullable|integer|min:0',

            'status' => 'nullable|boolean',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE CHECK
            |--------------------------------------------------------------------------
            */

            $duplicate = Hostel::where('hostel_name', $request->hostel_name)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->when($request->hostel_id, function ($query) use ($request) {

                    $query->where('id', '!=', $request->hostel_id);
                })

                ->exists();

            if ($duplicate) {

                return response()->json([
                    'status' => false,
                    'message' => 'Hostel already exists'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STORE OR UPDATE HOSTEL
            |--------------------------------------------------------------------------
            */

            Hostel::updateOrCreate(

                [
                    'id' => $request->hostel_id
                ],

                [

                    'hostel_name' => $request->hostel_name,

                    'hostel_code' => $request->hostel_code,

                    'warden_name' => $request->warden_name,

                    'warden_mobile' => $request->warden_mobile,

                    'address' => $request->address,

                    'total_blocks' => $request->total_blocks ?? 0,

                    'total_rooms' => $request->total_rooms ?? 0,

                    'capacity' => $request->capacity ?? 0,

                    'status' => $request->status ?? true,

                    'session_id' => activeSession()->id ?? null,

                    'school_id' => Auth::id(),

                ]

            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('hostel_id')
                    ? 'Hostel updated successfully'
                    : 'Hostel added successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function fetchWith()
    {
        return $this->commonFetch(Hostel::class, []);
    }


    public function fetch()
    {
        return $this->commonFetch(
            Hostel::class
        );
    }

    public function showWith(Request $request)
    {

        return $this->commonShow(Hostel::class, $request, ['']);
    }


    public function show(Request $request)
    {

        return $this->commonShow(Hostel::class, $request);
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            Hostel::class,
            $request
        );
    }


    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            Hostel::class,
            $request
        );
    }


    public function trash()
    {

        return $this->commonTrash(
            Hostel::class
        );
    }


    public function restore(Request $request)
    {

        return $this->commonRestore(
            Hostel::class,
            $request
        );
    }


    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            Hostel::class,
            $request
        );
    }
}
