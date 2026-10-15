<?php

namespace App\Http\Controllers\SuperAdmin\Broadcast;

use App\Http\Controllers\Controller;

use App\Models\SuperAdmin\Broadcast\Broadcast;
use App\Models\SuperAdmin\Broadcast\BroadcastView;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Services\FileService;
use App\Traits\CommonCrudOperations;

class BroadcastController extends Controller
{
    use CommonCrudOperations;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('SuperAdmin.Pages.Broadcast.manage_broadcast');
    }

    public function list()
    {
        return view('SuperAdmin.Pages.Broadcast.broadcast_list');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([

            'title' => 'required|string|max:255',

            'slug' => 'nullable|string|max:255|unique:broadcasts,slug,' . $request->id,

            'type' => 'required',

            'priority' => 'required',

            'audience_type' => 'required|in:all,selected',

            'tenant_json' => 'nullable|array',

            'module_name' => 'nullable|string|max:255',

            'module_url' => 'nullable|string|max:255',

            'button_text' => 'nullable|string|max:100',

            'button_url' => 'nullable|string|max:255',

            'platform' => 'required|array',

            'display_type' => 'required',

            'popup_position' => 'required',

            'action_type' => 'required',

            'banner_color' => 'nullable|string|max:50',

            'current_version' => 'nullable|string|max:50',

            'min_version' => 'nullable|string|max:50',

            'max_version' => 'nullable|string|max:50',

            'show_popup' => 'nullable|boolean',

            'show_notification' => 'nullable|boolean',

            'is_dismissible' => 'nullable|boolean',

            'requires_acknowledgement' => 'nullable|boolean',

            'repeat_type' => 'required',

            'display_order' => 'nullable|integer',

            'start_date' => 'required|date',

            'end_date' => 'required|date|after_or_equal:start_date',

            'start_time' => 'nullable',

            'end_time' => 'nullable',

            'status' => 'required',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'icon' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:1024',

            'attachment' => 'nullable|file|max:10240',

            'description' => 'nullable'

        ]);

        DB::beginTransaction();

        try {

            $broadcast = $request->filled('id')
                ? Broadcast::findOrFail($request->id)
                : new Broadcast();

            $uploadPath = 'uploads/broadcast';

            $broadcast->image = FileService::update(
                $request->file('image'),
                $uploadPath,
                $broadcast->image
            );

            $broadcast->icon = FileService::update(
                $request->file('icon'),
                $uploadPath,
                $broadcast->icon
            );

            $broadcast->attachment = FileService::update(
                $request->file('attachment'),
                $uploadPath,
                $broadcast->attachment
            );

            $broadcast->fill([

                'uuid' => $broadcast->exists
                    ? $broadcast->uuid
                    : Str::uuid(),

                'title' => $request->title,

                'slug' => $request->slug
                    ? Str::slug($request->slug)
                    : Str::slug($request->title),

                'description' => $request->description,

                'type' => $request->type,

                'priority' => $request->priority,

                'audience_type' => $request->audience_type,

                'tenant_json' => $request->audience_type == 'selected'
                    ? $request->tenant_json
                    : null,

                'module_name' => $request->module_name,

                'module_url' => $request->module_url,

                'button_text' => $request->button_text,

                'button_url' => $request->button_url,

                'platform' => $request->platform,

                'display_type' => $request->display_type,

                'popup_position' => $request->popup_position,

                'action_type' => $request->action_type,

                'banner_color' => $request->banner_color,

                'current_version' => $request->current_version,

                'min_version' => $request->min_version,

                'max_version' => $request->max_version,

                'show_popup' => $request->boolean('show_popup'),

                'show_notification' => $request->boolean('show_notification'),

                'is_dismissible' => $request->boolean('is_dismissible'),

                'requires_acknowledgement' => $request->boolean('requires_acknowledgement'),

                'repeat_type' => $request->repeat_type,

                'display_order' => $request->display_order ?? 1,

                'start_date' => $request->start_date,

                'end_date' => $request->end_date,

                'start_time' => $request->start_time,

                'end_time' => $request->end_time,

                'status' => $request->status,

                'created_by' => $broadcast->exists
                    ? $broadcast->created_by
                    : Auth::id(),

                'updated_by' => Auth::id(),

            ]);

            $broadcast->save();

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => $broadcast->wasRecentlyCreated
                    ? 'Broadcast added successfully.'
                    : 'Broadcast updated successfully.'

            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([

                'status' => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            Broadcast::class,
            ['user', 'tenant', 'views']
        );
    }


    public function fetch()
    {
        return $this->commonFetch(
            Broadcast::class,
            []
        );
    }


    public function showWith(Request $request)
    {
        return $this->commonShow(
            Broadcast::class,
            $request,
            ['user', 'tenant', 'views']
        );
    }


    public function show(Request $request)
    {
        return $this->commonShow(
            Broadcast::class,
            $request,
            []
        );
    }


    public function status(Request $request)
    {
        return $this->toggleStatus(
            Broadcast::class,
            $request
        );
    }


    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            Broadcast::class,
            $request
        );
    }


    public function trash()
    {
        return $this->commonTrash(
            Broadcast::class
        );
    }


    public function restore(Request $request)
    {
        return $this->commonRestore(
            Broadcast::class,
            $request
        );
    }


    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            Broadcast::class,
            $request
        );
    }


    // app/Http/Controllers/BroadcastController.php
    public function trackAction(Request $request, $uuid)
    {
        $broadcast = Broadcast::where('uuid', $uuid)->firstOrFail();
        $user = auth()->user();

        $view = BroadcastView::firstOrNew([
            'broadcast_id' => $broadcast->id,
            'tenant_id' => $user->tenant_id,
            'user_id' => $user->id,
        ]);

        $action = $request->input('action'); 
        $now = now();

        if ($action === 'seen' && !$view->seen_at) $view->seen_at = $now;
        if ($action === 'click') $view->clicked_at = $now;
        if ($action === 'dismiss') $view->dismissed_at = $now;
        if ($action === 'acknowledge') $view->acknowledged_at = $now;

        $view->platform = $request->input('platform', 'web');
        $view->save();

        return response()->json(['success' => true]);
    }
}
