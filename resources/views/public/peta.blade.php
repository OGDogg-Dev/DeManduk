@extends('layouts.app', [
    'title' => 'Peta — Waduk Manduk',
    'description' => 'Peta interaktif, rute terbaik, dan titik penting di sekitar Waduk Manduk Jatirejo, Ngargoyoso, Karanganyar.',
])

@section('content')
    {{-- Quick nav (optional): #map, #routes, #zones
    <x-public.quick-nav :sections="[['#map','Peta'],['#routes','Rute'],['#zones','Zona']]" />
    --}}

    <x-section
        id="map"
        title="Peta interaktif Waduk Manduk"
        subtitle="Gunakan peta di bawah untuk menemukan titik parkir, loket tiket, area kuliner, dan jalur pejalan kaki."
    >
        @include('partials._map', [
            // Embed diarahkan eksplisit ke Manduk Jatirejo, Ngargoyoso, Karanganyar
            'mapsUrl' => 'https://maps.google.com/maps?q=Waduk%20Manduk%20Jatirejo%20Ngargoyoso%20Karanganyar&t=&z=15&ie=UTF8&iwloc=&output=embed',
            'title' => 'Peta Lokasi Waduk Manduk',
            'linkLabel' => 'Buka di Google Maps',
            // Directions shortlink yang sudah kamu pakai sebelumnya
            'directionsUrl' => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
        ])

        {{-- Alamat & info singkat --}}
        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <div class="glass-card rounded-2xl p-5">
                <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">Alamat</h3>
                <p class="mt-2 text-sm text-[var(--color-ink)]">
                    Dusun Manduk, Desa Jatirejo, Kec. Ngargoyoso, Kab. Karanganyar, Jawa Tengah
                </p>
            </div>
            <div class="glass-card rounded-2xl p-5">
                <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">Parkir</h3>
                <p class="mt-2 text-sm text-[var(--color-ink)]">Area barat & timur. Bus/rombongan mohon koordinasi H-2.</p>
            </div>
            <div class="glass-card rounded-2xl p-5">
                <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">Navigasi</h3>
                <p class="mt-2 text-sm text-[var(--color-ink)]">Ikuti penunjuk arah ke <b>Jatirejo – Ngargoyoso</b>, lalu menuju <b>Dusun Manduk</b>.</p>
            </div>
        </div>
    </x-section>

    <x-section
        id="routes"
        variant="muted"
        title="Rute terbaik menuju lokasi"
        subtitle="Pilih opsi rute sesuai moda transportasi Anda."
    >
        <div class="grid gap-6 md:grid-cols-3">
            <x-card title="Kendaraan pribadi">
                <x-slot:icon>KP</x-slot:icon>
                <p class="text-sm text-[var(--color-ink)]">
                    Arahkan navigasi ke <b>Jatirejo, Ngargoyoso</b> lalu ikuti penunjuk menuju <b>Dusun Manduk</b>.
                    Parkir tersedia di sisi barat & timur waduk.
                </p>
            </x-card>
            <x-card title="Transportasi umum">
                <x-slot:icon>TU</x-slot:icon>
                <p class="text-sm text-[var(--color-ink)]">
                    Tiba di <b>Karanganyar/Karangpandan</b>, lanjut angkutan lokal/ojek ke Kecamatan Ngargoyoso –
                    Desa Jatirejo – Dusun Manduk. Titik turun di gerbang utama.
                </p>
            </x-card>
            <x-card title="Rombongan & Bus">
                <x-slot:icon>RB</x-slot:icon>
                <p class="text-sm text-[var(--color-ink)]">
                    Koordinasi <b>H-2</b> untuk penataan parkir bus dan pendampingan keselamatan saat penumpang turun.
                </p>
            </x-card>
        </div>
    </x-section>

    <x-section id="zones" title="Area penting di sekitar waduk">
        <div class="grid gap-6 md:grid-cols-2">
            <x-card title="Zona utara">
                <x-slot:icon>ZU</x-slot:icon>
                <ul class="list-disc space-y-2 pl-5 text-sm text-[var(--color-ink)]">
                    <li>Loket tiket utama & pusat informasi</li>
                    <li>Amphitheater & ruang komunitas</li>
                    <li>Kawasan kuliner "Rasa Manduk"</li>
                </ul>
            </x-card>
            <x-card title="Zona selatan">
                <x-slot:icon>ZS</x-slot:icon>
                <ul class="list-disc space-y-2 pl-5 text-sm text-[var(--color-ink)]">
                    <li>Dermaga perahu wisata & area kano</li>
                    <li>Gazebo keluarga, taman lampion, playground</li>
                    <li>Jalur trekking ringan ke bukit pandang</li>
                </ul>
            </x-card>
        </div>
    </x-section>
@endsection
