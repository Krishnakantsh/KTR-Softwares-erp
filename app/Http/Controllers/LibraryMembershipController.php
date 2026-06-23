<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LibraryMembership;
use App\Traits\CommonCrudOperations;

class LibraryMembershipController extends Controller
{
    use CommonCrudOperations;

    // store
    public function store(Request $request)
    {
        $request->validate([
            'student_id'              => 'required|exists:students,id',
            'activation_date'         => 'required|date',
            'expiry_date'             => 'required|date|after_or_equal:activation_date',
            'max_borrow_limit'        => 'nullable|integer|min:1',
            'borrow_duration_days'    => 'nullable|integer|min:1',
            'security_deposit'        => 'nullable|numeric|min:0',
            'status'                  => 'required|integer',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'session_id'               => activeSession()->id,

                'student_id'               => $request->student_id,

                'membership_card_number'   =>  $this->generateLibraryMembershipNo(),

                'barcode_token'            => $request->barcode_token,
                'qr_code_payload'          => $request->qr_code_payload,

                'activation_date'          => $request->activation_date,
                'expiry_date'              => $request->expiry_date,
                'last_renewed_at'          => $request->last_renewed_at,

                'max_borrow_limit'         => $request->max_borrow_limit ?? 3,
                'borrow_duration_days'     => $request->borrow_duration_days ?? 14,

                'security_deposit'         => $request->security_deposit ?? 0,
                'is_deposit_refundable'    => $request->is_deposit_refundable ?? 1,

                'status'                   => $request->status,
                'suspension_reason'        => $request->suspension_reason,

                'admin_remarks'            => $request->admin_remarks,

                'created_by_user_id'       => Auth::id(),
            ];

            if ($request->filled('id')) {

                LibraryMembership::where('id', $request->id)
                    ->update($data);
            } else {

                LibraryMembership::create($data);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $request->filled('id')
                    ? 'Library membership updated successfully'
                    : 'Library membership created successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // fetch
    public function fetch()
    {
        return $this->commonFetch(
            LibraryMembership::class
        );
    }
    // fetch
    public function fetchWith()
    {
        return $this->commonFetch(
            LibraryMembership::class,
            ['student.classMaster','student.section']
        );
    }

    // show
    public function showWith(Request $request)
    {
        return $this->commonShow(
            LibraryMembership::class,
            $request,
            ['student']
        );
    }
    // show
    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryMembership::class,
            $request
        );
    }

    // status
    public function status(Request $request)
    {
        return $this->toggleStatus(
            LibraryMembership::class,
            $request
        );
    }

    // delete
    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryMembership::class,
            $request
        );
    }

    // trash
    public function trash()
    {
        return $this->commonTrash(
            LibraryMembership::class
        );
    }

    // restore
    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryMembership::class,
            $request
        );
    }

    // force delete
    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryMembership::class,
            $request
        );
    }
}
