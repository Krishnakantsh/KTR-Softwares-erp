<?php

namespace App\Traits;

use App\Models\Student\Student;
use Exception;
use Illuminate\Http\Request;

trait CommonCrudOperations
{

    // public function commonFetch(
    //     $model,
    //     array $relations = [],
    //     array $whereConditions = [],
    //     $orderBy = 'id',
    //     $orderDir = 'desc',
    //     $groupBy = null,
    //     $limit = null,
    //     $for = null
    // ) {
    //     try {

    //         $table = (new $model)->getTable();

    //         $query = $model::query()->select($table . '.*');

    //         if (!empty($relations)) {
    //             $query->with($relations);
    //         }

    //         if (!empty($whereConditions)) {

    //             foreach ($whereConditions as $column => $value) {

    //                 if (is_array($value)) {

    //                     $query->whereIn($column, $value);
    //                 } else {

    //                     $query->where($column, $value);
    //                 }
    //             }
    //         }

    //         if (!empty($groupBy)) {
    //             $query->groupBy($groupBy);
    //         }

    //         if (!empty($orderBy)) {
    //             $query->orderBy($orderBy, $orderDir);
    //         }

    //         if (!empty($limit)) {
    //             $query->limit($limit);
    //         }


    //         if ($for === 'query') {
    //             return $query;
    //         }

    //         if ($for === 'first') {
    //             return $query->first();
    //         }

    //         if ($for === 'collection') {
    //             return $query->get();
    //         }

    //         return response()->json([
    //             'status' => true,
    //             'data'   => $query->get()
    //         ]);
    //     } catch (Exception $e) {

    //         if ($for) {
    //             throw $e;
    //         }

    //         return response()->json([
    //             'status'  => false,
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function commonFetch(
        $model,
        array $relations = [],
        array $whereConditions = [],
        $orderBy = 'id',
        $orderDir = 'desc',
        $groupBy = null,
        $limit = null,
        $for = null,
        array $columns = []
    ) {
        try {

            $table = (new $model)->getTable();

            $query = $model::query();

            // select columns
            if (!empty($columns)) {

                $selectColumns = [];

                foreach ($columns as $column) {

                    if (str_contains($column, '.')) {
                        $selectColumns[] = $column;
                    } else {
                        $selectColumns[] = $table . '.' . $column;
                    }
                }

                $query->select($selectColumns);
            } else {

                $query->select($table . '.*');
            }

            if (!empty($relations)) {
                $query->with($relations);
            }

            if (!empty($whereConditions)) {

                foreach ($whereConditions as $column => $value) {

                    if (is_array($value)) {
                        $query->whereIn($column, $value);
                    } else {
                        $query->where($column, $value);
                    }
                }
            }

            if (!empty($groupBy)) {
                $query->groupBy($groupBy);
            }

            if (!empty($orderBy)) {
                $query->orderBy($orderBy, $orderDir);
            }

            if (!empty($limit)) {
                $query->limit($limit);
            }

            if ($for === 'query') {
                return $query;
            }

            if ($for === 'first') {
                return $query->first();
            }

            if ($for === 'collection') {
                return $query->get();
            }

            return response()->json([
                'status' => true,
                'data'   => $query->get()
            ]);
        } catch (Exception $e) {

            if ($for) {
                throw $e;
            }

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function commonShow($model, Request $request, array $relations = [])
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $query = $model::query();

            if (!empty($relations)) {
                $query->with($relations);
            }

            $data = $query
                ->where(
                    'session_id',
                    activeSession()->id ?? null
                )
                ->findOrFail($request->id);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }
    }

    public function toggleStatus($model, Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $data = $model::findOrFail($request->id);

            $data->status = !$data->status;

            $data->save();

            return response()->json([
                'status' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }
    }

    public function commonDestroy($model, Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $data = $model::where(
                'session_id',
                activeSession()->id ?? null
            )->findOrFail($request->id);

            $data->delete();

            return response()->json([
                'status' => true,
                'message' => 'Record deleted successfully'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function commonTrash($model)
    {
        try {

            $data = $model::onlyTrashed()
                ->where(
                    'session_id',
                    activeSession()->id ?? null
                )
                ->latest()
                ->get();

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function commonRestore($model, Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $data = $model::onlyTrashed()
                ->where(
                    'session_id',
                    activeSession()->id ?? null
                )
                ->findOrFail($request->id);

            $data->restore();

            return response()->json([
                'status' => true,
                'message' => 'Record restored successfully'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function commonForceDelete($model, Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $data = $model::onlyTrashed()
                ->where(
                    'session_id',
                    activeSession()->id ?? null
                )
                ->findOrFail($request->id);

            $data->forceDelete();

            return response()->json([
                'status' => true,
                'message' => 'Record permanently deleted'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function isDuplicate($model, array $conditions, $ignoreId = null)
    {
        $query = $model::where($conditions)
            ->where(
                'session_id',
                activeSession()->id ?? null
            );

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    public function isDuplicateAny(
        $model,
        array $conditions,
        $ignoreId = null
    ) {
        $query = $model::where(function ($q) use ($conditions) {

            foreach ($conditions as $field => $value) {

                if (!empty($value)) {
                    $q->orWhere($field, $value);
                }
            }
        })
            ->where(
                'session_id',
                activeSession()->id ?? null
            );

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    public static function generateStudentSrNo()
    {
        $lastStudent = Student::whereNotNull('sr_no')
            ->where('session_id', activeSession()->id)
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastStudent || empty($lastStudent->sr_no)) {
            return 'SR0001';
        }


        preg_match('/(\d+)$/', (string) $lastStudent->sr_no, $matches);

        $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;

        $newNumber = $lastNumber + 1;

        return 'SR' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    public static function generateStudentAdmissionNo()
    {
        $lastStudent = Student::whereNotNull('admission_no')
            ->where('session_id', activeSession()->id)
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastStudent || empty($lastStudent->admission_no)) {
            return 'ADM0001';
        }

        preg_match('/(\d+)/', (string) $lastStudent->admission_no, $matches);

        $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;

        $newNumber = $lastNumber + 1;

        return 'ADM' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    public static function generateStudentEnrollmentNo()
    {
        $lastStudent = Student::whereNotNull('enroll_no')
            ->where('session_id', activeSession()->id)
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastStudent || empty($lastStudent->enroll_no)) {
            return 'ENR0001';
        }

        preg_match('/(\d+)/', (string) $lastStudent->enroll_no, $matches);

        $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;

        $newNumber = $lastNumber + 1;

        return 'ENR' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    public static function generateStudentSearchQuery(array $data)
    {
        $keys = ['sr_no', 'admission_no', 'enroll_no', 'first_name', 'last_name'];

        $parts = [];

        foreach ($keys as $key) {
            if (!empty($data[$key])) {
                $parts[] = $data[$key];
            }
        }

        return implode(' / ', $parts);
    }

    public function updateRecordField(
        $model,
        $request,
        string $column,
        array $allowedValues
    ) {

        try {

            $record = $model::find($request->id);

            if (!$record) {

                return response()->json([
                    'status' => false,
                    'message' => 'Record not found.'
                ]);
            }

            if (!in_array($request->$column, $allowedValues)) {

                return response()->json([
                    'status' => false,
                    'message' => 'Invalid value.'
                ]);
            }

            $record->$column = $request->$column;

            $record->save();

            return response()->json([
                'status' => true,
                'message' => ucfirst(str_replace('_', ' ', $column)) . ' updated successfully.'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
