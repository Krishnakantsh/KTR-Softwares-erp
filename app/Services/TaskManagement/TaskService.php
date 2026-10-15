<?php

namespace App\Services;

use App\Models\Payroll\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TaskService
{
    public static function addUpdateDepartMent(Request $request)
    {
        $uniqueRule = fn($field) => Rule::unique('departments', $field)
            ->where(fn($q) => $q->where('branch_id', $request->branch_id))
            ->ignore($request->id);

        $data = $request->validate([
            'id'                 => 'nullable|exists:departments,id',
            'branch_id'          => 'nullable|exists:branches,id',
            'department_name'    => ['required', 'string', 'max:150', $uniqueRule('department_name')],
            'department_code'    => ['nullable', 'string', 'max:30'],
            'email'              => 'nullable|email|max:255',
            'phone'              => 'nullable|string|max:20',
            'department_head_id' => 'nullable|integer',
            'description'        => 'nullable|string',
            'status'             => 'nullable|boolean',
        ]);

        return DB::transaction(function () use ($data, $request) {
            $department = Department::findOrNew($data['id'] ?? null);
            
            if (!$department->exists) {
                $department->school_id = tenantSchoolId();
                $department->created_by = loginId();
            }

            $department->fill([
                'branch_id'          => $data['branch_id'],
                'department_name'    => $data['department_name'],
                'department_code'    => $data['department_code'],
                'email'              => $data['email'] ?? null,
                'phone'              => $data['phone'] ?? null,
                'department_head_id' => $data['department_head_id'] ?? null,
                'description'        => $data['description'] ?? null,
                'status'             => $request->has('status') ? (bool) $request->status : true,
                'updated_by'         => loginId(),
            ])->save();

            return response()->json([
                'status'  => true,
                'message' => $department->wasRecentlyCreated ? 'Department added successfully.' : 'Department updated successfully.',
            ]);
        });
    }
}