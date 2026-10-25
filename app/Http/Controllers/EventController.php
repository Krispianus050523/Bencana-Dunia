<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    // READ: Menampilkan semua event dengan search, sort, dan pagination
    public function index(Request $request): AnonymousResourceCollection
    {
        $validated = $request->validate([
            'search' => ['sometimes', 'nullable', 'string', 'max:100'],
            'sort' => ['sometimes', Rule::in(['id', 'title', 'category', 'country', 'status', 'event_date', 'created_at', 'external_id'])],
            'direction' => ['sometimes', Rule::in(['asc', 'desc'])],
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:50'],
        ]);

        $query = Event::query();

        if (! empty($validated['search'])) {
            $search = $validated['search'];
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('external_id', 'like', "%{$search}%");
            });
        }

        $sort = $validated['sort'] ?? 'id';
        $direction = $validated['direction'] ?? 'asc';
        $perPage = $validated['per_page'] ?? 5;

        $events = $query
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        return EventResource::collection($events);
    }

    // READ: Menampilkan satu event
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    // CREATE: Menambahkan event
    public function store(Request $request)
    {
        $validated = $request->validate([
            'external_id' => [
                'required',
                'string',
                'max:255',
                'unique:events,external_id',
            ],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
            'event_date' => ['nullable', 'date'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'source' => ['sometimes', 'string', 'max:255'],
        ]);

        $event = Event::create($validated);

        return (new EventResource($event))
            ->response()
            ->setStatusCode(201);
    }

    // UPDATE: Memperbarui event
    public function update(Request $request, Event $event)
    {
        $this->parseRequestBody($request);

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'category' => ['sometimes', 'required', 'string', 'max:255'],
            'country' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'nullable', 'string', 'max:255'],
            'event_date' => ['sometimes', 'nullable', 'date'],
            'latitude' => [
                'sometimes', 'nullable', 'numeric', 'between:-90,90',
            ],
            'longitude' => [
                'sometimes', 'nullable', 'numeric', 'between:-180,180',
            ],
            'source' => ['sometimes', 'required', 'string', 'max:255'],
        ]);

        $event->fill($validated);
        $event->save();
        $event->refresh();

        return new EventResource($event);
    }

    /**
     * Parsing request body secara otomatis untuk mendukung form-data,
     * raw JSON tanpa header application/json, dan urlencoded pada method PUT/PATCH.
     */
    private function parseRequestBody(Request $request): void
    {
        if (!empty($request->all())) {
            return;
        }

        $content = $request->getContent();
        if (empty($content)) {
            return;
        }

        // 1. Coba decode JSON
        $json = json_decode($content, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
            $request->merge($json);
            return;
        }

        // 2. Coba parse multipart/form-data pada PUT/PATCH (keterbatasan bawaan PHP)
        if (preg_match_all('/name="([^"]+)"\r?\n\r?\n(.*?)(?=\r?\n--)/s', $content, $matches, PREG_SET_ORDER)) {
            $parsed = [];
            foreach ($matches as $match) {
                $parsed[$match[1]] = trim($match[2]);
            }
            if (!empty($parsed)) {
                $request->merge($parsed);
                return;
            }
        }

        // 3. Coba parse urlencoded
        parse_str($content, $parsed);
        if (!empty($parsed) && is_array($parsed)) {
            $request->merge($parsed);
        }
    }

    // DELETE: Menghapus event
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->noContent();
    }
}
