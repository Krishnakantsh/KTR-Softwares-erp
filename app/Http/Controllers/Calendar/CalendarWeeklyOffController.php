<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Calendar\CalendarWeeklyOff;
use App\Traits\CommonCrudOperations;
use Illuminate\Http\Request;

class CalendarWeeklyOffController extends Controller
{
    use CommonCrudOperations;


    public function index()
    {
        return view(
            'School.Pages.Calender.calendarWeeklyOffs'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'day_of_week'   => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'applicable_to' => 'required|in:all,students,teachers,staff',
            'off_type'      => 'required|in:weekly,alternate,custom',
            'weeks'         => 'nullable|array',
        ]);


        $weeksData = ($request->off_type === 'weekly') ? null : array_map('intval', $request->input('weeks', []));

        $weeklyOff = CalendarWeeklyOff::updateOrCreate(
            ['id' => $request->id],
            [
                'school_id'     => null,
                'session_id'    => activeSession()->id,
                'day_of_week'   => $request->day_of_week,
                'applicable_to' => $request->applicable_to,
                'off_type'      => $request->off_type,
                'weeks'         => $weeksData,
                'is_active'     => $request->has('is_active') ? 1 : 0,
                'updated_by'    => null,
                'created_by'    => null
            ]
        );

        return response()->json([
            'status'  => true,
            'message' => 'Weekly off rule saved successfully!',
            'data'    => $weeklyOff
        ]);
    }

    public function fetch()
    {
        return $this->commonFetch(
            CalendarWeeklyOff::class,
            []
        );
    }


    public function fetchWith()
    {
        return $this->commonFetch(
            CalendarWeeklyOff::class,
            []
        );
    }


    public function show(Request $request)
    {
        return $this->commonShow(
            CalendarWeeklyOff::class,
            $request,
            []
        );
    }


    public function showWith(Request $request)
    {
        return $this->commonShow(
            CalendarWeeklyOff::class,
            $request,
            []
        );
    }


    public function status(Request $request)
    {
        return $this->toggleStatus(
            CalendarWeeklyOff::class,
            $request
        );
    }


    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            CalendarWeeklyOff::class,
            $request
        );
    }


    public function trash()
    {
        return $this->commonTrash(
            CalendarWeeklyOff::class
        );
    }


    public function restore(Request $request)
    {
        return $this->commonRestore(
            CalendarWeeklyOff::class,
            $request
        );
    }


    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            CalendarWeeklyOff::class,
            $request
        );
    }
}
