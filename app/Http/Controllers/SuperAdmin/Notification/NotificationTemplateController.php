<?php

namespace App\Http\Controllers\SuperAdmin\Notification;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\Notification\NotificationTemplate;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationTemplateController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('SuperAdmin/Pages/Notification/manage-notification-templates');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'            => 'nullable|integer',
            'name'          => 'required|string|max:255',
            'template_key'  => 'required|string|max:255',
            'language'      => 'required|string|max:10',
            'title'         => 'required|string|max:255',
            'content'       => 'required',
            'variables'     => 'nullable|string',
            'description'   => 'nullable|string',
            'is_system'     => 'required|boolean',
            'is_active'     => 'required|boolean',
        ]);

        DB::beginTransaction();

        try {

            $template = $request->filled('id')
                ? NotificationTemplate::findOrFail($request->id)
                : new NotificationTemplate();

            $variables = null;

            if ($request->filled('variables')) {

                $variables = collect(explode(',', $request->variables))
                    ->map(function ($item) {
                        return trim($item);
                    })
                    ->filter()
                    ->values()
                    ->toArray();
            }

            $template->fill([
                'name'          => $request->name,
                'template_key'  => trim($request->template_key),
                'language'      => $request->language,
                'title'         => $request->title,
                'content'       => $request->content,
                'variables'     => $variables,
                'description'   => $request->description,
                'is_system'     => $request->boolean('is_system'),
                'is_active'     => $request->boolean('is_active'),
            ]);

            $template->save();

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $template->wasRecentlyCreated
                    ? 'Notification template created successfully.'
                    : 'Notification template updated successfully.'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            NotificationTemplate::class,
            []
        );
    }

    public function show(Request $request)
    {

        return $this->commonShow(
            NotificationTemplate::class,
            $request,
            []
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            NotificationTemplate::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            NotificationTemplate::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            NotificationTemplate::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            NotificationTemplate::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            NotificationTemplate::class,
            $request
        );
    }


    public function bulkJsonUpload(Request $request)
    {
        $request->validate([
            'json_file' => 'required|file|mimes:json|max:5120'
        ]);

        DB::beginTransaction();

        try {

            $json = json_decode(
                file_get_contents($request->file('json_file')->getRealPath()),
                true
            );

            if (!is_array($json)) {
                throw new Exception('Invalid JSON structure.');
            }

            $inserted = 0;
            $updated = 0;

            foreach ($json as $item) {

                if (
                    empty($item['name']) ||
                    empty($item['template_key']) ||
                    empty($item['language']) ||
                    empty($item['title']) ||
                    empty($item['content'])
                ) {
                    continue;
                }

                $template = NotificationTemplate::firstOrNew([
                    'template_key' => trim($item['template_key']),
                    'language'     => $item['language']
                ]);

                $template->name = $item['name'];
                $template->title = $item['title'];
                $template->content = $item['content'];
                $template->description = $item['description'] ?? null;
                $template->variables = $item['variables'] ?? [];
                $template->is_system = $item['is_system'] ?? false;
                $template->is_active = $item['is_active'] ?? true;

                if ($template->exists) {
                    $updated++;
                } else {
                    $inserted++;
                }

                $template->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Bulk upload completed successfully.',
                'inserted' => $inserted,
                'updated' => $updated
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
