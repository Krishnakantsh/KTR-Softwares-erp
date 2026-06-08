<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Subject;
use App\Models\SubjectGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Traits\CommonCrudOperations;

class SubjectController extends Controller
{
    use CommonCrudOperations;

    /*
    |--------------------------------------------------------------------------
    | INDEX PAGE (UNCHANGED)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $subjectGroups = SubjectGroup::latest()->get();

        return view(
            'Frontend/Normal/Pages/Master/subjects',
            compact('subjectGroups')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL SUBJECTS WITH RELATIONS
    |--------------------------------------------------------------------------
    */
    public function fetchWith()
    {
        return $this->commonFetch(
            Subject::class,
            ['subjectGroup']
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL SUBJECTS
    |--------------------------------------------------------------------------
    */
    public function fetch()
    {
        return $this->commonFetch(
            Subject::class,
            ['']
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE SUBJECT
    |--------------------------------------------------------------------------
    */
    public function showWith(Request $request)
    {
        return $this->commonShow(
            Subject::class,
            $request,
            ['subjectGroup']
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE SUBJECT
    |--------------------------------------------------------------------------
    */
    public function show(Request $request)
    {
        return $this->commonShow(
            Subject::class,
            $request,
            ['']
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
            'subject_group_id' => 'required|exists:subject_groups,id',
        ]);

        DB::beginTransaction();

        try {

            $slug = Str::slug($request->name);

            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */
            if ($request->filled('subject_id')) {

                $subject = Subject::findOrFail($request->subject_id);

                $duplicate = Subject::where('name', $request->name)
                    ->where('subject_group_id', $request->subject_group_id)
                    ->where('id', '!=', $request->subject_id)
                    ->exists();

                if ($duplicate) {

                    return response()->json([
                        'status' => false,
                        'message' => 'Subject already exists in this group'
                    ]);
                }

                $subject->update([
                    'name' => $request->name,
                    'slug' => $slug,
                    'subject_group_id' => $request->subject_group_id,
                ]);

                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'Subject updated successfully'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE
            |--------------------------------------------------------------------------
            */
            $exists = Subject::where('name', $request->name)
                ->where('subject_group_id', $request->subject_group_id)
                ->exists();

            if ($exists) {

                return response()->json([
                    'status' => false,
                    'message' => 'Subject already exists in this group'
                ]);
            }

            Subject::create([
                'name' => $request->name,
                'slug' => $slug,
                'session_id' => activeSession()->id ?? null,
                'status' => true,
                'subject_group_id' => $request->subject_group_id
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Subject added successfully'
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
    | TOGGLE STATUS (NEW)
    |--------------------------------------------------------------------------
    */
    public function status(Request $request)
    {
        return $this->toggleStatus(
            Subject::class,
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
            Subject::class,
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
            Subject::class,
            ['subjectGroup']
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
            Subject::class,
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
            Subject::class,
            $request
        );
    }
}
