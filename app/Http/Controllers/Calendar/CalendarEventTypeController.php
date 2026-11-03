<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Calendar\CalendarEventType;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CalendarEventTypeController extends Controller
{
    use CommonCrudOperations;


    public function index()
    {
        return view('School.Pages.Calender/calendarEventTypes');
    }


    public function store(Request $request)
    {
        $request->validate([

            'id' => 'nullable|exists:calendar_event_types,id',

            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('calendar_event_types')
                    ->where(
                        fn($query) => $query
                            ->where('school_id', null)
                            ->whereNull('deleted_at')
                    )
                    ->ignore($request->id),
            ],

            'slug' => 'nullable|string|max:150',
            'color' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'is_holiday' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $calendarEventType = $request->filled('id')
                ? CalendarEventType::findOrFail($request->id)
                : new CalendarEventType();

            $calendarEventType->school_id = $request->school_id ?? null;
            $calendarEventType->name = $request->name;
            $calendarEventType->slug = $request->slug
                ?? \Illuminate\Support\Str::slug($request->name);
            $calendarEventType->color = $request->color;
            $calendarEventType->icon = $request->icon;
            $calendarEventType->description = $request->description;
            $calendarEventType->is_holiday = (bool) $request->is_holiday;
            $calendarEventType->is_active = $request->has('is_active')
                ? (bool) $request->is_active
                : true;

            $calendarEventType->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $calendarEventType->wasRecentlyCreated
                    ? 'Calendar event type added successfully.'
                    : 'Calendar event type updated successfully.',
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
            CalendarEventType::class,
        );
    }


    public function fetchWith()
    {
        return $this->commonFetch(
            CalendarEventType::class,
            []
        );
    }


    public function show(Request $request)
    {
        return $this->commonShow(
            CalendarEventType::class,
            $request,
            []
        );
    }


    public function showWith(Request $request)
    {
        return $this->commonShow(
            CalendarEventType::class,
            $request,
            []
        );
    }


    public function status(Request $request)
    {
        return $this->toggleStatus(
            CalendarEventType::class,
            $request
        );
    }


    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            CalendarEventType::class,
            $request
        );
    }


    public function trash()
    {
        return $this->commonTrash(
            CalendarEventType::class
        );
    }


    public function restore(Request $request)
    {
        return $this->commonRestore(
            CalendarEventType::class,
            $request
        );
    }


    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            CalendarEventType::class,
            $request
        );
    }
}
