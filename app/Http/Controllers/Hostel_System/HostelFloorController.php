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
use App\Traits\CommonCrudOperations;

class HostelFloorController extends Controller
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

        return view(
            'Frontend/Normal/Pages/Hostels/manage_floor',
            compact('hostels', 'blocks')
        );
    }

    public function store(Request $request)
    {

        $request->validate([

            'hostel_id' => 'required|integer|exists:hostels,id',

            'hostel_block_id' => 'required|integer|exists:hostel_blocks,id',

            'floor_name' => 'required|string|max:255',

            'floor_number' => 'required|integer|min:1',

            'total_rooms' => 'nullable|integer|min:0',

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
            | DUPLICATE CHECK
            |--------------------------------------------------------------------------
            */

            $duplicate = HostelFloor::where('hostel_id', $request->hostel_id)

                ->where('hostel_block_id', $request->hostel_block_id)

                ->where('floor_number', $request->floor_number)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->when($request->floor_id, function ($query) use ($request) {

                    $query->where('id', '!=', $request->floor_id);
                })

                ->exists();

            if ($duplicate) {

                return response()->json([

                    'status' => false,

                    'message' => 'This floor number already exists in the selected block'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STORE OR UPDATE
            |--------------------------------------------------------------------------
            */

            HostelFloor::updateOrCreate(

                [

                    'id' => $request->floor_id

                ],

                [

                    'hostel_id' => $request->hostel_id,

                    'hostel_block_id' => $request->hostel_block_id,

                    'floor_name' => $request->floor_name,

                    'floor_number' => $request->floor_number,

                    'total_rooms' => $request->total_rooms ?? 0,

                    'remarks' => $request->remarks,

                    'status' => $request->status ?? true,

                    'session_id' => activeSession()->id ?? null,

                    'school_id' => Auth::id(),

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('floor_id')
                    ? 'Hostel floor updated successfully'
                    : 'Hostel floor added successfully'

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
        return $this->commonFetch(HostelFloor::class, ['hostel', 'block']);
    }

    public function fetch()
    {
        return $this->commonFetch(
            HostelFloor::class
        );
    }


    public function showWith(Request $request)
    {

        return $this->commonShow(HostelFloor::class, $request, ['hostel', 'block']);
    }

    public function show(Request $request)
    {

        return $this->commonShow(HostelFloor::class, $request);
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            HostelFloor::class,
            $request
        );
    }

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            HostelFloor::class,
            $request
        );
    }


    public function trash()
    {

        return $this->commonTrash(
            HostelFloor::class
        );
    }

    public function restore(Request $request)
    {

        return $this->commonRestore(
            HostelFloor::class,
            $request
        );
    }


    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            HostelFloor::class,
            $request
        );
    }
}
