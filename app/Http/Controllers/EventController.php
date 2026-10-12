<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return response()->json([
            'data' => $events->map(function ($event) {
                return [
                    'id' => $event->external_id,
                    'title' => $event->title,
                    'category' => $event->category,
                    'country' => $event->country,
                    'status' => $event->status,
                    'date' => $event->event_date?->toISOString(),
                    'latitude' => $event->latitude,
                    'longitude' => $event->longitude,
                    'source' => $event->source,
                ];
            }),
        ], 200);
    }

    public function show(Event $event)
    {
        return response()->json([
            'data' => [
                'id' => $event->external_id,
                'title' => $event->title,
                'category' => $event->category,
                'country' => $event->country,
                'status' => $event->status,
                'date' => $event->event_date?->toISOString(),
                'latitude' => $event->latitude,
                'longitude' => $event->longitude,
                'source' => $event->source,
            ],
        ], 200);
    }
}