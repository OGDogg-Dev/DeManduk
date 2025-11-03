@extends('layouts.app', [
    'title' => 'Galeri Waduk Manduk',
    'description' => 'Sekilas visual suasana waduk, event komunitas, dan fasilitas terbaru. Foto resolusi tinggi tersedia untuk media atas permintaan.',
])

@section('content')
    <x-section
        title="Galeri Waduk Manduk"
        subtitle="Sekilas visual suasana waduk, event komunitas, dan fasilitas terbaru. Foto resolusi tinggi tersedia untuk media atas permintaan."
    >
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($galleryItems as $image)
                <figure class="group overflow-hidden rounded-3xl border border-white/10 bg-[#041734]/70 shadow-[0_28px_70px_-30px_rgba(5,23,63,0.7)] backdrop-blur">
                    <div class="aspect-[4/3] overflow-hidden bg-[#031731]">
                        <img
                            src="{{ $image['image'] }}"
                            alt="{{ $image['title'] }}"
                            loading="lazy"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105 group-hover:opacity-90"
                        >
                    </div>
                    <figcaption class="px-4 py-3 text-sm text-slate-200">
                        <span class="font-semibold text-white">{{ $image['title'] }}</span>
                        @if (! empty($image['caption']))
                            <span class="block text-xs text-slate-400">{{ $image['caption'] }}</span>
                        @endif
                    </figcaption>
                </figure>
            @empty
                <div class="glass-card rounded-3xl border border-dashed border-white/20 p-6 text-center text-sm text-slate-300 sm:col-span-2 lg:col-span-3">
                    Belum ada foto yang dipublikasikan. Silakan kembali lagi setelah pengelola menambahkan konten.
                </div>
            @endforelse
        </div>
    </x-section>

    <x-section
        variant="muted"
        title="Video singkat Waduk Manduk"
        subtitle="Jelajahi waduk secara virtual melalui video highlight komunitas."
    >
        <div class="glass-card overflow-hidden rounded-3xl">
            <div class="aspect-video bg-[#020f24]">
                <iframe
                    src="https://www.youtube.com/embed/CJ62_3lAKDE"
                    title="Video wisata Waduk Manduk"
                    loading="lazy"
                    class="h-full w-full border-0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
            <div class="px-6 py-4 text-sm text-slate-200">
                Video lengkap akan tersedia setelah peluncuran kanal resmi YouTube Waduk Manduk.
            </div>
        </div>
    </x-section>

    <x-section
        title="Ketentuan penggunaan media"
    >
        <x-alert variant="info" title="Lisensi penggunaan">
            Seluruh materi visual memiliki lisensi Creative Commons Attribution-NonCommercial. Hubungi <a href="mailto:media@wadukmanduk.id" class="font-semibold text-amber-300">media@wadukmanduk.id</a> untuk permintaan file asli atau penggunaan komersial.
        </x-alert>
    </x-section>
@endsection
