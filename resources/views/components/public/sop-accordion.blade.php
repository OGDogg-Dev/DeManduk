@props([
    'guides'       => [],
    'institutions' => [],
])

@php
  // Normalisasi data instansi + fallback
  $institutions = collect($institutions)
    ->map(fn ($it) => ['title' => $it['title'] ?? '', 'description' => $it['description'] ?? ''])
    ->filter(fn ($it) => $it['title'] !== '' || $it['description'] !== '')
    ->values()
    ->all();

  if (empty($institutions)) {
      $institutions = [
          ['title' => 'Puskesmas',                 'description' => 'Layanan kesehatan dasar dan penanganan medis cepat.'],
          ['title' => 'Polsek',                     'description' => 'Koordinasi keamanan dan penanganan laporan kehilangan.'],
          ['title' => 'BUMDes',                     'description' => 'Pengelolaan operasional wisata dan kemitraan UMKM.'],
          ['title' => 'KPW (Komunitas Peduli Waduk)','description' => 'Relawan kebersihan dan edukasi lingkungan.'],
          ['title' => 'Pos Keamanan Wisata',        'description' => 'Pusat informasi, patroli area, dan respon darurat.'],
      ];
  }
@endphp

{{-- Seksi 1: Ringkasan & Tujuan --}}
<x-section
  id="sop-detail"
  title="Standar Operasional Prosedur (SOP)"
  subtitle="Ikuti alur pelayanan berikut agar kunjungan Anda ke Waduk Manduk tetap aman, nyaman, dan tertib."
>
  <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
    {{-- Ringkasan --}}
    <div class="card ring-subtle rounded-[20px] p-8 space-y-5">
      <p class="text-[15px] leading-7 text-[var(--color-muted)]">
        SOP D’Manduk disusun untuk memastikan setiap aktivitas wisata berjalan aman, tertib, dan inklusif.
        Seluruh petugas frontliner, pengelola fasilitas, hingga komunitas relawan menerapkan panduan ini dalam melayani pengunjung.
      </p>
      <p class="text-[15px] leading-7 text-[var(--color-muted)]">
        Dokumen lengkap dapat diunduh melalui desk informasi. Ringkasan di bawah membantu Anda memahami alur utama pelayanan ketika berkunjung.
      </p>
      <x-alert variant="info" title="Catatan pembaruan">
        SOP diperbarui secara berkala berdasarkan evaluasi kunjungan dan rekomendasi instansi pendukung.
      </x-alert>
    </div>

    {{-- Tujuan utama --}}
    <div class="card ring-subtle rounded-[20px] p-8">
      <h3 class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">Tujuan utama</h3>
      <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-7 text-[var(--color-muted)]">
        <li>Menjaga keselamatan pengunjung dan pekerja wisata.</li>
        <li>Memastikan proses tiket, pembayaran, dan penggunaan fasilitas berlangsung transparan.</li>
        <li>Melindungi kelestarian lingkungan waduk melalui tata kelola kebersihan terpadu.</li>
        <li>Mendorong koordinasi cepat antar instansi ketika terjadi kondisi darurat.</li>
      </ul>
    </div>
  </div>
</x-section>

{{-- Seksi 2: Alur Pelayanan Inti (Accordion) --}}
<x-section
  variant="muted"
  title="Alur pelayanan inti"
  subtitle="Ikuti langkah-langkah berikut agar pengalaman berwisata tetap nyaman dan sesuai prosedur."
>
  <div class="grid gap-4 lg:grid-cols-2">
    @forelse ($guides as $guide)
      <details class="group card ring-subtle rounded-[16px] p-5 open:shadow-sm">
        <summary class="flex cursor-pointer items-center justify-between gap-4">
          <h3 class="text-base font-semibold text-[var(--color-ink)]">
            {{ $guide['title'] ?? 'Panduan' }}
          </h3>
          <svg class="h-5 w-5 shrink-0 transition-transform group-open:rotate-180 text-[var(--color-muted)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 9l6 6 6-6"/>
          </svg>
        </summary>
        @php($items = $guide['items'] ?? [])
        @if (!empty($items))
          <ol class="mt-3 list-decimal space-y-2 pl-5 text-sm leading-7 text-[var(--color-muted)]">
            @foreach ($items as $item)
              <li>{{ $item }}</li>
            @endforeach
          </ol>
        @endif
      </details>
    @empty
      <div class="card ring-subtle rounded-[16px] p-5">
        <h3 class="text-base font-semibold text-[var(--color-ink)]">Tata tertib umum</h3>
        <ol class="mt-3 list-decimal space-y-2 pl-5 text-sm leading-7 text-[var(--color-muted)]">
          <li>Ikuti arahan petugas saat memasuki area wisata.</li>
          <li>Patuhi rambu keselamatan dan jalur pejalan kaki.</li>
          <li>Jaga kebersihan: buang sampah pada tempatnya.</li>
          <li>Gunakan fasilitas sesuai peruntukannya.</li>
        </ol>
      </div>
    @endforelse
  </div>
</x-section>

{{-- Seksi 3: Koordinasi Instansi --}}
<x-section title="Koordinasi instansi pendukung">
  <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($institutions as $institution)
      <article class="card ring-subtle rounded-[16px] p-5">
        <h4 class="text-sm font-semibold text-[var(--color-ink)]">{{ $institution['title'] }}</h4>
        <p class="mt-2 text-sm leading-7 text-[var(--color-muted)]">{{ $institution['description'] }}</p>
      </article>
    @endforeach
  </div>

  <x-alert variant="success" title="Hubungi kami" class="mt-6">
    Untuk klarifikasi lebih lanjut, gunakan halaman
    <a href="{{ route('kontak') }}" class="font-medium text-[var(--color-primary)] hover:underline">Kontak</a>
    atau koordinasikan langsung dengan instansi terkait sesuai kebutuhan Anda.
  </x-alert>
</x-section>
