<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->external_id,
            'title' => $this->title,
            'category' => $this->category,
            'country' => $this->country,
            'status' => $this->status,
            'date' => $this->event_date?->toISOString(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'source' => $this->source,
        ];
    }
}
