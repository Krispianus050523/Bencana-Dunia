<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'external_id' => 'EONET_DEV_001',
                'title' => 'Kebakaran Hutan',
                'category' => 'Wildfires',
                'country' => 'Indonesia',
                'status' => 'Aktif',
                'event_date' => '2026-10-01 08:00:00',
                'latitude' => -8.0950,
                'longitude' => 113.1500,
                'source' => 'NASA EONET',
            ],
            [
                'external_id' => 'EONET_DEV_002',
                'title' => 'Badai Tropis Noru',
                'category' => 'Severe Storms',
                'country' => 'Filipina',
                'status' => 'Aktif',
                'event_date' => '2026-10-02 10:30:00',
                'latitude' => 14.5995,
                'longitude' => 120.9842,
                'source' => 'NASA EONET',
            ],
            [
                'external_id' => 'EONET_DEV_003',
                'title' => 'Gempa Bumi Magnitudo 7.1',
                'category' => 'Earthquakes',
                'country' => 'Jepang',
                'status' => 'Selesai',
                'event_date' => '2026-09-15 03:45:00',
                'latitude' => 35.6762,
                'longitude' => 139.6503,
                'source' => 'USGS',
            ],
            [
                'external_id' => 'EONET_DEV_004',
                'title' => 'Banjir Bandang Jakarta',
                'category' => 'Floods',
                'country' => 'Indonesia',
                'status' => 'Aktif',
                'event_date' => '2026-10-10 06:00:00',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
                'source' => 'BMKG',
            ],
            [
                'external_id' => 'EONET_DEV_005',
                'title' => 'Erupsi Gunung Merapi',
                'category' => 'Volcanoes',
                'country' => 'Indonesia',
                'status' => 'Aktif',
                'event_date' => '2026-10-05 15:20:00',
                'latitude' => -7.5407,
                'longitude' => 110.4457,
                'source' => 'PVMBG',
            ],
            [
                'external_id' => 'EONET_DEV_006',
                'title' => 'Tsunami Warning Pasifik',
                'category' => 'Earthquakes',
                'country' => 'Chile',
                'status' => 'Selesai',
                'event_date' => '2026-09-20 12:00:00',
                'latitude' => -33.4489,
                'longitude' => -70.6693,
                'source' => 'USGS',
            ],
            [
                'external_id' => 'EONET_DEV_007',
                'title' => 'Kebakaran Hutan California',
                'category' => 'Wildfires',
                'country' => 'Amerika Serikat',
                'status' => 'Aktif',
                'event_date' => '2026-10-08 09:00:00',
                'latitude' => 34.0522,
                'longitude' => -118.2437,
                'source' => 'NASA EONET',
            ],
            [
                'external_id' => 'EONET_DEV_008',
                'title' => 'Badai Salju Eropa',
                'category' => 'Severe Storms',
                'country' => 'Jerman',
                'status' => 'Selesai',
                'event_date' => '2026-09-25 18:30:00',
                'latitude' => 52.5200,
                'longitude' => 13.4050,
                'source' => 'NASA EONET',
            ],
            [
                'external_id' => 'EONET_DEV_009',
                'title' => 'Longsor Sumatera Barat',
                'category' => 'Landslides',
                'country' => 'Indonesia',
                'status' => 'Aktif',
                'event_date' => '2026-10-12 07:15:00',
                'latitude' => -0.9493,
                'longitude' => 100.3543,
                'source' => 'BNPB',
            ],
            [
                'external_id' => 'EONET_DEV_010',
                'title' => 'Kekeringan Australia',
                'category' => 'Drought',
                'country' => 'Australia',
                'status' => 'Aktif',
                'event_date' => '2026-10-03 00:00:00',
                'latitude' => -25.2744,
                'longitude' => 133.7751,
                'source' => 'NASA EONET',
            ],
            [
                'external_id' => 'EONET_DEV_011',
                'title' => 'Gempa Bumi Sulawesi',
                'category' => 'Earthquakes',
                'country' => 'Indonesia',
                'status' => 'Selesai',
                'event_date' => '2026-09-28 22:10:00',
                'latitude' => -1.4748,
                'longitude' => 121.4381,
                'source' => 'BMKG',
            ],
            [
                'external_id' => 'EONET_DEV_012',
                'title' => 'Banjir Monsun India',
                'category' => 'Floods',
                'country' => 'India',
                'status' => 'Aktif',
                'event_date' => '2026-10-14 11:45:00',
                'latitude' => 19.0760,
                'longitude' => 72.8777,
                'source' => 'NASA EONET',
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(
                ['external_id' => $event['external_id']],
                $event
            );
        }
    }
}