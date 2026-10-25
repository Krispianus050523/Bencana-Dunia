<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'external_id',
        'title',
        'category',
        'country',
        'status',
        'event_date',
        'latitude',
        'longitude',
        'source',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
    ];
    public function getRouteKeyName(): string
    {
        return 'external_id';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('external_id', $value)
            ->when(is_numeric($value), function ($query) use ($value) {
                $query->orWhere('id', $value);
            })
            ->firstOrFail();
    }
}