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
    $normalizePhone = function (?string $raw) {
        if (! $raw) {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $raw);
        if ($digits === '') {
            return null;
        }

        if (str_starts_with($digits, '0')) {
            $digits = '62' . ltrim($digits, '0');
        }

        return $digits;
    };

    $institutions = collect($institutions)
        ->map(function ($it) use ($normalizePhone) {
            return [
                'title' => $it['title'] ?? '',
                'description' => $it['description'] ?? '',
                'phone' => $normalizePhone($it['phone'] ?? null),
                'raw_phone' => $it['phone'] ?? null,
            ];
        })
        ->filter(fn ($it) => $it['title'] !== '' || $it['description'] !== '' || $it['phone'])
        ->values()
        ->all();

    if (empty($institutions)) {
        $institutions = [
            ['title' => 'Puskesmas', 'description' => 'Layanan kesehatan dasar dan penanganan medis cepat.', 'phone' => $normalizePhone('+62 812-3456-7890'), 'raw_phone' => '+62 812-3456-7890'],
            ['title' => 'Polsek', 'description' => 'Koordinasi keamanan dan penanganan laporan kehilangan.', 'phone' => $normalizePhone('+62 812-3456-7891'), 'raw_phone' => '+62 812-3456-7891'],
            ['title' => 'BUMDes', 'description' => 'Pengelolaan operasional wisata dan kemitraan UMKM.', 'phone' => $normalizePhone('+62 812-3456-7892'), 'raw_phone' => '+62 812-3456-7892'],
            ['title' => 'KPW (Komunitas Peduli Waduk)', 'description' => 'Relawan kebersihan dan edukasi lingkungan.', 'phone' => $normalizePhone('+62 812-3456-7893'), 'raw_phone' => '+62 812-3456-7893'],
            ['title' => 'Pos Keamanan Wisata', 'description' => 'Pusat informasi, patroli area, dan respon darurat.', 'phone' => $normalizePhone('+62 812-3456-7894'), 'raw_phone' => '+62 812-3456-7894'],
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
            @if ($institution['phone'])
              <div class="mt-4 flex flex-wrap gap-2">
                <a
                  href="https://wa.me/{{ $institution['phone'] }}"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100"
                >
                  <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.296-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.485 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.158 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.892-11.893A11.825 11.825 0 0020.465 3.488"/>
                  </svg>
                  WhatsApp
                </a>
                
              </div>
            @endif
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
