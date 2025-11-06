@extends('layouts.app', [
    'title' => 'SOP — Waduk Manduk',
    'description' => "Standar Operasional Prosedur D'Manduk: pendahuluan, alur pelayanan inti, dan koordinasi instansi pendukung.",
])

@section('content')
@php
    use Illuminate\Support\Arr;
    use Illuminate\Support\Str;

    // Normalisasi koleksi agar aman saat null
    $introCol    = collect($introParagraphs ?? [])->filter(fn($p) => filled($p))->values();
    $stepsCol    = collect($steps ?? []);
    $partnersCol = collect($partners ?? []);
    $infoAlert   = $infoAlert ?? [];
    $bottomAlert = $bottomAlert ?? [];

    // Perkirakan tanggal pembaruan (pakai max updated_at dari steps/partners jika ada)
    $updatedCandidates = collect([
        optional($stepsCol->max('updated_at'))->toDateTimeString(),
        optional($partnersCol->max('updated_at'))->toDateTimeString(),
        now('Asia/Jakarta')->toDateTimeString(),
    ])->filter()->all();
    $updatedAt = \Carbon\Carbon::parse($updatedCandidates[0] ?? now('Asia/Jakarta'))->locale('id');

    // Siapkan JSON-LD HowTo dari steps (judul + items)
    $howToJson = [
        '@context' => 'https://schema.org',
        '@type'    => 'HowTo',
        'name'     => "Alur pelayanan inti D'Manduk",
        'step'     => $stepsCol->map(function ($s, $i) {
            $title = (string) data_get($s, 'title', "Langkah " . ($i+1));
            $items = collect(data_get($s, 'items', []))
                ->when(is_string(data_get($s, 'items')), fn($c) => collect([$c]))
                ->filter(fn($v) => filled($v))
                ->values()
                ->all();

            // Jika items kosong, jadikan satu HowToStep dengan deskripsi singkat
            if (empty($items)) {
                return [
                    '@type'       => 'HowToStep',
                    'name'        => $title,
                    'text'        => $title,
                    'position'    => $i + 1,
                ];
            }

            // Pecah menjadi beberapa sub-step
            return [
                '@type'    => 'HowToSection',
                'name'     => $title,
                'position' => $i + 1,
                'itemListElement' => collect($items)->map(fn($txt, $k) => [
                    '@type'    => 'HowToStep',
                    'name'     => is_string($txt) && Str::length($txt) > 60 ? Str::limit($txt, 60) : (string) $txt,
                    'text'     => (string) $txt,
                    'position' => $k + 1,
                ])->all(),
            ];
        })->values()->all(),
    ];
@endphp

{{-- Quick nav ke bagian halaman --}}
@php
    $sections = [
        ['#intro','Pendahuluan'],
        ['#flow','Alur Layanan'], 
        ['#partners','Instansi']
    ];
    // Add documents section to nav if documents exist
    if($allDocuments->count() > 0) {
        $sections[] = ['#documents', 'Dokumen'];
    }
@endphp
<x-public.quick-nav :sections="$sections" />

{{-- Bar aksi: Unduh & Cetak + info pembaruan --}}
<x-section variant="accent" class="pt-8 pb-0">
    <div class="glass-card flex flex-col gap-4 rounded-3xl p-6 sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm text-[var(--color-ink)]">
            <p><span class="font-semibold text-[var(--color-ink)]">Dokumen SOP</span> — Diperbarui {{ $updatedAt->translatedFormat('j F Y') }}</p>
        </div>
        <div class="flex flex-wrap gap-3">
            @if($latestDocument)
                <a
                    href="{{ route('sop.pdf.viewer', $latestDocument) }}"
                    target="_blank"
                    class="inline-flex items-center justify-center rounded-full bg-amber-400 px-5 py-2 text-sm font-semibold uppercase tracking-[0.2em] text-[var(--color-ink)] transition hover:bg-amber-300"
                >
                    Lihat PDF
                </a>
                <a
                    href="{{ route('sop.download', $latestDocument) }}"
                    class="inline-flex items-center justify-center rounded-full bg-sky-500 px-5 py-2 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-sky-600"
                >
                    Unduh PDF
                </a>
            @else
                <span class="inline-flex items-center justify-center rounded-full bg-gray-300 px-5 py-2 text-sm font-semibold uppercase tracking-[0.2em] text-gray-700">
                    PDF Belum Tersedia
                </span>
            @endif
            <button
                type="button"
                onclick="window.print()"
                class="inline-flex items-center justify-center rounded-full border border-[var(--color-border)] px-5 py-2 text-sm font-semibold uppercase tracking-[0.2em] text-[var(--color-ink)] transition hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]"
            >Cetak</button>
        </div>
    </div>
</x-section>

{{-- PENGANTAR --}}
<x-section
    id="intro"
    title="Standar Operasional Prosedur D'Manduk"
    :subtitle="$subtitle ?? 'Dokumen ringkas ini menjadi acuan utama bagi pengunjung, pelaku UMKM, dan petugas dalam menjaga kualitas layanan Waduk Manduk.'"
>
    <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="glass-card rounded-3xl p-8 shadow-2xl space-y-5 text-[var(--color-ink)]">
            @if ($introCol->isNotEmpty())
                @foreach ($introCol as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            @else
                <p>
                    SOP D'Manduk disusun untuk memastikan setiap aktivitas wisata berjalan aman, tertib, dan inklusif.
                    Ringkasan berikut membantu Anda memahami alur utama pelayanan ketika berkunjung.
                </p>
            @endif

            @if (data_get($infoAlert, 'title'))
                <x-alert :variant="data_get($infoAlert, 'variant','info')" :title="data_get($infoAlert, 'title')">
                    {{ data_get($infoAlert, 'body') }}
                </x-alert>
            @endif
        </div>
        <div class="glass-card rounded-3xl p-8 shadow-2xl">
            <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">Tujuan utama</h3>
            <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-relaxed text-[var(--color-ink)]">
                @forelse ($objectives ?? [] as $objective)
                    <li>{{ data_get($objective, 'content') }}</li>
                @empty
                    <li>Tujuan SOP akan diperbarui oleh pengelola.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-section>

{{-- ALUR LAYANAN INTI --}}
<x-section
    id="flow"
    variant="muted"
    title="Alur pelayanan inti"
    subtitle="Ikuti langkah-langkah berikut agar pengalaman berwisata tetap nyaman dan sesuai prosedur."
>
    <div class="grid gap-6 lg:grid-cols-2">
        @forelse ($stepsCol as $idx => $step)
            @php
                $items = collect(data_get($step, 'items', []))
                    ->when(is_string(data_get($step, 'items')), fn($c) => collect([$step->items]))
                    ->filter(fn($v) => filled($v))
                    ->values();
            @endphp
            <article class="glass-card rounded-3xl p-6 shadow-2xl">
                <h3 class="text-base font-semibold text-[var(--color-ink)]">{{ $loop->iteration }}. {{ data_get($step, 'title', 'Langkah') }}</h3>
                @if ($items->isNotEmpty())
                    <ol class="mt-3 list-decimal space-y-3 pl-5 text-sm leading-relaxed text-[var(--color-ink)]">
                        @foreach ($items as $it)
                            <li>{{ $it }}</li>
                        @endforeach
                    </ol>
                @else
                    <p class="mt-3 text-sm text-[var(--color-muted)]">Detail langkah akan diperbarui.</p>
                @endif
            </article>
        @empty
            <p class="text-sm text-[var(--color-muted)]">Langkah SOP akan diinformasikan segera.</p>
        @endforelse
    </div>
</x-section>

{{-- DAFTAR DOKUMEN SOP --}}
@if($allDocuments->count() > 0)
    <x-section id="documents" title="Dokumen SOP Tersedia">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($allDocuments as $document)
                <div class="glass-card rounded-2xl p-5 shadow-2xl">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-[var(--color-ink)]">{{ $document->title }}</h4>
                            <p class="mt-2 text-xs text-[var(--color-muted)]">{{ $document->original_name }}</p>
                            <p class="text-xs text-[var(--color-muted)]">{{ number_format($document->file_size / 1024, 2) }} KB</p>
                            <p class="text-xs text-[var(--color-muted)]">Diunggah: {{ $document->uploaded_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a 
                            href="{{ route('sop.pdf.viewer', $document) }}" 
                            target="_blank"
                            class="inline-flex items-center gap-1 rounded-full bg-indigo-100 px-3 py-1.5 text-xs font-semibold text-indigo-700 hover:bg-indigo-200 transition"
                        >
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Lihat
                        </a>
                        <a 
                            href="{{ route('sop.download', $document) }}"
                            class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700 hover:bg-amber-200 transition"
                        >
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Unduh
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-sm text-[var(--color-muted)] col-span-3">Belum ada dokumen SOP yang tersedia.</p>
            @endforelse
        </div>
    </x-section>
@endif

{{-- KOORDINASI INSTANSI --}}
<x-section id="partners" title="Koordinasi instansi pendukung">
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($partnersCol as $partner)
            <div class="glass-card rounded-2xl p-5 shadow-2xl">
                <h4 class="text-sm font-semibold text-[var(--color-ink)]">{{ data_get($partner, 'title') }}</h4>
                <p class="mt-2 text-sm text-[var(--color-ink)]">{{ data_get($partner, 'description') }}</p>
            </div>
        @empty
            <p class="text-sm text-[var(--color-muted)]">Data instansi pendukung belum tersedia.</p>
        @endforelse
    </div>

    @if (data_get($bottomAlert, 'title'))
        <x-alert :variant="data_get($bottomAlert, 'variant','success')" :title="data_get($bottomAlert, 'title')">
            {{ data_get($bottomAlert, 'body') }}
        </x-alert>
    @endif
</x-section>
@endsection

@push('head')
<script type="application/ld+json">
{!! json_encode($howToJson, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) !!}
</script>
@endpush
