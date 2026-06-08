<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\TransportMonth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Traits\CommonCrudOperations;

class TransportMonthController extends Controller
{
    use CommonCrudOperations;


    public function index()
    {
        return view(
            'Frontend/Normal/Pages/Master/transport-months'
        );
    }

    public function fetch()
    {
        return $this->commonFetch(
            TransportMonth::class,
            []
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            TransportMonth::class,
            $request,
            []
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'month_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {

            $slug = Str::slug($request->month_name);


            if ($request->filled('id')) {

                $transportMonth = TransportMonth::findOrFail(
                    $request->transport_month_id
                );

                $duplicate = TransportMonth::where('month_name', $request->month_name)
                    ->where('id', '!=', $request->id)
                    ->exists();

                if ($duplicate) {

                    return response()->json([
                        'status' => false,
                        'message' => 'Month already exists'
                    ]);
                }

                $transportMonth->update([
                    'month_name' => $request->month_name,
                    'slug' => $slug,
                    'transport_fee' => $request->transport_fee ?? true,
                    'is_transport_enable' => $request->is_transport_enable ?? false,
                    'status' => $request->status ?? true,
                    'session_id' => activeSession()->id
                ]);

                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'Transport month updated successfully'
                ]);
            }


            $exists = TransportMonth::where(
                'month_name',
                $request->month_name
            )->exists();

            if ($exists) {

                return response()->json([
                    'status' => false,
                    'message' => 'Month already exists'
                ]);
            }

            TransportMonth::create([
                'month_name' => $request->month_name,
                'slug' => $slug,
                'transport_fee' => $request->transport_fee ?? true,
                'is_transport_enable' => $request->is_transport_enable ?? false,
                'status' => true,
                'session_id' => activeSession()->id
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Transport month added successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            TransportMonth::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            TransportMonth::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            TransportMonth::class
        );
    }


    public function restore(Request $request)
    {
        return $this->commonRestore(
            TransportMonth::class,
            $request
        );
    }


    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            TransportMonth::class,
            $request
        );
    }


    // EXTRA METHODS

    public function is_enabled(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required|exists:transport_months,id',
                'is_transport_enable' => 'required|in:0,1',
            ]);

            $transportMonth = TransportMonth::findOrFail($request->id);

            $transportMonth->is_transport_enable = $request->is_transport_enable;
            $transportMonth->save();

            return response()->json([
                'status'  => true,
                'message' => $request->is_transport_enable
                    ? 'Transport enabled successfully.'
                    : 'Transport disabled successfully.',
                'data'    => $transportMonth
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
