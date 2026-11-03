<?php

namespace App\Http\Controllers\FeeModule;

use App\Http\Controllers\Controller;
use App\Models\FeeModule\FeeFineMaster;
use App\Models\FeeModule\FeeFineRule;
use App\Models\FeeModule\FeeFineRuleAmount;
use App\Models\TransportMonth;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeFineMasterController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('School.Pages.FeeModule.feefineMater');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'                             => 'nullable|exists:fee_fine_masters,id',
            'fine_name'                      => 'required|string|max:100',
            'fine_code'                      => 'nullable|string|max:30',
            'fine_type'                      => 'required|integer|in:1,2,3',
            'grace_days'                     => 'nullable|integer|min:0',
            'period_days'                    => 'nullable|integer|min:1',
            'description'                    => 'nullable|string',
            'status'                         => 'nullable|boolean',

            'rows'                           => 'array',
            'rows.*.transport_month_id'      => 'nullable|integer|exists:transport_months,id',
            'rows.*.from_day'                => 'required|integer|min:1',
            'rows.*.to_day'                  => 'required|integer|min:1',
            'rows.*.fine_amount'             => 'nullable|numeric|min:0',

            'rows.*.cells'                   => 'array',
            'rows.*.cells.*.target_month_id' => 'required|integer|exists:transport_months,id',
            'rows.*.cells.*.fine_amount'     => 'required|numeric|min:0',
        ]);

        if (
            $request->fine_type == FeeFineMaster::TYPE_MONTHLY &&
            empty($request->rows)
        ) {
            return response()->json([
                'status'  => false,
                'message' => 'Please fill at least one fine amount in the matrix.',
            ]);
        }

        DB::beginTransaction();

        try {

            $feeFineMaster = $request->filled('id')
                ? FeeFineMaster::findOrFail($request->id)
                : new FeeFineMaster();

            $feeFineMaster->school_id   = null;
            $feeFineMaster->fine_name   = $request->fine_name;
            $feeFineMaster->fine_code   = $request->fine_code;
            $feeFineMaster->fine_type   = $request->fine_type;
            $feeFineMaster->grace_days  = $request->grace_days ?? 0;
            $feeFineMaster->period_days = $request->period_days;
            $feeFineMaster->description = $request->description;
            $feeFineMaster->status      = $request->has('status') ? (bool) $request->status : false;

            $feeFineMaster->save();

            FeeFineRule::where('fee_fine_master_id', $feeFineMaster->id)->delete();

            if ($request->fine_type == FeeFineMaster::TYPE_MONTHLY) {

                foreach ($request->rows as $index => $row) {

                    $rule = FeeFineRule::create([
                        'fee_fine_master_id' => $feeFineMaster->id,
                        'transport_month_id' => $row['transport_month_id'],
                        'from_day'           => $row['from_day'],
                        'to_day'             => $row['to_day'],
                        'fine_amount'        => null,
                        'display_order'      => $row['display_order'] ?? $index,
                        'status'             => true,
                    ]);

                    foreach (($row['cells'] ?? []) as $cell) {

                        if ($cell['fine_amount'] === '' || $cell['fine_amount'] === null) {
                            continue;
                        }

                        FeeFineRuleAmount::create([
                            'fee_fine_rule_id' => $rule->id,
                            'target_month_id'  => $cell['target_month_id'],
                            'fine_amount'      => $cell['fine_amount'],
                        ]);
                    }
                }
            } else {

                foreach ($request->rows as $index => $row) {

                    FeeFineRule::create([
                        'fee_fine_master_id' => $feeFineMaster->id,
                        'transport_month_id' => null,
                        'from_day'           => $row['from_day'],
                        'to_day'             => $row['to_day'],
                        'fine_amount'        => $row['fine_amount'] ?? 0,
                        'display_order'      => $row['display_order'] ?? $index,
                        'status'             => true,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $feeFineMaster->wasRecentlyCreated
                    ? 'Fine master added successfully.'
                    : 'Fine master updated successfully.',
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
            FeeFineMaster::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            FeeFineMaster::class,
            []
        );
    }

    public function fetchMonths()
    {
        $months = TransportMonth::where('session_id', session('active_session_id'))
            ->where('status', true)
            ->orderBy('sort_order')
            ->get([
                'id',
                'month_name',
                'slug',
                'sort_order'
            ]);

        return response()->json([
            'status' => true,
            'data'   => $months,
        ]);
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            FeeFineMaster::class,
            $request,
            []
        );
    }

    // public function showWith(Request $request)
    // {
    //     $feeFineMaster = FeeFineMaster::with([
    //         'rules' => function ($q) {
    //             $q->orderBy('display_order');
    //         },
    //         'rules.amounts',
    //     ])
    //         ->find($request->id);

    //     if (!$feeFineMaster) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Fine master not found.'
    //         ]);
    //     }

    //     $matrix     = [];
    //     $simpleRows = [];

    //     foreach ($feeFineMaster->rules as $rule) {

    //         if ($feeFineMaster->fine_type == FeeFineMaster::TYPE_MONTHLY) {

    //             $rowKey = $rule->transport_month_id . '_' . $rule->from_day . '_' . $rule->to_day;

    //             $cells = [];
    //             foreach ($rule->amounts as $amount) {
    //                 $cells[$amount->target_month_id] = $amount->fine_amount;
    //             }

    //             $matrix[$rowKey] = $cells;
    //         } else {
    //             $simpleRows[] = [
    //                 'from_day'    => $rule->from_day,
    //                 'to_day'      => $rule->to_day,
    //                 'fine_amount' => $rule->fine_amount,
    //             ];
    //         }
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'data'   => [
    //             'master'      => $feeFineMaster,
    //             'matrix'      => $matrix,
    //             'simple_rows' => $simpleRows,  
    //         ],
    //     ]);
    // }

    public function showWith(Request $request)
    {
        $feeFineMaster = FeeFineMaster::with([
            'rules' => function ($q) {
                $q->orderBy('display_order');
            },
            'rules.amounts',
        ])->find($request->id);

        if (!$feeFineMaster) {
            return response()->json([
                'status'  => false,
                'message' => 'Fine master not found.'
            ]);
        }

        $matrix = [];
        $simpleRows = [];

        foreach ($feeFineMaster->rules as $index => $rule) {

            if ($feeFineMaster->fine_type == FeeFineMaster::TYPE_MONTHLY) {

                // Fallback for old records where transport_month_id is NULL
                $rowMonthId = $rule->transport_month_id;

                if (!$rowMonthId && isset($rule->amounts[0])) {
                    $rowMonthId = $rule->amounts[0]->target_month_id;
                }

                $rowKey = $rowMonthId . '_' . $rule->from_day . '_' . $rule->to_day;

                $cells = [];

                foreach ($rule->amounts as $amount) {
                    $cells[$amount->target_month_id] = $amount->fine_amount;
                }

                $matrix[$rowKey] = $cells;
            } else {

                $simpleRows[] = [
                    'id'          => $rule->id,
                    'from_day'    => $rule->from_day,
                    'to_day'      => $rule->to_day,
                    'fine_amount' => $rule->fine_amount,
                ];
            }
        }

        return response()->json([
            'status' => true,
            'data'   => [
                'master'      => $feeFineMaster,
                'matrix'      => $matrix,
                'simple_rows' => $simpleRows,
            ],
        ]);
    }
    public function status(Request $request)
    {
        return $this->toggleStatus(
            FeeFineMaster::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            FeeFineMaster::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            FeeFineMaster::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            FeeFineMaster::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            FeeFineMaster::class,
            $request
        );
    }
}
