@props([
    'guides' => [],
    'institutions' => [],
])

@php
    $institutions = collect($institutions)->map(function ($item) {
        return [
            'title' => $item['title'] ?? '',
            'description' => $item['description'] ?? '',
        ];
    })->filter(fn ($item) => $item['title'] !== '' || $item['description'] !== '')->values()->all();

    if (empty($institutions)) {
        $institutions = [
            ['title' => 'Puskesmas', 'description' => 'Layanan kesehatan dasar dan penanganan medis cepat.'],
            ['title' => 'Polsek', 'description' => 'Koordinasi keamanan dan penanganan laporan kehilangan.'],
            ['title' => 'BUMDes', 'description' => 'Pengelolaan operasional wisata dan kemitraan UMKM.'],
            ['title' => 'KPW (Komunitas Peduli Waduk)', 'description' => 'Relawan kebersihan dan edukasi lingkungan.'],
            ['title' => 'Pos Keamanan Wisata', 'description' => 'Pusat informasi, patroli area, dan respon darurat.'],
        ];
    }
@endphp

<x-section
    id="sop-detail"
    title="Standar Operasional Prosedur (SOP)"
    subtitle="Ikuti alur pelayanan berikut agar kunjungan Anda ke Waduk Manduk tetap aman, nyaman, dan tertib."
>
    <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="glass-card rounded-3xl p-8 shadow-2xl space-y-5 text-slate-200">
            <p>
                SOP D'Manduk disusun untuk memastikan setiap aktivitas wisata berjalan aman, tertib, dan inklusif.
                Seluruh petugas frontliner, pengelola fasilitas, hingga komunitas relawan menerapkan panduan ini dalam melayani pengunjung.
            </p>
            <p>
                Dokumen lengkap dapat diunduh melalui desk informasi. Ringkasan di bawah membantu Anda memahami alur utama pelayanan ketika berkunjung.
            </p>
            <x-alert variant="info" title="Catatan pembaruan">
                SOP diperbarui secara berkala berdasarkan evaluasi kunjungan dan rekomendasi instansi pendukung.
            </x-alert>
        </div>
        <div class="glass-card rounded-3xl p-8 shadow-2xl">
            <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300">Tujuan utama</h3>
            <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-relaxed text-slate-200">
                <li>Menjaga keselamatan pengunjung dan pekerja wisata.</li>
                <li>Memastikan proses tiket, pembayaran, dan penggunaan fasilitas berlangsung transparan.</li>
                <li>Melindungi kelestarian lingkungan waduk melalui tata kelola kebersihan terpadu.</li>
                <li>Mendorong koordinasi cepat antar instansi ketika terjadi kondisi darurat.</li>
            </ul>
        </div>
    </div>
</x-section>

<x-section
    variant="muted"
    title="Alur pelayanan inti"
    subtitle="Ikuti langkah-langkah berikut agar pengalaman berwisata tetap nyaman dan sesuai prosedur."
>
    <div class="grid gap-6 lg:grid-cols-2">
        @foreach ($guides as $guide)
            <article class="glass-card rounded-3xl p-6 shadow-2xl">
                <h3 class="text-base font-semibold text-white">{{ $guide['title'] ?? '' }}</h3>
                <ol class="mt-3 space-y-3 text-sm leading-relaxed text-slate-200">
                    @foreach (($guide['items'] ?? []) as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </article>
        @endforeach
    </div>
</x-section>

<x-section title="Koordinasi instansi pendukung">
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($institutions as $institution)
            <div class="glass-card rounded-2xl p-5 shadow-2xl">
                <h4 class="text-sm font-semibold text-white">{{ $institution['title'] }}</h4>
                <p class="mt-2 text-sm text-slate-200">{{ $institution['description'] }}</p>
            </div>
        @endforeach
    </div>
    <x-alert variant="success" title="Hubungi kami">
        Untuk klarifikasi lebih lanjut, gunakan halaman <a href="{{ route('kontak') }}" class="font-semibold text-amber-300">Kontak</a> atau koordinasikan langsung dengan instansi terkait sesuai kebutuhan Anda.
    </x-alert>
</x-section>
