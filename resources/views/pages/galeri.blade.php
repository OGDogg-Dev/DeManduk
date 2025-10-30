@extends('layouts.app', [
    'title' => 'Galeri Waduk Manduk',
    'description' => 'Sekilas visual suasana waduk, event komunitas, dan fasilitas terbaru. Foto resolusi tinggi tersedia untuk media atas permintaan.',
])

@section('content')
    <x-section
        title="Galeri Waduk Manduk"
        subtitle="Sekilas visual suasana waduk, event komunitas, dan fasilitas terbaru. Foto resolusi tinggi tersedia untuk media atas permintaan."
    >
        @php
            $galleries = [
                ['alt' => 'Panorama senja Waduk Manduk', 'src' => Vite::asset('resources/images/gallery/gallery-1.svg')],
                ['alt' => 'Dermaga kayu dengan perahu wisata', 'src' => Vite::asset('resources/images/gallery/gallery-2.svg')],
                ['alt' => 'Lampion night market di tepi waduk', 'src' => Vite::asset('resources/images/gallery/gallery-3.svg')],
                ['alt' => 'Komunitas kano saat fun paddle', 'src' => Vite::asset('resources/images/gallery/gallery-4.svg')],
                ['alt' => 'Area kuliner UMKM Manduk', 'src' => Vite::asset('resources/images/gallery/gallery-5.svg')],
                ['alt' => 'Pengunjung menikmati sky deck', 'src' => Vite::asset('resources/images/gallery/gallery-6.svg')],
            ];
        @endphp
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($galleries as $image)
                <figure class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                    <div class="aspect-[4/3] overflow-hidden bg-slate-200">
                        <img
                            src="{{ $image['src'] }}"
                            alt="{{ $image['alt'] }}"
                            loading="lazy"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                        >
                    </div>
                    <figcaption class="px-4 py-3 text-sm text-slate-600">{{ $image['alt'] }}</figcaption>
                </figure>
            @endforeach
        </div>
    </x-section>

    <x-section
        variant="muted"
        title="Video singkat Waduk Manduk"
        subtitle="Jelajahi waduk secara virtual melalui video highlight komunitas."
    >
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="aspect-video bg-slate-900">
                <iframe
                    src="https://www.youtube.com/embed/CJ62_3lAKDE"
                    title="Video wisata Waduk Manduk"
                    loading="lazy"
                    class="h-full w-full border-0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
            <div class="px-6 py-4 text-sm text-slate-600">
                Video lengkap akan tersedia setelah peluncuran kanal resmi YouTube Waduk Manduk.
            </div>
        </div>
    </x-section>

    <x-section
        title="Ketentuan penggunaan media"
    >
        <x-alert variant="info" title="Lisensi penggunaan">
            Seluruh materi visual memiliki lisensi Creative Commons Attribution-NonCommercial. Hubungi <a href="mailto:media@wadukmanduk.id" class="font-semibold text-blue-600">media@wadukmanduk.id</a> untuk permintaan file asli atau penggunaan komersial.
        </x-alert>
    </x-section>
@endsection
