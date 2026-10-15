<?php

namespace App\Http\Controllers\Complaints;

use App\Http\Controllers\Controller;
use App\Models\Complaints\ComplaintType;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ComplaintTypeController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('School.Pages.Complaints.complaintTypes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'nullable|exists:complaint_types,id',

            'complaint_for' => [
                'required',
                Rule::in([1, 2, 3]),
            ],

            'type_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('complaint_types')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('school_id', null)
                            ->where('complaint_for', $request->complaint_for)
                            ->whereNull('deleted_at');
                    })
                    ->ignore($request->id),
            ],

            'description' => 'nullable|string|max:255',

            'default_priority' => [
                'required',
                Rule::in([1, 2, 3, 4]),
            ],

            'status' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $complaintType = $request->filled('id')
                ? ComplaintType::findOrFail($request->id)
                : new ComplaintType();

            $complaintType->school_id        = null;
            $complaintType->complaint_for    = $request->complaint_for;
            $complaintType->type_name        = $request->type_name;
            $complaintType->description      = $request->description;
            $complaintType->default_priority = $request->default_priority;
            $complaintType->status           = $request->has('status') ? (bool) $request->status : false;

            $complaintType->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $complaintType->wasRecentlyCreated
                    ? 'Complaint type added successfully.'
                    : 'Complaint type updated successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            ComplaintType::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            ComplaintType::class,
            []
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            ComplaintType::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            ComplaintType::class,
            $request,
            []
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            ComplaintType::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            ComplaintType::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            ComplaintType::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            ComplaintType::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            ComplaintType::class,
            $request
        );
    }
}
