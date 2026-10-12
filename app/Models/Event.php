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
}