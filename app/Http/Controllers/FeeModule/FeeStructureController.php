<?php

namespace App\Http\Controllers\FeeModule;

use App\Http\Controllers\Controller;
use App\Models\ClassMaster;
use App\Models\FeeModule\FeeHead;
use App\Models\FeeModule\FeeInstallmentMaster;
use App\Models\FeeModule\FeeStructure;
use App\Models\FeeModule\FeeStructureDetail;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeStructureController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {

        return view('School.Pages.FeeModule.feeStructures');
    }

    public function getMatrix(Request $request)
    {
        $request->validate([
            'class_id'   => 'required|exists:class_masters,id',
            'strean_id' => 'nullable|exists:stream_masters,id',
        ]);

        $sessionId = activeSession()->id;

        $feeHeads = FeeHead::where('status', 1)->orderBy('head_name')->get();

        $installmentMasters = FeeInstallmentMaster::with(['details' => function ($q) {
            $q->where('status', 1)->orderBy('installment_order');
        }])->where('status', 1)->get();

        $structure = FeeStructure::with('details.installment')
            ->where('session_id', $sessionId)
            ->where('class_id', $request->class_id)
            ->first();


        $existing = [];

        if ($structure) {
            foreach ($structure->details as $row) {

                $detail = $row->installment;

                if (!$detail) {
                    continue;
                }

                if (!isset($existing[$row->fee_head_id])) {
                    $existing[$row->fee_head_id] = [
                        'fee_installment_master_id' => $detail->fee_installment_master_id,
                        'is_optional'                => (bool) $row->is_optional,
                        'cells'                      => [],
                    ];
                }

                $existing[$row->fee_head_id]['cells'][$detail->id] = (float) $row->amount;
            }
        }

        return response()->json([
            'status' => true,
            'data'   => [
                'session_id'          => $sessionId,
                'class_id'            => (int) $request->class_id,
                'structure_id'        => $structure->id ?? null,
                'stream_id'        => $structure->stream_id ?? null,
                'structure_name'      => $structure->structure_name ?? null,
                'fee_heads'           => $feeHeads,
                'installment_masters' => $installmentMasters,
                'existing'            => $existing,
            ],
        ]);
    }

    public function store(Request $request)
    {


        $request->validate([
            'class_id'       => 'required|exists:class_masters,id',
            'stream_id'       => 'nullable|exists:stream_masters,id',
            'structure_name' => 'required|string|max:150',

            'rows'                              => 'nullable|array',
            'rows.*.fee_head_id'                => 'required|exists:fee_heads,id',
            'rows.*.fee_installment_master_id'  => 'required|exists:fee_installment_masters,id',
            'rows.*.is_optional'                => 'nullable|boolean',
            'rows.*.cells'                      => 'required|array|min:1',
            'rows.*.cells.*.fee_installment_detail_id' => 'required|exists:fee_installment_details,id',
            'rows.*.cells.*.amount'                     => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {

            $structure = FeeStructure::updateOrCreate(
                [
                    'session_id' => activeSession()->id,
                    'class_id'   => $request->class_id,
                ],
                [
                    'school_id'      => null,
                    'stream_id'      => $request->stream_id ?? null,
                    'structure_name' => $request->structure_name,
                    'effective_from' => $request->effective_from ?? now()->toDateString(),
                    'effective_to'   => $request->effective_to,
                    'remarks'        => $request->remarks,
                    'status'         => 1,
                ]
            );


            FeeStructureDetail::withTrashed()
                ->where('fee_structure_id', $structure->id)
                ->forceDelete();

            $order = 0;
            $rows  = [];

            foreach ($request->input('rows', []) as $row) {
                foreach ($row['cells'] as $cell) {
                    $rows[] = [
                        'fee_structure_id'          => $structure->id,
                        'fee_head_id'               => $row['fee_head_id'],
                        'fee_installment_detail_id' => $cell['fee_installment_detail_id'],
                        'amount'                    => $cell['amount'],
                        'is_optional'               => !empty($row['is_optional']),
                        'allow_concession'          => true,
                        'allow_fine'                => true,
                        'display_order'             => $order++,
                        'status'                    => true,
                        'created_at'                => now(),
                        'updated_at'                => now(),
                    ];
                }
            }

            if (!empty($rows)) {
                FeeStructureDetail::insert($rows);
            }

            DB::commit();

            return response()->json([
                'status'       => true,
                'message'      => 'Fee structure saved successfully.',
                'structure_id' => $structure->id,
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
        return $this->commonFetch(
            FeeStructure::class
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            FeeStructure::class,
            ['class', 'details'],
             ['status' => 1],
            'class_id'
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            FeeStructure::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            FeeStructure::class,
            $request,
            ['class', 'details']
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            FeeStructure::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            FeeStructure::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            FeeStructure::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            FeeStructure::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            FeeStructure::class,
            $request
        );
    }
}
