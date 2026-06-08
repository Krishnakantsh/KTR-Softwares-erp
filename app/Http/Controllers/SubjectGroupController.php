<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\SubjectGroup;
use App\Models\SubjectLink;
use App\Traits\CommonCrudOperations;

class SubjectGroupController extends Controller
{
    use CommonCrudOperations;

    /*
    |--------------------------------------------------------------------------
    | INDEX PAGE (UNCHANGED)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('Frontend/Normal/Pages/Master/subject_group');
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL WITH RELATIONS
    |--------------------------------------------------------------------------
    */
    public function fetchWith()
    {
        return $this->commonFetch(
            SubjectGroup::class,
            ['subjects']
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL
    |--------------------------------------------------------------------------
    */
    public function fetch()
    {
        return $this->commonFetch(
            SubjectGroup::class,
            ['']
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH GROUP WITH SUBJECTS (IGNORED FROM COMMON TRAIT)
    |--------------------------------------------------------------------------
    */
    public function with_subjects(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            /*
            |--------------------------------------------------------------------------
            | SUBJECT GROUPS WITH ACTIVE SUBJECTS
            |--------------------------------------------------------------------------
            */
            $data = SubjectGroup::with([
                'subjects' => function ($query) {
                    $query->where('status', true);
                }
            ])
                ->whereHas('subjects', function ($query) {
                    $query->where('status', true);
                })
                ->latest()
                ->get();

            /*
            |--------------------------------------------------------------------------
            | ALREADY LINKED SUBJECT IDS
            |--------------------------------------------------------------------------
            */
            $hasSubjectsLink = SubjectLink::where('class_id', $request->id)
                ->pluck('subject_id');

            return response()->json([
                'status' => true,
                'data' => $data,
                'hasSubjectsLink' => $hasSubjectsLink
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE WITH RELATION
    |--------------------------------------------------------------------------
    */
    public function showWith(Request $request)
    {
        return $this->commonShow(
            SubjectGroup::class,
            $request,
            ['']
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE
    |--------------------------------------------------------------------------
    */
    public function show(Request $request)
    {
        return $this->commonShow(
            SubjectGroup::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE & UPDATE (UNCHANGED)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {

            $slug = Str::slug($request->name);

            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */
            if ($request->filled('group_id')) {

                $subjectGroup = SubjectGroup::findOrFail($request->group_id);

                $duplicate = SubjectGroup::where('name', $request->name)
                    ->where('id', '!=', $request->group_id)
                    ->exists();

                if ($duplicate) {

                    return response()->json([
                        'status' => false,
                        'message' => 'Subject group already exists'
                    ]);
                }

                $subjectGroup->update([
                    'name' => $request->name,
                    'slug' => $slug,
                    'session_id' => activeSession()->id,
                ]);

                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'Subject group updated successfully'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE
            |--------------------------------------------------------------------------
            */
            $exists = SubjectGroup::where('name', $request->name)->exists();

            if ($exists) {

                return response()->json([
                    'status' => false,
                    'message' => 'Subject group already exists'
                ]);
            }

            SubjectGroup::create([
                'name' => $request->name,
                'slug' => $slug,
                'session_id' => activeSession()->id,
                'status' => true
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Subject group created successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS (ADDED)
    |--------------------------------------------------------------------------
    */
    public function status(Request $request)
    {
        return $this->toggleStatus(
            SubjectGroup::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPORARY DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            SubjectGroup::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TRASH LIST
    |--------------------------------------------------------------------------
    */
    public function trash()
    {
        return $this->commonTrash(
            SubjectGroup::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE
    |--------------------------------------------------------------------------
    */
    public function restore(Request $request)
    {
        return $this->commonRestore(
            SubjectGroup::class,
            $request
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PERMANENT DELETE
    |--------------------------------------------------------------------------
    */
    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            SubjectGroup::class,
            $request
        );
    }
}
