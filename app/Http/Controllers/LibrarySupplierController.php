<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibrarySupplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonCrudOperations;

class LibrarySupplierController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend.Normal.Pages.Library.supplier');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name'    => 'required|string|max:255',
            'contact_person'   => 'nullable|string|max:255',
            'mobile'           => 'nullable|string|max:20',
            'alternate_mobile' => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:255',
            'gst_number'       => 'nullable|string|max:50',
            'status'           => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'school_id' => null,
                'session_id' => activeSession()->id,

                'supplier_name' => $request->supplier_name,

                'slug' => $request->slug
                    ? Str::slug($request->slug)
                    : Str::slug($request->supplier_name),

                'contact_person' => $request->contact_person,
                'mobile' => $request->mobile,
                'alternate_mobile' => $request->alternate_mobile,
                'email' => $request->email,
                'gst_number' => $request->gst_number,
                'address' => $request->address,

                'status' => (int) $request->status,

                'updated_by' => Auth::id(),
            ];

            if ($request->filled('id')) {

                LibrarySupplier::where('id', $request->id)
                    ->update($data);
            } else {

                $data['created_by'] = Auth::id();

                LibrarySupplier::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('id')
                    ? 'Supplier updated successfully'
                    : 'Supplier added successfully'
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
            LibrarySupplier::class
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            LibrarySupplier::class,
            $request
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            LibrarySupplier::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibrarySupplier::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            LibrarySupplier::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibrarySupplier::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibrarySupplier::class,
            $request
        );
    }
}
