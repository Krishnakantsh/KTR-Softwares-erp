<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Tasks\ProjectTeam;
use App\Traits\CommonCrudOperations;

class ProjectTeamController extends Controller
{

    use CommonCrudOperations;



    public function index()
    {
        return view('School.Pages.Project.project_team');
    }



    public function fetch()
    {

        return $this->commonFetch(
            ProjectTeam::class,
            [],
            [],
            'created_at',
            'desc'
        );
    }



    public function show(Request $request)
    {

        return $this->commonShow(
            ProjectTeam::class,
            $request
        );
    }


    public function store(Request $request)
    {

        $request->validate([
            'team_name'   => 'required|string|max:150',
            'team_code'   => 'nullable|string|max:30',
            'staff_ids'   => 'required|array|min:1',
            'staff_ids.*' => 'integer|distinct|exists:tenant.employees,id', // staff table name check kar lena
        ]);

        DB::beginTransaction();

        try {

            $duplicate = ProjectTeam::where('team_name', $request->team_name)
                ->when($request->filled('team_id'), function ($query) use ($request) {
                    $query->where('id', '!=', $request->team_id);
                })
                ->exists();

            if ($duplicate) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Team already exists'
                ]);
            }

            if ($request->filled('team_code')) {

                $codeExists = ProjectTeam::where('team_code', strtoupper($request->team_code))
                    ->when($request->filled('team_id'), function ($query) use ($request) {
                        $query->where('id', '!=', $request->team_id);
                    })
                    ->exists();

                if ($codeExists) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Team code already exists'
                    ]);
                }
            }

            $existing = $request->filled('team_id')
                ? ProjectTeam::findOrFail($request->team_id)
                : null;

            $teamCode = $request->filled('team_code')
                ? strtoupper($request->team_code)
                : ($existing->team_code ?? $this->nextCode());

            ProjectTeam::updateOrCreate(

                [
                    'id' => $request->team_id
                ],

                [

                    'team_name' => $request->team_name,

                    'team_code' => $teamCode,

                    'team_slug' => $this->uniqueSlug($request->team_name, $request->team_id),

                    'staff_ids' => array_values(array_map('intval', $request->staff_ids)),

                    'status'    => $existing ? $existing->status : true,

                ]

            );

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $request->filled('team_id')
                    ? 'Team updated successfully'
                    : 'Team added successfully'

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

        return $this->toggleStatus(
            ProjectTeam::class,
            $request
        );
    }



    public function destroy(Request $request)
    {

        return $this->commonDestroy(
            ProjectTeam::class,
            $request
        );
    }



    public function trash()
    {

        return $this->commonTrash(
            ProjectTeam::class
        );
    }



    public function restore(Request $request)
    {

        return $this->commonRestore(
            ProjectTeam::class,
            $request
        );
    }



    public function forceDelete(Request $request)
    {

        return $this->commonForceDelete(
            ProjectTeam::class,
            $request
        );
    }



    // ---------- helpers ----------

    private function uniqueSlug(string $name, $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'team';
        $slug = $base;
        $i = 2;

        while (ProjectTeam::withTrashed()
            ->where('team_slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function nextCode(): string
    {
        $count = ProjectTeam::withTrashed()->count() + 1;

        do {
            $code = 'TEAM-' . str_pad($count++, 4, '0', STR_PAD_LEFT);
        } while (ProjectTeam::withTrashed()->where('team_code', $code)->exists());

        return $code;
    }
}
