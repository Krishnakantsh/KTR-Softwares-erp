<?php

namespace App\Http\Controllers\Hostel_System;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hostel_System\RoomType;
use App\Traits\CommonCrudOperations;

class RoomTypeController extends Controller
{

    use CommonCrudOperations;

    public function index()
    {

        return view(
            'Frontend/Normal/Pages/Hostels/manage_room_type'
        );
    }
    
    public function store(Request $request)
    {

        $request->validate([

            'room_type' => 'required|string|max:255',

            'bed_count' => 'nullable|integer|min:1',

            'fees' => 'nullable|numeric|min:0',

            'facilities' => 'nullable|string',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE CHECK
            |--------------------------------------------------------------------------
            */

            $duplicate = RoomType::where(
                'room_type',
                $request->room_type
            )

                ->where(
                    'session_id',
                    activeSession()->id ?? null
                )

                ->where(
                    'school_id',
                    Auth::id()
                )

                ->when($request->room_type_id, function ($query) use ($request) {

                    $query->where(
                        'id',
                        '!=',
                        $request->room_type_id
                    );
                })

                ->exists();

            if ($duplicate) {

                return response()->json([

                    'status' => false,

                    'message' => 'Room type already exists'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STORE OR UPDATE ROOM TYPE
            |--------------------------------------------------------------------------
            */

            RoomType::updateOrCreate(

                [

                    'id' => $request->room_type_id

                ],

                [

                    'room_type' => $request->room_type,

                    'bed_count' => $request->bed_count ?? 1,

                    'fees' => $request->fees ?? 0,

                    'facilities' => $request->facilities,

                    'status' => $request->status ?? true,

                    'session_id' => activeSession()->id ?? null,

                    'school_id' => Auth::id(),

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('room_type_id')

                    ? 'Room type updated successfully'

                    : 'Room type added successfully'

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
        return $this->commonFetch(RoomType::class, []);
    }

    public function fetch()
    {
        return $this->commonFetch(
            RoomType::class
        );
    }

    public function showWith(Request $request)
    {

        return $this->commonShow(RoomType::class, $request, []);
    }

    public function show(Request $request)
    {

        return $this->commonShow(RoomType::class, $request);
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            RoomType::class,
            $request
        );
    }

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            RoomType::class,
            $request
        );
    }
    
    public function trash()
    {

        return $this->commonTrash(
            RoomType::class
        );
    }

    public function restore(Request $request)
    {

        return $this->commonRestore(
            RoomType::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            RoomType::class,
            $request
        );
    }
}
