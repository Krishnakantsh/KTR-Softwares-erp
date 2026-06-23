<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibraryDamage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonCrudOperations;

class LibraryDamageController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend.Normal.Pages.Library.damage');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id'     => 'required|integer',
            'quantity'    => 'required|integer|min:1',
            'damage_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'school_id' => null,
                'session_id' => activeSession()->id,

                'book_id' => $request->book_id,

                'quantity' => $request->quantity,

                'damage_date' => $request->damage_date,

                'remarks' => $request->remarks,

                'updated_by' => Auth::id(),
            ];

            if ($request->filled('id')) {

                LibraryDamage::where('id', $request->id)
                    ->update($data);
            } else {

                $data['created_by'] = Auth::id();

                LibraryDamage::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('id')
                    ? 'Damage record updated successfully'
                    : 'Damage record added successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            LibraryDamage::class
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryDamage::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryDamage::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            LibraryDamage::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryDamage::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryDamage::class,
            $request
        );
    }
}