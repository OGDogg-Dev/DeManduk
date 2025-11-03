@extends('layouts.app')

@section('content')
    <x-section
        title="Peta interaktif Waduk Manduk"
        subtitle="Gunakan peta di bawah untuk menemukan titik parkir, loket tiket, area kuliner, dan jalur pejalan kaki."
    >
        @include('partials._map')
    </x-section>

    <x-section
        variant="muted"
        title="Rute terbaik menuju lokasi"
        subtitle="Kami merekomendasikan beberapa opsi rute sesuai moda transportasi."
    >
        <div class="grid gap-6 md:grid-cols-3">
            <x-card title="Kendaraan pribadi">
                <x-slot:icon>KP</x-slot:icon>
                <p class="text-sm text-slate-200">
                    Ambil jalur Gresik - Duduk Sampeyan, ikuti penunjuk arah menuju Desa Manduk. Area parkir tersedia di sisi barat dan timur waduk.
                </p>
            </x-card>
            <x-card title="Transportasi umum">
                <x-slot:icon>TU</x-slot:icon>
                <p class="text-sm text-slate-200">
                    Naik bus ke Terminal Bunder lalu lanjut angkutan desa Manduk atau ojek online. Titik turun berada di pintu masuk utama.
                </p>
            </x-card>
            <x-card title="Rombongan dan bus">
                <x-slot:icon>RB</x-slot:icon>
                <p class="text-sm text-slate-200">
                    Hubungi petugas minimal H-2 untuk reservasi parkir bus dan pendampingan petugas keselamatan saat penumpang turun.
                </p>
            </x-card>
        </div>
    </x-section>

    <x-section title="Area penting di sekitar waduk">
        <div class="grid gap-6 md:grid-cols-2">
            <x-card title="Zona utara">
                <x-slot:icon>ZU</x-slot:icon>
                <ul class="list-disc space-y-2 pl-5 text-sm text-slate-200">
                    <li>Loket tiket utama dan pusat informasi.</li>
                    <li>Amphitheater, area pertunjukan seni, dan ruang komunitas.</li>
                    <li>Kawasan kuliner tematik Rasa Manduk.</li>
                </ul>
            </x-card>
            <x-card title="Zona selatan">
                <x-slot:icon>ZS</x-slot:icon>
                <ul class="list-disc space-y-2 pl-5 text-sm text-slate-200">
                    <li>Dermaga perahu wisata dan area kano.</li>
                    <li>Gazebo keluarga, taman lampion, dan playground.</li>
                    <li>Jalur trekking ringan menuju bukit pandang.</li>
                </ul>
            </x-card>
        </div>
    </x-section>
@endsection
