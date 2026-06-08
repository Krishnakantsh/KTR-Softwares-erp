<?php

namespace App\Http\Controllers\Hostel_System;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hostel_System\Hostel;
use App\Models\Hostel_System\HostelBlock;
use App\Models\Hostel_System\HostelFloor;
use App\Models\Hostel_System\RoomMaster;
use App\Models\Hostel_System\RoomType;
use App\Traits\CommonCrudOperations;

class RoomMasterController extends Controller
{
    use CommonCrudOperations;


    public function index()
    {

        $hostels = Hostel::where('status', true)

            ->where('school_id', Auth::id())

            ->latest()

            ->get();

        $blocks = HostelBlock::where('status', true)

            ->where('school_id', Auth::id())

            ->latest()

            ->get();

        $floors = HostelFloor::where('status', true)

            ->where('school_id', Auth::id())

            ->latest()

            ->get();

        $roomTypes = RoomType::where('status', true)

            ->where('school_id', Auth::id())

            ->latest()

            ->get();

        return view(
            'Frontend/Normal/Pages/Hostels/room_master',
            compact(
                'hostels',
                'blocks',
                'floors',
                'roomTypes'
            )
        );
    }

    public function store(Request $request)
    {

        $request->validate([

            'hostel_id' => 'required|integer|exists:hostels,id',

            'hostel_block_id' => 'required|integer|exists:hostel_blocks,id',

            'hostel_floor_id' => 'required|integer|exists:hostel_floors,id',

            'room_type_id' => 'required|integer|exists:room_types,id',

            'room_number' => 'required|string|max:100',

            'total_beds' => 'required|integer|min:1',

            'occupied_beds' => 'nullable|integer|min:0',

            'available_beds' => 'nullable|integer|min:0',

            'facilities' => 'nullable|string',

            'remarks' => 'nullable|string',

            'status' => 'nullable|boolean',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | CHECK HOSTEL
            |--------------------------------------------------------------------------
            */

            $hostel = Hostel::where('id', $request->hostel_id)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->first();

            if (!$hostel) {

                return response()->json([

                    'status' => false,

                    'message' => 'Hostel not found'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CHECK BLOCK
            |--------------------------------------------------------------------------
            */

            $block = HostelBlock::where('id', $request->hostel_block_id)

                ->where('hostel_id', $request->hostel_id)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->first();

            if (!$block) {

                return response()->json([

                    'status' => false,

                    'message' => 'Hostel block not found'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CHECK FLOOR
            |--------------------------------------------------------------------------
            */

            $floor = HostelFloor::where('id', $request->hostel_floor_id)

                ->where('hostel_id', $request->hostel_id)

                ->where('hostel_block_id', $request->hostel_block_id)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->first();

            if (!$floor) {

                return response()->json([

                    'status' => false,

                    'message' => 'Hostel floor not found'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CHECK ROOM TYPE
            |--------------------------------------------------------------------------
            */

            $roomType = RoomType::where('id', $request->room_type_id)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->first();

            if (!$roomType) {

                return response()->json([

                    'status' => false,

                    'message' => 'Room type not found'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE CHECK
            |--------------------------------------------------------------------------
            */

            $duplicate = RoomMaster::where('hostel_id', $request->hostel_id)

                ->where('hostel_block_id', $request->hostel_block_id)

                ->where('hostel_floor_id', $request->hostel_floor_id)

                ->where('room_number', $request->room_number)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->when($request->room_id, function ($query) use ($request) {

                    $query->where('id', '!=', $request->room_id);
                })

                ->exists();

            if ($duplicate) {

                return response()->json([

                    'status' => false,

                    'message' => 'Room number already exists on this floor'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | BED CALCULATION
            |--------------------------------------------------------------------------
            */

            $totalBeds = (int) $request->total_beds;

            $occupiedBeds = (int) ($request->occupied_beds ?? 0);

            $availableBeds = $totalBeds - $occupiedBeds;

            if ($occupiedBeds > $totalBeds) {

                return response()->json([

                    'status' => false,

                    'message' => 'Occupied beds cannot exceed total beds'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STORE OR UPDATE
            |--------------------------------------------------------------------------
            */

            RoomMaster::updateOrCreate(

                [

                    'id' => $request->room_id

                ],

                [

                    'hostel_id' => $request->hostel_id,

                    'hostel_block_id' => $request->hostel_block_id,

                    'hostel_floor_id' => $request->hostel_floor_id,

                    'room_type_id' => $request->room_type_id,

                    'room_number' => $request->room_number,

                    'total_beds' => $totalBeds,

                    'occupied_beds' => $occupiedBeds,

                    'available_beds' => $availableBeds,

                    'facilities' => $request->facilities,

                    'remarks' => $request->remarks,

                    'status' => $request->status ?? true,

                    'session_id' => activeSession()->id ?? null,

                    'school_id' => Auth::id(),

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('room_id')
                    ? 'Room updated successfully'
                    : 'Room added successfully'

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
        return $this->commonFetch(RoomMaster::class, ['hostel', 'block', 'floor', 'roomType']);
    }

    public function fetch()
    {
        return $this->commonFetch(
            RoomMaster::class
        );
    }

    public function showWith(Request $request)
    {

        return $this->commonShow(RoomMaster::class, $request, ['hostel', 'block', 'floor', 'roomType']);
    }

    public function show(Request $request)
    {

        return $this->commonShow(RoomMaster::class, $request);
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            RoomMaster::class,
            $request
        );
    }

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            RoomMaster::class,
            $request
        );
    }

    public function trash()
    {

        return $this->commonTrash(
            RoomMaster::class
        );
    }

    public function restore(Request $request)
    {

        return $this->commonRestore(
            RoomMaster::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            RoomMaster::class,
            $request
        );
    }
}
