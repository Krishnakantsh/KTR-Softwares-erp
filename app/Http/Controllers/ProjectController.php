<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Tasks\Project;
use App\Traits\CommonCrudOperations;

class ProjectController extends Controller
{

    use CommonCrudOperations;

    private const STATUSES   = ['planning', 'in_progress', 'on_hold', 'completed', 'cancelled'];
    private const PRIORITIES = ['low', 'medium', 'high', 'critical'];


    public function index()
    {
        return view('School.Pages.Project.project');
    }

    public function fetchWith()
    {

        return $this->commonFetch(
            Project::class,
            ['projectManager'],
            [],
            'created_at',
            'desc'
        );
    }

    public function fetch()
    {

        return $this->commonFetch(
            Project::class
        );
    }

    public function showWith(Request $request)
    {

        return $this->commonShow(
            Project::class,
            $request,
            []
        );
    }

    public function show(Request $request)
    {

        return $this->commonShow(
            Project::class,
            $request
        );
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'               => 'required|string|max:200',
            'project_key'        => 'nullable|string|max:30',
            'description'        => 'nullable|string',
            'project_type'       => 'required|string|max:30',
            'status'             => ['required', Rule::in(self::STATUSES)],
            'priority'           => ['required', Rule::in(self::PRIORITIES)],
            'owner'              => 'nullable|string|max:20',
            'project_manager_id' => 'nullable|integer',
            'client_id'          => 'nullable|integer',
            'start_date'         => 'required|date',
            'target_end_date'    => 'required|date|after_or_equal:start_date',
            'budget_amount'      => 'nullable|numeric|min:0|max:9999999999999.99',
            'currency_code'      => 'nullable|string|size:3',
            'progress_percent'   => 'nullable|integer|min:0|max:100',
            'visibility'         => 'nullable|string|max:20',
        ]);

        DB::beginTransaction();

        try {

            $projectId = $request->project_id;
            $existing  = $projectId ? Project::find($projectId) : null;

            // Duplicate project name check
            $duplicate = Project::where('name', $request->name)
                ->when($request->filled('project_id'), function ($query) use ($request) {
                    $query->where('id', '!=', $request->project_id);
                })
                ->exists();

            if ($duplicate) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Project already exists'
                ]);
            }

            // Duplicate project key check
            if ($request->filled('project_key')) {

                $keyExists = Project::where('project_key', strtoupper($request->project_key))
                    ->when($request->filled('project_id'), function ($query) use ($request) {
                        $query->where('id', '!=', $request->project_id);
                    })
                    ->exists();

                if ($keyExists) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Project key already exists'
                    ]);
                }
            }

            $data = [
                'name'               => $request->name,
                'description'        => $request->description,
                'project_type'       => $request->project_type,
                'status'             => $request->status,
                'priority'           => $request->priority,
                'owner'              => $request->owner,
                'project_manager_id' => $request->project_manager_id,
                'client_id'          => $request->client_id,
                'start_date'         => $request->start_date,
                'target_end_date'    => $request->target_end_date,
                'budget_amount'      => $request->budget_amount,
                'currency_code'      => $request->currency_code ?? 'INR',
                'progress_percent'   => $request->progress_percent ?? 0,
                'visibility'         => $request->visibility ?? 'team',
                'updated_by'         => Auth::id(),
            ];

            $this->applyStatusRules($data, $existing);

            if ($existing) {

                $data['project_key'] = $request->filled('project_key')
                    ? strtoupper($request->project_key)
                    : $existing->project_key;

                if ($existing->name !== $request->name) {
                    $data['slug'] = $this->uniqueSlug($request->name, $existing->id);
                }

                $existing->update($data);
            } else {

                $data['uuid']        = (string) Str::uuid();
                $data['school_id']   = Auth::user()->school_id ?? null;
                $data['slug']        = $this->uniqueSlug($request->name);
                $data['project_key'] = $request->filled('project_key')
                    ? strtoupper($request->project_key)
                    : $this->nextKey();
                $data['created_by']  = Auth::id();

                Project::create($data);
            }

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('project_id')
                    ? 'Project updated successfully'
                    : 'Project added successfully'

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

        $request->validate([
            'id'     => 'required|integer',
            'status' => ['required', Rule::in(self::STATUSES)],
        ]);

        try {

            $project = Project::findOrFail($request->id);

            $data = [
                'status'     => $request->status,
                'updated_by' => Auth::id(),
            ];

            $this->applyStatusRules($data, $project);

            $project->update($data);

            return response()->json([
                'status'  => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            Project::class,
            $request
        );
    }

    public function trash()
    {

        return $this->commonTrash(
            Project::class
        );
    }

    public function restore(Request $request)
    {

        return $this->commonRestore(
            Project::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            Project::class,
            $request
        );
    }

    private function applyStatusRules(array &$data, ?Project $existing): void
    {
        $status = $data['status'];

        if ($status === 'in_progress' && !($existing?->actual_start_at)) {
            $data['actual_start_at'] = now();
        }

        if ($status === 'completed') {
            $data['progress_percent'] = 100;
            $data['completed_at'] = $existing?->completed_at ?? now();
        } else {
            $data['completed_at'] = null;
        }
    }

    private function uniqueSlug(string $name, $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'project';
        $slug = $base;
        $i = 2;

        while (Project::withTrashed()
            ->where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function nextKey(): string
    {
        $count = Project::withTrashed()->count() + 1;

        do {
            $key = 'PRJ-' . str_pad($count++, 4, '0', STR_PAD_LEFT);
        } while (Project::withTrashed()->where('project_key', $key)->exists());

        return $key;
    }
}