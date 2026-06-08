<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ClassMaster;
use App\Models\SubjectLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubjectLinkController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $classes = ClassMaster::where('status', 1)->get();

        return view(
            'Frontend.Normal.Pages.Master.subject_link',
            compact('classes')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FETCH ALL SUBJECT LINKS
    |--------------------------------------------------------------------------
    */

    public function fetch()
    {
        try {

            $data = SubjectLink::with('class')
                ->select(
                    'class_id',
                    DB::raw('COUNT(*) as total_subjects')
                )
                ->groupBy('class_id')
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

    /*
    |--------------------------------------------------------------------------
    | STORE & UPDATE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class_masters,id',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'exists:subjects,id'
        ]);

        DB::beginTransaction();

        try {

            $classId = $request->class_id;

            $subjectIds = $request->subjects;

            /*
            |--------------------------------------------------------------------------
            | OLD LINKED SUBJECT IDS
            |--------------------------------------------------------------------------
            */

            $oldLinks = SubjectLink::where('class_id', $classId)
                ->pluck('subject_id')
                ->toArray();

            /*
            |--------------------------------------------------------------------------
            | FIND NEW SUBJECTS TO INSERT
            |--------------------------------------------------------------------------
            */

            $newSubjects = array_diff($subjectIds, $oldLinks);

            /*
            |--------------------------------------------------------------------------
            | FIND REMOVED SUBJECTS TO DELETE
            |--------------------------------------------------------------------------
            */

            $removedSubjects = array_diff($oldLinks, $subjectIds);

            /*
            |--------------------------------------------------------------------------
            | INSERT NEW SUBJECT LINKS
            |--------------------------------------------------------------------------
            */

            $insertData = [];

            foreach ($newSubjects as $subjectId) {

                $insertData[] = [
                    'class_id' => $classId,
                    'subject_id' => $subjectId,
                    'session_id' => activeSession()->id ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($insertData)) {

                SubjectLink::insert($insertData);
            }

            /*
            |--------------------------------------------------------------------------
            | DELETE REMOVED SUBJECT LINKS
            |--------------------------------------------------------------------------
            */

            if (!empty($removedSubjects)) {

                SubjectLink::where('class_id', $classId)
                    ->whereIn('subject_id', $removedSubjects)
                    ->delete();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Subject links updated successfully'
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
    | SHOW SINGLE SUBJECT LINK
    |--------------------------------------------------------------------------
    */

    public function show(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {

            $data = SubjectLink::with([
                'classMaster',
                'subject',
                'subject.subjectGroup'
            ])
                ->findOrFail($request->id);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Subject link not found'
            ], 404);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPORARY DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        DB::beginTransaction();

        try {

            SubjectLink::where('class_id', $request->id)
                ->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Subject links deleted successfully'
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
    | TRASH LIST
    |--------------------------------------------------------------------------
    */

    public function trash()
    {
        try {

            $data = SubjectLink::onlyTrashed()
                ->with([
                    'classMaster',
                    'subject',
                    'subject.subjectGroup'
                ])
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

    /*
    |--------------------------------------------------------------------------
    | RESTORE
    |--------------------------------------------------------------------------
    */

    public function restore(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        DB::beginTransaction();

        try {

            $data = SubjectLink::onlyTrashed()
                ->findOrFail($request->id);

            $data->restore();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Subject link restored successfully'
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
    | PERMANENT DELETE
    |--------------------------------------------------------------------------
    */

    public function forceDelete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        DB::beginTransaction();

        try {

            $data = SubjectLink::onlyTrashed()
                ->findOrFail($request->id);

            $data->forceDelete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Subject link permanently deleted'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
