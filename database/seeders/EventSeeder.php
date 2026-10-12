<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'external_id' => 'EONET_DEV_001',
            'title' => 'Kebakaran Hutan',
            'category' => 'Wildfires',
            'country' => 'Indonesia',
            'status' => 'Aktif',
            'event_date' => '2026-10-01 08:00:00',
            'latitude' => -8.0950,
            'longitude' => 113.1500,
            'source' => 'NASA EONET',
        ]);

        Event::create([
            'external_id' => 'EONET_DEV_002',
            'title' => 'Badai',
            'category' => 'Severe Storms',
            'country' => 'Indonesia',
            'status' => 'Aktif',
            'event_date' => '2026-10-02 10:30:00',
            'latitude' => -7.2500,
            'longitude' => 112.7500,
            'source' => 'NASA EONET',
        ]);
    }
}