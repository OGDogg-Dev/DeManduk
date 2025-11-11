@extends('layouts.admin', ['title' => 'Dasbor Admin'])

@section('content')
    @php
        $currentUser = auth()->user();
        $filterModules = function (array $modules) use ($currentUser) {
            if (! $currentUser) {
                return [];
            }

            return collect($modules)
                ->filter(function ($module) use ($currentUser) {
                    $capability = $module['capability'] ?? 'admin';

                    return $currentUser->hasCapability($capability);
                })
                ->values()
                ->all();
        };

        $contentModules = $filterModules([
            ['title' => 'Slide Hero', 'description' => 'Atur gambar, judul, dan CTA pada slider utama.', 'route' => route('admin.home.slides.index'), 'icon' => 'presentation-chart-bar', 'capability' => 'admin'],
            ['title' => 'Agenda', 'description' => 'Kelola daftar kegiatan pada section Agenda.', 'route' => route('admin.home.projects.index'), 'icon' => 'calendar', 'capability' => 'admin'],
            ['title' => 'Fasilitas', 'description' => 'Perbarui daftar fasilitas yang ditampilkan.', 'route' => route('admin.home.features.index'), 'icon' => 'cube', 'capability' => 'admin'],
            ['title' => 'Harga & Fasilitas', 'description' => 'Kelola tabel harga tiket dan fasilitas.', 'route' => route('admin.home.pricing.index'), 'icon' => 'currency-dollar', 'capability' => 'admin'],
            ['title' => 'Jam Operasional', 'description' => 'Sesuaikan jadwal layanan dan catatan penting.', 'route' => route('admin.home.hours.index'), 'icon' => 'clock', 'capability' => 'admin'],
            ['title' => 'Statistik Pengunjung', 'description' => 'Kelola data statistik ringkas yang tampil di halaman beranda.', 'route' => route('admin.home.stats.index'), 'icon' => 'chart-pie', 'capability' => 'admin'],
            ['title' => 'Highlight SOP', 'description' => 'Atur ringkasan SOP singkat yang tampil pada section SOP.', 'route' => route('admin.home.procedures.index'), 'icon' => 'light-bulb', 'capability' => 'admin'],
            ['title' => 'Panduan SOP', 'description' => 'Perbarui langkah-langkah panduan kunjungan.', 'route' => route('admin.home.guides.index'), 'icon' => 'book-open', 'capability' => 'admin'],
            ['title' => 'Dokumen SOP PDF', 'description' => 'Upload dan kelola dokumen PDF SOP.', 'route' => route('admin.pages.sop.documents.index'), 'icon' => 'document-text', 'capability' => 'admin'],
            ['title' => 'Galeri', 'description' => 'Kelola foto yang tampil di halaman galeri publik.', 'route' => route('admin.gallery.index'), 'icon' => 'photo', 'capability' => 'gallery'],
            ['title' => 'Berita', 'description' => 'Tulis dan atur berita resmi Waduk Manduk.', 'route' => route('admin.news.index'), 'icon' => 'newspaper', 'capability' => 'news'],
            ['title' => 'Event', 'description' => 'Atur kegiatan dan event komunitas.', 'route' => route('admin.events.index'), 'icon' => 'calendar-days', 'capability' => 'events'],
        ]);

        $pageModules = $filterModules([
            ['title' => 'Kontak & Darurat', 'description' => 'Atur informasi kontak dan instansi pendukung.', 'route' => route('admin.pages.contact.settings.edit'), 'icon' => 'envelope-open', 'capability' => 'admin'],
            ['title' => 'Instansi Pendukung', 'description' => 'Atur daftar instansi yang tampil di kontak.', 'route' => route('admin.pages.contact.supports.index'), 'icon' => 'building-office', 'capability' => 'admin'],
            ['title' => 'Peringatan Kontak', 'description' => 'Kelola pesan-pesan penting di halaman kontak.', 'route' => route('admin.pages.contact.alerts.index'), 'icon' => 'exclamation-triangle', 'capability' => 'admin'],
            ['title' => 'Pembayaran QRIS', 'description' => 'Atur informasi pembayaran digital.', 'route' => route('admin.pages.qris.settings.edit'), 'icon' => 'credit-card', 'capability' => 'admin'],
            ['title' => 'Langkah Pembayaran', 'description' => 'Atur langkah-langkah penggunaan QRIS.', 'route' => route('admin.pages.qris.steps.index'), 'icon' => 'arrow-trending-up', 'capability' => 'admin'],
            ['title' => 'Catatan Transaksi', 'description' => 'Kelola informasi penting terkait pembayaran.', 'route' => route('admin.pages.qris.notes.index'), 'icon' => 'document-text', 'capability' => 'admin'],
            ['title' => 'FAQ QRIS', 'description' => 'Atur pertanyaan umum tentang QRIS.', 'route' => route('admin.pages.qris.faqs.index'), 'icon' => 'question-mark-circle', 'capability' => 'admin'],
            ['title' => 'Prosedur (SOP)', 'description' => 'Atur halaman standar operasional prosedur.', 'route' => route('admin.pages.sop.settings.edit'), 'icon' => 'document-text', 'capability' => 'admin'],
            ['title' => 'Langkah Pelayanan', 'description' => 'Atur alur SOP dari pra-kunjungan hingga selesai.', 'route' => route('admin.pages.sop.steps.index'), 'icon' => 'list-bullet', 'capability' => 'admin'],
            ['title' => 'Tujuan SOP', 'description' => 'Atur tujuan utama dari SOP.', 'route' => route('admin.pages.sop.objectives.index'), 'icon' => 'flag', 'capability' => 'admin'],
            ['title' => 'Instansi SOP', 'description' => 'Atur daftar instansi pendukung SOP.', 'route' => route('admin.pages.sop.partners.index'), 'icon' => 'user-group', 'capability' => 'admin'],
            ['title' => 'Dokumen SOP PDF', 'description' => 'Upload dan kelola dokumen PDF SOP.', 'route' => route('admin.pages.sop.documents.index'), 'icon' => 'document-text', 'capability' => 'admin'],
            ['title' => 'Media Sosial', 'description' => 'Atur tautan media sosial di footer.', 'route' => route('admin.pages.social-media.settings.edit'), 'icon' => 'share', 'capability' => 'admin'],
        ]);

        $systemModules = $filterModules([
            ['title' => 'Pengaturan Umum', 'description' => 'Sesuaikan judul situs, logo, paragraf tentang, dan peta.', 'route' => route('admin.home.settings.edit'), 'icon' => 'cog-6-tooth', 'capability' => 'admin'],
            ['title' => 'Styleguide', 'description' => 'Lihat komponen dan gaya desain sistem.', 'route' => route('admin.styleguide'), 'icon' => 'swatch', 'capability' => 'admin'],
        ]);
    @endphp

    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Dasbor Administrasi</h1>
        <p class="mt-2 text-sm text-slate-600">Akses fungsi administrasi sesuai peran Anda.</p>
    </div>

    @if (empty($contentModules) && empty($pageModules) && empty($systemModules))
        <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center text-sm text-slate-600">
            Anda belum memiliki modul yang dapat dikelola. Hubungi admin untuk meminta akses tambahan.
        </div>
    @endif

    @if (count($contentModules))
        <!-- Content Management -->
        <section class="mb-8">
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Manajemen Konten</h2>
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($contentModules as $module)
                    <a href="{{ $module['route'] }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                        <div>
                            <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                                <x-admin.icon :name="$module['icon']" class="h-5 w-5 text-indigo-600" />
                            </div>
                            <h2 class="text-lg font-semibold text-slate-900">{{ $module['title'] }}</h2>
                            <p class="mt-2 text-sm text-slate-600">{{ $module['description'] }}</p>
                        </div>
                        <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-600">Kelola sekarang</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    @if (count($pageModules))
        <!-- Page Management -->
        <section class="mb-8">
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Manajemen Halaman</h2>
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($pageModules as $module)
                    <a href="{{ $module['route'] }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                        <div>
                            <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50">
                                <x-admin.icon :name="$module['icon']" class="h-5 w-5 text-emerald-600" />
                            </div>
                            <h2 class="text-lg font-semibold text-slate-900">{{ $module['title'] }}</h2>
                            <p class="mt-2 text-sm text-slate-600">{{ $module['description'] }}</p>
                        </div>
                        <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-600">Kelola sekarang</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    @if (count($systemModules))
        <!-- System Settings -->
        <section>
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Pengaturan Sistem</h2>
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($systemModules as $module)
                    <a href="{{ $module['route'] }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                        <div>
                            <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                                <x-admin.icon :name="$module['icon']" class="h-5 w-5 text-amber-600" />
                            </div>
                            <h2 class="text-lg font-semibold text-slate-900">{{ $module['title'] }}</h2>
                            <p class="mt-2 text-sm text-slate-600">{{ $module['description'] }}</p>
                        </div>
                        <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-600">Atur sekarang</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endsection
