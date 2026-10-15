<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Calendar\CalendarEvent;
use App\Models\Calendar\CalendarEventRecurrence;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CalendarEventController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('School.Pages.Calender.calendarEvents');
    }

    public function calendar()
    {
        return view('School.Pages.Calender.calendar');
    }

    /*
    |--------------------------------------------------------------------------
    | Store / Update (Handles Recurrence Creation First)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'nullable|exists:calendar_events,id',
            'school_id' => 'nullable|exists:schools,id',
            'event_type_id' => 'required|exists:calendar_event_types,id',

            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',

            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time',

            'is_full_day' => 'nullable|boolean',
            'is_holiday' => 'nullable|boolean',

            'holiday_type' => [
                'nullable',
                Rule::in(['national', 'state', 'school', 'restricted', 'vacation', 'other']),
            ],

            'applicable_to' => [
                'required',
                Rule::in(['all', 'students', 'staff', 'teachers', 'parents']),
            ],

            'location' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',

            'priority' => [
                'required',
                Rule::in(['low', 'normal', 'high', 'critical']),
            ],

            'status' => [
                'nullable',
                Rule::in(['draft', 'published', 'cancelled']),
            ],

            // Recurrence Validations
            'is_recurring' => 'nullable|boolean',
            'frequency' => 'required_if:is_recurring,1,true|nullable|in:daily,weekly,monthly,yearly',
            'interval' => 'nullable|integer|min:1',
            'days_of_week' => 'nullable|array',
            'days_of_week.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'day_of_month' => 'nullable|integer|min:1|max:31',
            'week_of_month' => 'nullable|integer|min:1|max:5',
            'week_day' => 'nullable|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'ends_on' => 'nullable|date|after_or_equal:start_date',
            'occurrences' => 'nullable|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $calendarEvent = $request->filled('id')
                ? CalendarEvent::findOrFail($request->id)
                : new CalendarEvent();

            $isRecurring = $request->has('is_recurring') && (bool)$request->is_recurring;
            $recurrenceId = null;

            // Step 1: Process Recurrence First if Enabled
            if ($isRecurring) {
                $recurrence = $calendarEvent->recurrence_id
                    ? CalendarEventRecurrence::findOrNew($calendarEvent->recurrence_id)
                    : new CalendarEventRecurrence();

                $recurrence->school_id = $request->school_id ?? null;
                $recurrence->frequency = $request->frequency;
                $recurrence->interval = $request->interval ?? 1;
                $recurrence->days_of_week = $request->frequency === 'weekly' ? $request->days_of_week : null;
                $recurrence->day_of_month = $request->frequency === 'monthly' ? $request->day_of_month : null;
                $recurrence->week_of_month = $request->frequency === 'monthly' ? $request->week_of_month : null;
                $recurrence->week_day = $request->frequency === 'monthly' ? $request->week_day : null;
                $recurrence->starts_on = $request->start_date;
                $recurrence->ends_on = $request->ends_on ?? null;
                $recurrence->occurrences = $request->occurrences ?? null;
                $recurrence->is_active = true;

                $recurrence->save();
                $recurrenceId = $recurrence->id;
            }

            // Step 2: Save Calendar Event
            $calendarEvent->school_id = $request->school_id ?? null;
            $calendarEvent->session_id = activeSession()->id;
            $calendarEvent->event_type_id = $request->event_type_id;
            $calendarEvent->title = $request->title;
            $calendarEvent->slug = $request->slug ?? Str::slug($request->title);
            $calendarEvent->description = $request->description;

            $calendarEvent->start_date = $request->start_date;
            $calendarEvent->end_date = $request->end_date ?? $request->start_date;

            $calendarEvent->is_full_day = $request->has('is_full_day') ? (bool)$request->is_full_day : true;
            $calendarEvent->start_time = $calendarEvent->is_full_day ? null : $request->start_time;
            $calendarEvent->end_time = $calendarEvent->is_full_day ? null : $request->end_time;

            $calendarEvent->is_holiday = $request->has('is_holiday') ? (bool)$request->is_holiday : false;
            $calendarEvent->holiday_type = $calendarEvent->is_holiday ? $request->holiday_type : null;

            $calendarEvent->applicable_to = $request->applicable_to ?? 'all';
            $calendarEvent->location = $request->location;
            $calendarEvent->color = $request->color;
            $calendarEvent->priority = $request->priority ?? 'normal';

            // Linked Recurrence ID
            $calendarEvent->is_recurring = $isRecurring;
            $calendarEvent->recurrence_id = $isRecurring ? $recurrenceId : null;

            $calendarEvent->status = $request->status ?? 'published';

            $calendarEvent->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $calendarEvent->wasRecentlyCreated
                    ? 'Calendar event created successfully.'
                    : 'Calendar event updated successfully.',
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
        return $this->commonFetch(CalendarEvent::class, []);
    }

    public function fetchWith()
    {
        return $this->commonFetch(CalendarEvent::class, ['eventType', 'recurrence']);
    }

    public function show(Request $request)
    {
        return $this->commonShow(CalendarEvent::class, $request, []);
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(CalendarEvent::class, $request, ['eventType', 'recurrence']);
    }

    public function eventsByDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'session_id' => 'required|exists:sessions,id',
        ]);

        $query = CalendarEvent::with(['eventType', 'recurrence'])
            ->where('session_id', $request->session_id)
            ->whereDate('start_date', '<=', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', $request->date);
            })
            ->where('status', 'published')
            ->orderBy('start_time');

        if ($request->filled('school_id')) {
            $query->where('school_id', $request->school_id);
        }

        return response()->json([
            'status' => true,
            'data' => $query->get(),
        ]);
    }

    public function eventsByMonth(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        $startDate = $request->month . '-01';
        $endDate = date('Y-m-t', strtotime($startDate));

        $query = CalendarEvent::with(['eventType', 'recurrence'])
            ->where('session_id', activeSession()->id)
            ->whereDate('start_date', '<=', $endDate)
            ->where(function ($query) use ($startDate) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', $startDate);
            })
            ->where('status', 'published')
            ->orderBy('start_date')
            ->orderBy('start_time');

        if ($request->filled('school_id')) {
            $query->where('school_id', $request->school_id);
        }

        return response()->json([
            'status' => true,
            'data' => $query->get(),
        ]);
    }

    public function holidays(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
        ]);

        $query = CalendarEvent::with('eventType')
            ->where('session_id', $request->session_id)
            ->where('is_holiday', true)
            ->where('status', 'published')
            ->orderBy('start_date');

        if ($request->filled('school_id')) {
            $query->where('school_id', $request->school_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('start_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('start_date', '<=', $request->to_date);
        }

        return response()->json([
            'status' => true,
            'data' => $query->get(),
        ]);
    }

    public function upcoming(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
        ]);

        $query = CalendarEvent::with('eventType')
            ->where('session_id', $request->session_id)
            ->whereDate('start_date', '>=', now()->toDateString())
            ->where('status', 'published')
            ->orderBy('start_date')
            ->orderBy('start_time');

        if ($request->filled('school_id')) {
            $query->where('school_id', $request->school_id);
        }

        if ($request->filled('limit')) {
            $query->limit((int) $request->limit);
        }

        return response()->json([
            'status' => true,
            'data' => $query->get(),
        ]);
    }

    public function publish(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:calendar_events,id',
        ]);

        $event = CalendarEvent::findOrFail($request->id);
        $event->status = 'published';
        $event->save();

        return response()->json([
            'status' => true,
            'message' => 'Calendar event published successfully.',
        ]);
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:calendar_events,id',
        ]);

        $event = CalendarEvent::findOrFail($request->id);
        $event->status = 'cancelled';
        $event->save();

        return response()->json([
            'status' => true,
            'message' => 'Calendar event cancelled successfully.',
        ]);
    }

    public function duplicate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:calendar_events,id',
            'start_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $event = CalendarEvent::findOrFail($request->id);
            $newEvent = $event->replicate();

            $newEvent->title = $event->title . ' Copy';
            $newEvent->slug = Str::slug($newEvent->title . '-' . uniqid());
            $newEvent->start_date = $request->start_date;

            $newEvent->end_date = $event->end_date
                ? date('Y-m-d', strtotime($request->start_date . ' +' . (strtotime($event->end_date) - strtotime($event->start_date)) . ' seconds'))
                : $request->start_date;

            $newEvent->status = 'draft';
            $newEvent->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Calendar event duplicated successfully.',
                'data' => $newEvent,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(CalendarEvent::class, $request);
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(CalendarEvent::class, $request);
    }

    public function trash()
    {
        return $this->commonTrash(CalendarEvent::class);
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(CalendarEvent::class, $request);
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(CalendarEvent::class, $request);
    }
}
