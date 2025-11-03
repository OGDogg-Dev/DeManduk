<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('events')->truncate();

        $events = [
            [
                'title' => 'Manduk Lakeside Festival',
                'slug' => 'manduk-lakeside-festival',
                'category' => 'Festival',
                'event_date' => '2025-11-23',
                'start_time' => '16:00:00',
                'end_time' => '21:00:00',
                'location' => 'Amphitheater Waduk Manduk',
                'excerpt' => 'Festival kuliner malam, pertunjukan musik akustik, dan pertunjukan seni tradisional.',
                'body' => "Manduk Lakeside Festival adalah selebrasi tahunan yang menyatukan kuliner, musik, dan seni komunitas.\nNikmati demo masak chef lokal, panggung akustik, serta parade lampion terapung di dermaga baru.",
                'published_at' => now(),
            ],
            [
                'title' => 'Fun Paddle dan Clean Up',
                'slug' => 'fun-paddle-dan-clean-up',
                'category' => 'Komunitas',
                'event_date' => '2025-11-30',
                'start_time' => '07:00:00',
                'end_time' => '10:00:00',
                'location' => 'Dermaga Utama',
                'excerpt' => 'Aksi bersih waduk bersama komunitas pecinta alam dan sesi fun paddle bersama pelatih.',
                'body' => "Gabung dalam aksi bersih waduk sekaligus menikmati fun paddle.\nPeserta akan mendapatkan briefing keselamatan, perlengkapan dasar, serta sertifikat partisipasi.",
                'published_at' => now(),
            ],
            [
                'title' => 'Manduk Night Run 5K',
                'slug' => 'manduk-night-run-5k',
                'category' => 'Olahraga',
                'event_date' => '2025-12-14',
                'start_time' => '18:30:00',
                'end_time' => '21:00:00',
                'location' => 'Lintasan Perimeter Waduk',
                'excerpt' => 'Lari malam mengelilingi waduk dilengkapi instalasi lampu tematik dan expo UMKM.',
                'body' => "Rasakan sensasi night run dengan instalasi pencahayaan tematik.\nPaket peserta sudah termasuk jersey, medali finisher, dan kupon kuliner UMKM.",
                'published_at' => now(),
            ],
            [
                'title' => 'Workshop Fotografi Landscape',
                'slug' => 'workshop-fotografi-landscape',
                'category' => 'Workshop',
                'event_date' => '2025-12-21',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'location' => 'Sky Deck Waduk Manduk',
                'excerpt' => 'Sesi belajar teknik fotografi sunrise bersama fotografer lokal dan praktikum langsung.',
                'body' => "Pelajari teknik fotografi landscape langsung di lapangan.\nPeserta membawa kamera pribadi dan akan didampingi mentor profesional.",
                'published_at' => now(),
            ],
        ];

        foreach ($events as $event) {
            $data = $event;
            $data['slug'] = Str::slug($event['slug'] ?? $event['title']);
            Event::create($data);
        }
    }
}
