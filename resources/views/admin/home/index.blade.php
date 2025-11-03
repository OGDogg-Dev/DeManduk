@extends('layouts.admin', ['title' => 'Konten Beranda'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Kelola Konten Beranda</h1>
    <p class="mt-2 text-sm text-slate-600">Pilih modul berikut untuk memperbarui teks atau gambar yang tampil pada halaman publik.</p>

    <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @php
            $modules = [
                ['title' => 'Slide Hero', 'description' => 'Atur gambar, judul, dan CTA pada slider utama.', 'route' => route('admin.home.slides.index')],
                ['title' => 'Galeri', 'description' => 'Kelola foto yang tampil di halaman galeri publik.', 'route' => route('admin.gallery.index')],
                ['title' => 'Berita', 'description' => 'Tulis dan atur berita resmi Waduk Manduk.', 'route' => route('admin.news.index')],
                ['title' => 'Agenda', 'description' => 'Kelola daftar kegiatan pada section Agenda.', 'route' => route('admin.home.projects.index')],
                ['title' => 'Fasilitas', 'description' => 'Perbarui daftar fasilitas yang ditampilkan.', 'route' => route('admin.home.features.index')],
                ['title' => 'Harga & Fasilitas', 'description' => 'Kelola tabel harga tiket dan fasilitas.', 'route' => route('admin.home.pricing.index')],
                ['title' => 'Jam Operasional', 'description' => 'Sesuaikan jadwal layanan dan catatan penting.', 'route' => route('admin.home.hours.index')],
                ['title' => 'Statistik Pengunjung', 'description' => 'Kelola data statistik ringkas yang tampil di halaman beranda.', 'route' => route('admin.home.stats.index')],
                ['title' => 'Highlight SOP', 'description' => 'Atur ringkasan SOP singkat yang tampil pada section SOP.', 'route' => route('admin.home.procedures.index')],
                ['title' => 'Panduan SOP', 'description' => 'Perbarui langkah-langkah panduan kunjungan.', 'route' => route('admin.home.guides.index')],
                ['title' => 'Pengaturan Umum', 'description' => 'Sesuaikan judul situs, logo, paragraf tentang, dan peta.', 'route' => route('admin.home.settings.edit')],
            ];
        @endphp

        @foreach ($modules as $module)
            <a href="{{ $module['route'] }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">{{ $module['title'] }}</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ $module['description'] }}</p>
                </div>
                <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-600">Kelola sekarang</span>
            </a>
        @endforeach
    </div>
@endsection
