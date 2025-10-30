@extends('layouts.app')

@section('content')
    @php
        $events = [
            [
                'title' => 'Manduk Lakeside Festival',
                'slug' => 'manduk-lakeside-festival',
                'date' => '23 November 2025',
                'time' => '16.00 - 21.00 WIB',
                'excerpt' => 'Festival kuliner malam, pertunjukan musik akustik, dan pertunjukan seni tradisional.',
                'category' => 'Festival',
            ],
            [
                'title' => 'Fun Paddle dan Clean Up',
                'slug' => 'fun-paddle-dan-clean-up',
                'date' => '30 November 2025',
                'time' => '07.00 - 10.00 WIB',
                'excerpt' => 'Aksi bersih waduk bersama komunitas pecinta alam dan sesi fun paddle bersama pelatih.',
                'category' => 'Komunitas',
            ],
            [
                'title' => 'Manduk Night Run 5K',
                'slug' => 'manduk-night-run-5k',
                'date' => '14 Desember 2025',
                'time' => '18.30 - 21.00 WIB',
                'excerpt' => 'Lari malam mengelilingi waduk dilengkapi instalasi lampu tematik dan expo UMKM.',
                'category' => 'Olahraga',
            ],
            [
                'title' => 'Workshop Fotografi Landscape',
                'slug' => 'workshop-fotografi-landscape',
                'date' => '21 Desember 2025',
                'time' => '08.00 - 12.00 WIB',
                'excerpt' => 'Sesi belajar teknik fotografi sunrise bersama fotografer lokal dan praktikum langsung.',
                'category' => 'Workshop',
            ],
        ];
    @endphp

    <x-section
        title="Event dan agenda Waduk Manduk"
        subtitle="Jadwal kegiatan tematik yang memperkaya pengalaman wisata Anda. Pendaftaran akan dibuka melalui portal ini pada fase backend."
    >
        <div class="grid gap-6 md:grid-cols-2">
            @foreach ($events as $event)
                <x-card :href="route('event.show', $event['slug'])" :title="$event['title']" :subtitle="$event['excerpt']">
                    <x-slot:icon>EV</x-slot:icon>
                    <div class="space-y-2 text-sm text-slate-600">
                        <p><strong>Kategori:</strong> {{ $event['category'] }}</p>
                        <p><strong>Tanggal:</strong> {{ $event['date'] }}</p>
                        <p><strong>Waktu:</strong> {{ $event['time'] }}</p>
                    </div>
                </x-card>
            @endforeach
        </div>
        <x-pagination
            :links="[
                ['label' => 1, 'href' => '#', 'active' => true],
                ['label' => 2, 'href' => '#'],
                ['label' => 3, 'href' => '#'],
            ]"
            :prev="null"
            :next="['label' => 'Selanjutnya', 'href' => '#']"
        />
    </x-section>

    <x-section variant="muted" title="Informasi pendaftaran dan kerja sama event">
        <x-alert variant="info" title="Kerja sama komunitas">
            Pengajuan kerja sama event dapat dikirim ke <a href="mailto:event@wadukmanduk.id" class="font-semibold text-blue-600">event@wadukmanduk.id</a>.
            Sertakan proposal, kebutuhan daya listrik, dan estimasi peserta.
        </x-alert>
        <x-alert variant="success" title="Benefit penyelenggara">
            Fasilitas dokumentasi dasar, publikasi di kanal resmi, serta potongan 50 persen sewa amphitheater untuk komunitas lokal.
        </x-alert>
    </x-section>
@endsection
