<?php

namespace App\Http\Controllers\Hostel_System;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hostel_System\Hostel;
use App\Models\Hostel_System\HostelBlock;
use App\Traits\CommonCrudOperations;

class HostelBlockController extends Controller
{

    use CommonCrudOperations;

    public function index()
    {

        $hostels = Hostel::where('status', true)
            ->where('school_id', Auth::id())
            ->latest()
            ->get();

        return view(
            'Frontend/Normal/Pages/Hostels/manage_block',
            compact('hostels')
        );
    }


    public function store(Request $request)
    {

        $request->validate([

            'hostel_id' => 'required|integer|exists:hostels,id',

            'block_name' => 'required|string|max:255',

            'block_code' => 'nullable|string|max:100',

            'total_floors' => 'nullable|integer|min:0',

            'capacity' => 'nullable|integer|min:0',

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
            | DUPLICATE CHECK
            |--------------------------------------------------------------------------
            */

            $duplicate = HostelBlock::where('hostel_id', $request->hostel_id)

                ->where('block_name', $request->block_name)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->when($request->block_id, function ($query) use ($request) {

                    $query->where('id', '!=', $request->block_id);
                })

                ->exists();

            if ($duplicate) {

                return response()->json([

                    'status' => false,

                    'message' => 'This block already exists in the selected hostel'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STORE OR UPDATE
            |--------------------------------------------------------------------------
            */

            HostelBlock::updateOrCreate(

                [

                    'id' => $request->block_id

                ],

                [

                    'hostel_id' => $request->hostel_id,

                    'block_name' => $request->block_name,

                    'block_code' => $request->block_code,

                    'total_floors' => $request->total_floors ?? 0,

                    'capacity' => $request->capacity ?? 0,

                    'remarks' => $request->remarks,

                    'status' => $request->status ?? true,

                    'session_id' => activeSession()->id ?? null,

                    'school_id' => Auth::id(),

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('block_id')
                    ? 'Hostel block updated successfully'
                    : 'Hostel block added successfully'

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
        return $this->commonFetch(HostelBlock::class, ['hostel']);
    }



    public function fetch()
    {
        return $this->commonFetch(
            HostelBlock::class
        );
    }


    public function showWith(Request $request)
    {

        return $this->commonShow(HostelBlock::class, $request, []);
    }


    public function show(Request $request)
    {

        return $this->commonShow(HostelBlock::class, $request);
    }


    public function status(Request $request)
    {
        return $this->toggleStatus(
            HostelBlock::class,
            $request
        );
    }


    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            HostelBlock::class,
            $request
        );
    }

    public function trash()
    {

        return $this->commonTrash(
            HostelBlock::class
        );
    }

    public function restore(Request $request)
    {

        return $this->commonRestore(
            HostelBlock::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            HostelBlock::class,
            $request
        );
    }
}
