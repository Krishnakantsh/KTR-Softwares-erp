<?php

namespace App\Http\Controllers;

use App\Models\Tasks\ProjectTask;
use App\Models\Tasks\ProjectTeam;
use App\Models\Tasks\TaskCommunication;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectTaskController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('School.Pages.Project.project_task');
    }

    public function fetch()
    {
        return $this->commonFetch(
            ProjectTask::class,
            [],
            [],
            'created_at',
            'desc'
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            ProjectTask::class,
            $request
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'nullable|integer|exists:tenant.project_tasks,id',
            'team_id' => 'required|integer|exists:tenant.project_teams,id',

            'project_id' => 'required|integer|exists:tenant.projects,id',

            'task_code' => 'nullable|string|max:50',
            'task_title' => 'required|string|max:200',
            'description' => 'nullable|string',

            'staff_ids' => 'required|array|min:1',
            'staff_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:tenant.employees,id',
            ],

            'priority' => [
                'required',
                'string',
                Rule::in(ProjectTask::PRIORITIES),
            ],

            'status' => [
                'required',
                'string',
                Rule::in(ProjectTask::STATUSES),
            ],

            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',

            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        DB::beginTransaction();

        try {
            $existing = !empty($validated['task_id'])
                ? ProjectTask::findOrFail($validated['task_id'])
                : null;

            // Check duplicate task title within the same project.
            $duplicate = ProjectTask::where(
                'project_id',
                $validated['project_id']
            )
                ->where('task_title', $validated['task_title'])
                ->when($existing, function ($query) use ($existing) {
                    $query->where('id', '!=', $existing->id);
                })
                ->exists();

            if ($duplicate) {
                DB::rollBack();

                return response()->json([
                    'status' => false,
                    'message' => 'Task already exists in this project.',
                ], 422);
            }

            // Generate or preserve task code.
            $taskCode = !empty($validated['task_code'])
                ? strtoupper(trim($validated['task_code']))
                : ($existing?->task_code ?? $this->nextCode());

            // Check task code uniqueness.
            $codeExists = ProjectTask::withTrashed()
                ->where('task_code', $taskCode)
                ->when($existing, function ($query) use ($existing) {
                    $query->where('id', '!=', $existing->id);
                })
                ->exists();

            if ($codeExists) {
                DB::rollBack();

                return response()->json([
                    'status' => false,
                    'message' => 'Task code already exists.',
                ], 422);
            }

            $status = $validated['status'];

            $progress = $validated['progress']
                ?? ($existing?->progress ?? 0);

            // Keep completion details consistent.
            if ($status === ProjectTask::STATUS_COMPLETED) {
                $progress = 100;
            }

            $completedAt = $status === ProjectTask::STATUS_COMPLETED
                ? ($existing?->completed_at ?? now())
                : null;

            $taskData = [
                'project_id' => $validated['project_id'],
                'team_id' => $validated['team_id'],
                'task_code' => $taskCode,
                'task_title' => $validated['task_title'],
                'task_slug' => $this->uniqueSlug(
                    $validated['task_title'],
                    $existing?->id
                ),
                'description' => $validated['description'] ?? null,
                'staff_ids' => array_values(
                    array_map('intval', $validated['staff_ids'])
                ),
                'priority' => $validated['priority'],
                'status' => $status,
                'start_date' => $validated['start_date'] ?? null,
                'due_date' => $validated['due_date'] ?? null,
                'progress' => $progress,
                'completed_at' => $completedAt,
                'updated_by' => Auth::id(),
            ];

            $team = ProjectTeam::findOrFail($validated['team_id']);

            $teamStaffIds = collect($team->staff_ids ?? [])
                ->map(fn($id) => (int) $id);

            $assignedStaffIds = collect($validated['staff_ids'])
                ->map(fn($id) => (int) $id);

            if ($assignedStaffIds->diff($teamStaffIds)->isNotEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Selected staff members do not belong to this team.',
                ], 422);
            }

            if ($existing) {
                $existing->update($taskData);
            } else {
                $taskData['created_by'] = Auth::id();



                ProjectTask::create($taskData);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $existing
                    ? 'Task updated successfully.'
                    : 'Task added successfully.',
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            report($e);

            return response()->json([
                'status' => false,
                'message' => 'Unable to save task.',
            ], 500);
        }
    }


    public function status(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|integer|exists:tenant.project_tasks,id',

            'status' => [
                'required',
                'string',
                Rule::in(ProjectTask::STATUSES),
            ],
        ]);

        try {
            $task = ProjectTask::findOrFail($validated['task_id']);

            $newStatus = $validated['status'];

            $task->status = $newStatus;
            $task->updated_by = Auth::id();

            if ($newStatus === ProjectTask::STATUS_COMPLETED) {
                $task->progress = 100;
                $task->completed_at = $task->completed_at ?? now();
            } else {
                $task->completed_at = null;
            }

            $task->save();

            return response()->json([
                'status' => true,
                'message' => 'Task status updated successfully.',
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'status' => false,
                'message' => 'Unable to update task status.',
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            ProjectTask::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            ProjectTask::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            ProjectTask::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            ProjectTask::class,
            $request
        );
    }

    // ---------- Helpers ----------

    private function uniqueSlug(string $title, $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'task';
        $slug = $base;
        $i = 2;

        while (
            ProjectTask::withTrashed()
            ->where('task_slug', $slug)
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function nextCode(): string
    {
        $count = ProjectTask::withTrashed()->count() + 1;

        do {
            $code = 'TASK-' . str_pad(
                $count++,
                4,
                '0',
                STR_PAD_LEFT
            );
        } while (
            ProjectTask::withTrashed()
            ->where('task_code', $code)
            ->exists()
        );

        return $code;
    }


    // ------------ Get Tasks By Employee Id --------------------

    public function getTasksByEmployeeId(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|integer',
        ]);

        $tasks = ProjectTask::whereJsonContains('staff_ids', (int) $request->emp_id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Tasks fetched successfully.',
            'data' => $tasks,
        ], 200);
    }


    // get task comments by task id
    // public function taskComments(Request $request)
    // {
    //     $request->validate([
    //         'task_id' => 'required|integer|exists:tenant.project_tasks,id',
    //     ]);

    //     $task = ProjectTask::with('comments')->findOrFail($request->task_id);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Task comments fetched successfully.',
    //         'data' => $task->comments,
    //     ], 200);
    // }



    public function taskComments(Request $request)
    {
        $request->validate([
            'task_id' => 'required|integer|exists:tenant.project_tasks,id',
        ]);

        $comments = TaskCommunication::where('task_id', $request->task_id)
            ->orderBy('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
    }



    public function storeComments(Request $request)
    {
        $request->validate([
            'task_id' => 'required|integer|exists:tenant.project_tasks,id',
            'message' => 'required|string',
            'attachment'    => 'nullable|file|max:10240',
        ]);

        $task = ProjectTask::findOrFail($request->task_id);

        $fileData = [];

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $originalName = $file->getClientOriginalName();
            $mime         = $file->getClientMimeType();
            $size         = $file->getSize();
            $newName      = uniqid('task_') . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $originalName);

            $dir = 'uploads/task-communications/' . $task->id;
            $file->move(public_path($dir), $newName);

            $fileData = [
                'file_path' => $dir . '/' . $newName,
                'file_name' => $originalName,
                'file_type' => $mime,
                'file_size' => $size,
            ];
        }

        $comment = $task->comments()->create([
            'user_id'      => Auth::id(),
            'message'      => $request->message,
            'user_name'    => Auth::user()->name,
            'user_profile' => Auth::user()->profile_image ?? null,
            'created_by'   => Auth::id(),
        ] + $fileData);

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully.',
            'data'    => $comment,
        ], 201);
    }
}
