<?php

namespace App\Http\Controllers\FeeModule;

use App\Http\Controllers\Controller;
use App\Models\FeeModule\FeeInstallmentMaster;
use App\Models\FeeModule\FeeInstallmentDetail;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeInstallmentMasterController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        $installments = FeeInstallmentMaster::with('details')
            ->orderBy('installment_name')
            ->get();

        $months = FeeInstallmentDetail::monthOptions();

        return view('School.Pages.FeeModule.feeInstallments', compact('installments', 'months'));
    }

    /**
     * Get one master with its details (for editing).
     */
    public function getById(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:fee_installment_masters,id',
        ]);

        $master = FeeInstallmentMaster::with('details')->findOrFail($request->id);

        return response()->json([
            'status' => true,
            'data'   => $master,
        ]);
    }

    /**
     * Create or update a master + sync all its detail rows in one go.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id'               => 'nullable|exists:fee_installment_masters,id',
            'installment_name' => 'required|string|max:100',
            'installment_code' => 'nullable|string|max:30',
            'description'      => 'nullable|string',
            'status'           => 'nullable|boolean',

            'details'                     => 'required|array|min:1',
            'details.*.id'                => 'nullable|integer',
            'details.*.installment_name'  => 'required|string|max:50',
            'details.*.installment_order' => 'required|integer|min:0',
            'details.*.start_month'       => 'nullable|integer|min:1|max:12',
            'details.*.end_month'         => 'nullable|integer|min:1|max:12',
            'details.*.due_day'           => 'nullable|integer|min:1|max:31',
            'details.*.fine_after_days'   => 'nullable|integer|min:0',
            'details.*.status'            => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $master = $request->filled('id')
                ? FeeInstallmentMaster::findOrFail($request->id)
                : new FeeInstallmentMaster();

            $master->fill([
                'school_id'        => null,
                'installment_name' => $request->installment_name,
                'installment_code' => $request->installment_code,
                'description'      => $request->description,
                'status'           => $request->has('status') ? (bool) $request->status : true,
            ]);

            $master->save();

            $incomingIds = collect($request->details)->pluck('id')->filter()->values();

            // Remove rows dropped on the UI
            $master->details()
                ->when($incomingIds->isNotEmpty(), fn($q) => $q->whereNotIn('id', $incomingIds))
                ->delete();

            foreach ($request->details as $row) {

                $detail = !empty($row['id'])
                    ? FeeInstallmentDetail::where('fee_installment_master_id', $master->id)->find($row['id'])
                    : null;

                $data = [
                    'school_id'                 => null,
                    'fee_installment_master_id' => $master->id,
                    'installment_name'          => $row['installment_name'],
                    'installment_order'         => $row['installment_order'],
                    'start_month'               => $row['start_month'] ?? null,
                    'end_month'                 => $row['end_month'] ?? null,
                    'due_day'                   => $row['due_day'] ?? null,
                    'fine_after_days'           => $row['fine_after_days'] ?? 0,
                    'status'                    => array_key_exists('status', $row) ? (bool) $row['status'] : true,
                ];

                $detail ? $detail->update($data) : FeeInstallmentDetail::create($data);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Fee installment plan saved successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(FeeInstallmentMaster::class, ['details']);
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(FeeInstallmentMaster::class, $request);
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(FeeInstallmentMaster::class, $request);
    }

    public function trash()
    {
        return $this->commonTrash(FeeInstallmentMaster::class);
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(FeeInstallmentMaster::class, $request);
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(FeeInstallmentMaster::class, $request);
    }
}
