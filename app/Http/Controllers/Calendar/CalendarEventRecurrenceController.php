<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Calendar\CalendarEventRecurrence;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CalendarEventRecurrenceController extends Controller
{
    use CommonCrudOperations;


    public function index()
    {
        return view(
            'School.Pages.Calender.calendarEventRecurrences'
        );
    }


    public function store(Request $request)
    {
        $request->validate([

            'id' => 'nullable|exists:calendar_event_recurrences,id',

            'school_id' => 'nullable|exists:schools,id',

            'frequency' => [
                'required',
                Rule::in([
                    'daily',
                    'weekly',
                    'monthly',
                    'yearly',
                ]),
            ],

            'interval' => 'required|integer|min:1',

            'days_of_week' => 'nullable|array',

            'days_of_week.*' => [
                'string',
                Rule::in([
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                    'sunday',
                ]),
            ],

            'day_of_month' => 'nullable|integer|min:1|max:31',

            'week_of_month' => 'nullable|integer|min:1|max:5',

            'week_day' => [
                'nullable',
                Rule::in([
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                    'sunday',
                ]),
            ],

            'starts_on' => 'required|date',

            'ends_on' => 'nullable|date|after_or_equal:starts_on',

            'occurrences' => 'nullable|integer|min:1',

            'is_active' => 'nullable|boolean',
        ]);


        DB::beginTransaction();

        try {

            $recurrence = $request->filled('id')
                ? CalendarEventRecurrence::findOrFail($request->id)
                : new CalendarEventRecurrence();


            $recurrence->school_id = $request->school_id ?? null;

            $recurrence->frequency = $request->frequency;

            $recurrence->interval = $request->interval ?? 1;

            $recurrence->days_of_week =$request->days_of_week;

            $recurrence->day_of_month =$request->day_of_month;

            $recurrence->week_of_month =$request->week_of_month;

            $recurrence->week_day = $request->week_day;

            $recurrence->starts_on =$request->starts_on;

            $recurrence->ends_on = $request->ends_on;

            $recurrence->occurrences =  $request->occurrences;

            $recurrence->is_active =$request->has('is_active') ? (bool) $request->is_active : true;
            $recurrence->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $recurrence->wasRecentlyCreated
                    ? 'Calendar recurrence added successfully.'
                    : 'Calendar recurrence updated successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function fetch()
    {
        return $this->commonFetch(
            CalendarEventRecurrence::class,
            []
        );
    }


    public function fetchWith()
    {
        return $this->commonFetch(
            CalendarEventRecurrence::class,
            [
                'events',
            ]
        );
    }


    public function show(Request $request)
    {
        return $this->commonShow(
            CalendarEventRecurrence::class,
            $request,
            []
        );
    }


    public function showWith(Request $request)
    {
        return $this->commonShow(
            CalendarEventRecurrence::class,
            $request,
            [
                'events',
            ]
        );
    }


    public function status(Request $request)
    {
        return $this->toggleStatus(
            CalendarEventRecurrence::class,
            $request
        );
    }


    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            CalendarEventRecurrence::class,
            $request
        );
    }


    public function trash()
    {
        return $this->commonTrash(
            CalendarEventRecurrence::class
        );
    }


    public function restore(Request $request)
    {
        return $this->commonRestore(
            CalendarEventRecurrence::class,
            $request
        );
    }


    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            CalendarEventRecurrence::class,
            $request
        );
    }
}
