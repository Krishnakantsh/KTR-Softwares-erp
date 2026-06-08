<?php

namespace App\Http\Controllers\Transport;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Transport\TransportVehicle;
use App\Traits\CommonCrudOperations;

class TransportVehicleController extends Controller
{

    use CommonCrudOperations;

    /*
    |--------------------------------------------------------------------------
    | INDEX PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('Frontend/Normal/Pages/Transport/Transport-Vehicle/manage_transport');
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL VEHICLES WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetchWith()
    {
        return $this->commonFetch(
            TransportVehicle::class,
            []
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL VEHICLES WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetch()
    {
        return $this->commonFetch(
            TransportVehicle::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE VEHICLE WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function showWith(Request $request)
    {
        return $this->commonShow(
            TransportVehicle::class,
            $request,
            []
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE VEHICLE WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function show(Request $request)
    {
        return $this->commonShow(
            TransportVehicle::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE & UPDATE VEHICLE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'vehicle_name' => 'required|string|max:255',

            'vehicle_number' => 'required|string|max:255',

            'vehicle_type' => 'nullable|string|max:255',

            'driver_name' => 'required|string|max:255',

            'driver_phone' => 'required|string|max:20',

            'conductor_name' => 'nullable|string|max:255',

            'conductor_phone' => 'nullable|string|max:20',

            'seat_capacity' => 'nullable|integer|min:0',

            'insurance_number' => 'nullable|string|max:255',

            'insurance_expiry' => 'nullable|date',

            'pollution_number' => 'nullable|string|max:255',

            'pollution_expiry' => 'nullable|date',

            'fitness_certificate' => 'nullable|string|max:255',

            'fitness_expiry' => 'nullable|date',

            'rc_number' => 'nullable|string|max:255',

            'monthly_maintenance_cost' => 'nullable|numeric|min:0',

            'notes' => 'nullable|string',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE VEHICLE NUMBER CHECK
            |--------------------------------------------------------------------------
            */

            $duplicate = TransportVehicle::where('vehicle_number', $request->vehicle_number)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->when($request->filled('vehicle_id'), function ($query) use ($request) {

                    $query->where('id', '!=', $request->vehicle_id);
                })

                ->exists();

            if ($duplicate) {

                return response()->json([

                    'status' => false,

                    'message' => 'Vehicle number already exists'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STORE OR UPDATE VEHICLE
            |--------------------------------------------------------------------------
            */

            $vehicle = TransportVehicle::updateOrCreate(

                [
                    'id' => $request->vehicle_id
                ],

                [

                    'vehicle_name' => $request->vehicle_name,

                    'vehicle_number' => $request->vehicle_number,

                    'vehicle_type' => $request->vehicle_type,

                    'driver_name' => $request->driver_name,

                    'driver_phone' => $request->driver_phone,

                    'conductor_name' => $request->conductor_name,

                    'conductor_phone' => $request->conductor_phone,

                    'seat_capacity' => $request->seat_capacity ?? 0,

                    'insurance_number' => $request->insurance_number,

                    'insurance_expiry' => $request->insurance_expiry,

                    'pollution_number' => $request->pollution_number,

                    'pollution_expiry' => $request->pollution_expiry,

                    'fitness_certificate' => $request->fitness_certificate,

                    'fitness_expiry' => $request->fitness_expiry,

                    'rc_number' => $request->rc_number,

                    'monthly_maintenance_cost' => $request->monthly_maintenance_cost ?? 0,

                    'notes' => $request->notes,

                    'status' => $request->status ?? true,

                    'session_id' => activeSession()->id ?? null,

                    'school_id' => Auth::id(),

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('vehicle_id')
                    ? 'Vehicle updated successfully'
                    : 'Vehicle added successfully',

                'data' => $vehicle

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
    | TOGGLE VEHICLE STATUS
    |--------------------------------------------------------------------------
    */

    public function status(Request $request)
    {
        return $this->toggleStatus(
            TransportVehicle::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPORARY DELETE VEHICLE
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            TransportVehicle::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VEHICLE TRASH LIST
    |--------------------------------------------------------------------------
    */

    public function trash()
    {
        return $this->commonTrash(
            TransportVehicle::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE VEHICLE
    |--------------------------------------------------------------------------
    */

    public function restore(Request $request)
    {
        return $this->commonRestore(
            TransportVehicle::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PERMANENT DELETE VEHICLE
    |--------------------------------------------------------------------------
    */

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            TransportVehicle::class,
            $request
        );
    }
}
