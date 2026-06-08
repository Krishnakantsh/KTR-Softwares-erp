<?php

namespace App\Http\Controllers\Transport;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Transport\TransportRoute;
use App\Traits\CommonCrudOperations;

class TransportRouteController extends Controller
{

    use CommonCrudOperations;

    /*
    |--------------------------------------------------------------------------
    | INDEX PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('Frontend/Normal/Pages/Transport/Transport-Route/transport_route');
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL ROUTES WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetchWith()
    {
        return $this->commonFetch(
            TransportRoute::class,
            []
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL ROUTES WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fetch()
    {
        return $this->commonFetch(
            TransportRoute::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE ROUTE WITH RELATIONS
    |--------------------------------------------------------------------------
    */

    public function showWith(Request $request)
    {
        return $this->commonShow(
            TransportRoute::class,
            $request,
            []
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE ROUTE WITHOUT RELATIONS
    |--------------------------------------------------------------------------
    */

    public function show(Request $request)
    {
        return $this->commonShow(
            TransportRoute::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE & UPDATE ROUTE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'route_name' => 'required|string|max:255',

            'route_code' => 'nullable|string|max:255',

            'start_point' => 'required|string|max:255',

            'end_point' => 'required|string|max:255',

            'total_distance' => 'nullable|numeric|min:0',

            'estimated_time' => 'nullable|integer|min:0',

            'route_description' => 'nullable|string',

        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE ROUTE CHECK
            |--------------------------------------------------------------------------
            */

            $duplicate = TransportRoute::where('route_name', $request->route_name)

                ->where('session_id', activeSession()->id ?? null)

                ->where('school_id', Auth::id())

                ->when($request->filled('route_id'), function ($query) use ($request) {

                    $query->where('id', '!=', $request->route_id);
                })

                ->exists();

            if ($duplicate) {

                return response()->json([

                    'status' => false,

                    'message' => 'Route already exists'

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | STORE OR UPDATE ROUTE
            |--------------------------------------------------------------------------
            */

            $route = TransportRoute::updateOrCreate(

                [
                    'id' => $request->route_id
                ],

                [

                    'route_name' => $request->route_name,

                    'route_code' => $request->route_code,

                    'start_point' => $request->start_point,

                    'end_point' => $request->end_point,

                    'total_distance' => $request->total_distance,

                    'estimated_time' => $request->estimated_time,

                    'route_description' => $request->route_description,

                    'status' => $request->status ?? true,

                    'session_id' => activeSession()->id ?? null,

                    'school_id' => Auth::id(),

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('route_id')
                    ? 'Route updated successfully'
                    : 'Route added successfully',

                'data' => $route

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
    | TOGGLE ROUTE STATUS
    |--------------------------------------------------------------------------
    */

    public function status(Request $request)
    {
        return $this->toggleStatus(
            TransportRoute::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPORARY DELETE ROUTE
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            TransportRoute::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ROUTE TRASH LIST
    |--------------------------------------------------------------------------
    */

    public function trash()
    {
        return $this->commonTrash(
            TransportRoute::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE ROUTE
    |--------------------------------------------------------------------------
    */

    public function restore(Request $request)
    {
        return $this->commonRestore(
            TransportRoute::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PERMANENT DELETE ROUTE
    |--------------------------------------------------------------------------
    */

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            TransportRoute::class,
            $request
        );
    }
}