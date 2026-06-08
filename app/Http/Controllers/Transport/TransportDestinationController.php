<?php

namespace App\Http\Controllers\Transport;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Transport\TransportDestination;
use App\Models\Transport\TransportRoute;
use App\Traits\CommonCrudOperations;

class TransportDestinationController extends Controller
{

    use CommonCrudOperations;


    /*
    |--------------------------------------------------------------------------
    | INDEX PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $routes = TransportRoute::where('status', true)

            ->where('school_id', Auth::id())

            ->latest()

            ->get();

        return view(
            'Frontend/Normal/Pages/Transport/Transport_Destination/transport_destination',
            compact('routes')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE & UPDATE DESTINATION
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'transport_route_id' => 'required|integer|exists:transport_routes,id',

            'destination_name' => 'required|string|max:255',

            'pickup_time' => 'nullable',

            'drop_time' => 'nullable',

            'stop_order' => 'nullable|integer|min:0',

            'distance_from_school' => 'nullable|numeric|min:0',

            'transport_fee' => 'nullable|numeric|min:0',

            'address' => 'nullable|string',

            'status' => 'nullable|boolean',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | CHECK ROUTE EXISTS
            |--------------------------------------------------------------------------
            */

            $route = TransportRoute::where('id', $request->transport_route_id)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->first();

            if (!$route) {

                return response()->json([

                    'status' => false,

                    'message' => 'Transport route not found'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE CHECK
            |--------------------------------------------------------------------------
            */

            $duplicate = TransportDestination::where('transport_route_id', $request->transport_route_id)

                ->where('destination_name', $request->destination_name)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->when($request->destination_id, function ($query) use ($request) {

                    $query->where('id', '!=', $request->destination_id);
                })

                ->exists();

            if ($duplicate) {

                return response()->json([

                    'status' => false,

                    'message' => 'This destination already exists on the selected route'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STORE OR UPDATE DESTINATION
            |--------------------------------------------------------------------------
            */

            $destination = TransportDestination::updateOrCreate(

                [

                    'id' => $request->destination_id

                ],

                [

                    'transport_route_id' => $request->transport_route_id,

                    'destination_name' => $request->destination_name,

                    'pickup_time' => $request->pickup_time,

                    'drop_time' => $request->drop_time,

                    'stop_order' => $request->stop_order ?? 0,

                    'distance_from_school' => $request->distance_from_school ?? 0,

                    'transport_fee' => $request->transport_fee ?? 0,

                    'address' => $request->address,

                    'status' => $request->status ?? true,

                    'session_id' => activeSession()->id ?? null,

                    'school_id' => Auth::id(),

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('destination_id')
                    ? 'Transport destination updated successfully'
                    : 'Transport destination added successfully',

                'data' => $destination

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
    | FETCH ALL DESTINATIONS WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetchWith()
    {

        return $this->commonFetch(

            TransportDestination::class,

            ['route']

        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL DESTINATIONS WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetch()
    {

        return $this->commonFetch(
            TransportDestination::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE DESTINATION WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function showWith(Request $request)
    {

        return $this->commonShow(

            TransportDestination::class,

            $request,

            ['route']

        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE DESTINATION WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function show(Request $request)
    {

        return $this->commonShow(
            TransportDestination::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE DESTINATION STATUS
    |--------------------------------------------------------------------------
    */

    public function status(Request $request)
    {

        return $this->toggleStatus(
            TransportDestination::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPORARY DELETE DESTINATION
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            TransportDestination::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DESTINATION TRASH LIST
    |--------------------------------------------------------------------------
    */

    public function trash()
    {

        return $this->commonTrash(

            TransportDestination::class

        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE DESTINATION
    |--------------------------------------------------------------------------
    */

    public function restore(Request $request)
    {

        return $this->commonRestore(
            TransportDestination::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PERMANENT DELETE DESTINATION
    |--------------------------------------------------------------------------
    */

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            TransportDestination::class,
            $request
        );
    }

}
