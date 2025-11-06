@props([
    'guides'       => [],
    'institutions' => [],
])

@php
    // Ambil dokumen secara kronologis (lama -> terbaru)
    $sopDocuments = \App\Models\SopDocument::query()
        ->orderBy('uploaded_at')
        ->orderBy('id')
        ->get();
    $totalDocuments = $sopDocuments->count();
    $latestDocument = $sopDocuments->last();
    $lastUpdatedAt  = optional($latestDocument)->uploaded_at;

    // Normalisasi data instansi + fallback
    $institutions = collect($institutions)
        ->map(fn ($it) => ['title' => $it['title'] ?? '', 'description' => $it['description'] ?? ''])
        ->filter(fn ($it) => $it['title'] !== '' || $it['description'] !== '')
        ->values()
        ->all();

    if (empty($institutions)) {
        $institutions = [
            ['title' => 'Puskesmas',                 'description' => 'Layanan kesehatan dasar dan penanganan medis cepat.'],
            ['title' => 'Polsek',                    'description' => 'Koordinasi keamanan dan penanganan laporan kehilangan.'],
            ['title' => 'BUMDes',                    'description' => 'Pengelolaan operasional wisata dan kemitraan UMKM.'],
            ['title' => 'KPW (Komunitas Peduli Waduk)', 'description' => 'Relawan kebersihan dan edukasi lingkungan.'],
            ['title' => 'Pos Keamanan Wisata',       'description' => 'Pusat informasi, patroli area, dan respon darurat.'],
        ];
    }

    $sopSectionUrl = route('home') . '#sop-detail';
@endphp

{{-- Seksi 1: Ringkasan & Tujuan --}}
<x-section
  id="sop-detail"
  title="Standar Operasional Prosedur (SOP)"
  subtitle="Daftar Standar Operasional Prosedur (SOP) D'Manduk"
>
  <div class="grid gap-10 lg:grid-cols-[minmax(1.35fr)_minmax(0,0.65fr)]">
    {{-- Ringkasan dokumen --}}
    <div class="card ring-subtle rounded-[20px] p-8 space-y-6">
      <div class="flex items-start justify-between gap-4">
        <div>
          <p class="text-xs font-semibold tracking-[0.25em] uppercase text-[var(--color-muted)]">Dokumen SOP</p>
          <h3 class="mt-2 text-xl font-semibold text-[var(--color-ink)]">Linimasa Dokumen SOP</h3>
          
        </div>
        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
          {{ $totalDocuments }} dokumen
        </span>
      </div>

      @if ($sopDocuments->isNotEmpty())
        <div class="space-y-3">
          @foreach($sopDocuments as $doc)
            <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white/70 px-3 py-3 shadow-sm shadow-slate-200/40 backdrop-blur transition hover:border-blue-200 hover:shadow-blue-200/40">
              <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-blue-500">
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-semibold text-[var(--color-ink)]">{{ Str::limit($doc->title, 36) }}</p>
                  <p class="text-[11px] uppercase tracking-[0.2em] text-[var(--color-muted)]">
                    {{ optional($doc->uploaded_at)->timezone('Asia/Jakarta')->translatedFormat('d M Y') ?? 'Belum ada tanggal' }}
                  </p>
                </div>
              </div>
              <div class="flex gap-2">
                <a 
                  href="{{ route('sop.pdf.viewer', $doc) }}" 
                  target="_blank"
                  class="inline-flex items-center gap-1 rounded-full bg-indigo-100 px-2.5 py-1 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-200"
                >
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  Lihat
                </a>
                <a 
                  href="{{ route('sop.download', $doc) }}"
                  class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700 transition hover:bg-amber-200"
                >
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  Unduh
                </a>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50/80 p-6 text-sm text-[var(--color-muted)]">
          Belum ada dokumen diunggah. Tim kami masih menyiapkan konten SOP terbaru untuk Anda. Silakan cek kembali beberapa saat lagi.
        </div>
      @endif
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
          <div>
            <p class="text-[11px] uppercase tracking-[0.3em] text-[var(--color-muted)]">{{ $guide['category'] ?? 'PANDUAN' }}</p>
            <h3 class="mt-1 text-base font-semibold text-[var(--color-ink)]">
              {{ $guide['title'] ?? 'PANDUAN' }}
            </h3>
          </div>
          <svg class="h-5 w-5 shrink-0 transition-transform group-open:rotate-180 text-[var(--color-muted)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 9l6 6 6-6"/>
          </svg>
        </summary>
        @php($items = $guide['items'] ?? [])
        @if (!empty($items))
          <ol class="mt-4 space-y-3 border-t border-dashed border-slate-200 pt-3 text-sm leading-7 text-[var(--color-muted)]">
            @foreach ($items as $index => $item)
              <li class="flex gap-3">
                <span class="mt-1 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-50 text-xs font-semibold text-blue-600">{{ $index + 1 }}</span>
                <span>{{ $item }}</span>
              </li>
            @endforeach
          </ol>
        @else
          <p class="mt-4 rounded-lg bg-slate-50 p-4 text-sm text-[var(--color-muted)]">
            Detail panduan sedang diperbarui. Silakan cek ulang untuk informasi langkah demi langkah.
          </p>
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
      <article class="card ring-subtle rounded-[16px] p-5 transition hover:border-blue-200 hover:shadow-blue-200/40">
        <div class="flex items-start gap-3">
          <span class="mt-1 inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-sky-50 text-sky-500">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
            </svg>
          </span>
          <div>
            <h4 class="text-sm font-semibold text-[var(--color-ink)]">{{ $institution['title'] }}</h4>
            <p class="mt-2 text-sm leading-7 text-[var(--color-muted)]">{{ $institution['description'] }}</p>
          </div>
        </div>
      </article>
    @endforeach
  </div>

  <x-alert variant="success" title="Hubungi kami" class="mt-6">
    Untuk klarifikasi lebih lanjut, gunakan halaman
    <a href="{{ route('kontak') }}" class="font-medium text-[var(--color-primary)] hover:underline">Kontak</a>
    atau koordinasikan langsung dengan instansi terkait sesuai kebutuhan Anda.
  </x-alert>
</x-section>


