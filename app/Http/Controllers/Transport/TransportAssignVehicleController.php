<?php

namespace App\Http\Controllers\Transport;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Transport\TransportAssignVehicle;
use App\Models\Transport\TransportRoute;
use App\Models\Transport\TransportVehicle;
use App\Traits\CommonCrudOperations;

class TransportAssignVehicleController extends Controller
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

        $vehicles = TransportVehicle::where('status', true)

            ->where('school_id', Auth::id())

            ->latest()

            ->get();

        return view(
            'Frontend/Normal/Pages/Transport/Transport_Asign_Route/index',
            compact('routes', 'vehicles')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE & UPDATE ASSIGNED VEHICLE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'transport_vehicle_id' => 'required|integer|exists:transport_vehicles,id',

            'transport_route_id' => 'required|integer|exists:transport_routes,id',

            'shift' => 'nullable|string|max:100',

            'assign_date' => 'nullable|date',

            'remarks' => 'nullable|string',

            'status' => 'nullable|boolean',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | CHECK VEHICLE
            |--------------------------------------------------------------------------
            */

            $vehicle = TransportVehicle::where('id', $request->transport_vehicle_id)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->first();

            if (!$vehicle) {

                return response()->json([

                    'status' => false,

                    'message' => 'Transport vehicle not found'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CHECK ROUTE
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

            $duplicate = TransportAssignVehicle::where('transport_vehicle_id', $request->transport_vehicle_id)

                ->where('transport_route_id', $request->transport_route_id)

                ->where('shift', $request->shift)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->when($request->assign_vehicle_id, function ($query) use ($request) {

                    $query->where('id', '!=', $request->assign_vehicle_id);
                })

                ->exists();

            if ($duplicate) {

                return response()->json([

                    'status' => false,

                    'message' => 'This vehicle is already assigned to the selected route and shift'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STORE OR UPDATE ASSIGNED VEHICLE
            |--------------------------------------------------------------------------
            */

            $assignVehicle = TransportAssignVehicle::updateOrCreate(

                [

                    'id' => $request->assign_vehicle_id

                ],

                [

                    'transport_vehicle_id' => $request->transport_vehicle_id,

                    'transport_route_id' => $request->transport_route_id,

                    'shift' => $request->shift,

                    'assign_date' => $request->assign_date,

                    'remarks' => $request->remarks,

                    'status' => $request->status ?? true,

                    'session_id' => activeSession()->id ?? null,

                    'school_id' => Auth::id(),

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('assign_vehicle_id')
                    ? 'Assigned vehicle updated successfully'
                    : 'Assigned vehicle added successfully',

                'data' => $assignVehicle

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
    | FETCH ALL ASSIGNED VEHICLES WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetchWith()
    {

        return $this->commonFetch(

            TransportAssignVehicle::class,

            [

                'vehicle',
                'route'

            ]

        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL ASSIGNED VEHICLES WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetch()
    {

        return $this->commonFetch(
            TransportAssignVehicle::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE ASSIGNED VEHICLE WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function showWith(Request $request)
    {

        return $this->commonShow(

            TransportAssignVehicle::class,

            $request,

            [

                'vehicle',
                'route'

            ]

        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE ASSIGNED VEHICLE WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function show(Request $request)
    {

        return $this->commonShow(
            TransportAssignVehicle::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE ASSIGNED VEHICLE STATUS
    |--------------------------------------------------------------------------
    */

    public function status(Request $request)
    {

        return $this->toggleStatus(
            TransportAssignVehicle::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPORARY DELETE ASSIGNED VEHICLE
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            TransportAssignVehicle::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ASSIGNED VEHICLE TRASH LIST
    |--------------------------------------------------------------------------
    */

    public function trash()
    {

        return $this->commonTrash(

            TransportAssignVehicle::class,

            [

                'vehicle',
                'route'

            ]

        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE ASSIGNED VEHICLE
    |--------------------------------------------------------------------------
    */

    public function restore(Request $request)
    {

        return $this->commonRestore(
            TransportAssignVehicle::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PERMANENT DELETE ASSIGNED VEHICLE
    |--------------------------------------------------------------------------
    */

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            TransportAssignVehicle::class,
            $request
        );
    }
}
