@extends('layouts.app', [
    'title'       => $event->title,
    'description' => $event->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($event->body ?? ''), 160),
    'image'       => \App\Support\Media::url($event->cover_image) ?: asset('images/blog-placeholder.svg'),
])

@section('content')
@php
    use Illuminate\Support\Str;

    // Label tampilan
    $dateLabel = optional($event->event_date)->translatedFormat('l, d F Y') ?? 'Jadwal diumumkan';
    $start     = optional($event->start_time)->format('H.i');
    $end       = optional($event->end_time)->format('H.i');
    $timeLabel = $start && $end ? "{$start} - {$end} WIB" : ($start ? "{$start} WIB" : null);

    // Fallback cover
    $coverUrl  = \App\Support\Media::url($event->cover_image) ?: asset('images/blog-placeholder.svg');

    // ISO untuk SEO/kalender (+07:00 Asia/Jakarta)
    $dateISO   = optional($event->event_date)->toDateString();
    $startISO  = $dateISO ? (($s = optional($event->start_time)->format('H:i')) ? "{$dateISO}T{$s}:00+07:00" : "{$dateISO}T00:00:00+07:00") : null;
    $endISO    = ($dateISO && ($e = optional($event->end_time)->format('H:i'))) ? "{$dateISO}T{$e}:00+07:00" : null;

    // Status sederhana
    $isPast = optional($event->event_date)->isPast() ?? false;

    // URL halaman ini
    $pageUrl = route('event.show', $event);

    // Siapkan tombol Add to Calendar (opsional): sediakan route 'event.ics'
    $hasIcs = \Illuminate\Support\Facades\Route::has('event.ics');
    $icsUrl = $hasIcs ? route('event.ics', $event) : '#';
@endphp

{{-- Breadcrumb kecil --}}
<nav aria-label="Breadcrumb" class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 mt-4">
    <ol class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.3em] text-[var(--color-muted)]">
        <li><a href="{{ route('home') }}" class="hover:text-[var(--color-primary)]">Beranda</a></li>
        <li aria-hidden="true">/</li>
        <li><a href="{{ route('event.index') }}" class="hover:text-[var(--color-primary)]">Event</a></li>
        <li aria-hidden="true">/</li>
        <li class="text-[var(--color-ink)]">{{ Str::limit($event->title, 48) }}</li>
    </ol>
</nav>

<x-section :title="$event->title" :subtitle="$event->excerpt">
    <div class="grid gap-10 lg:grid-cols-[2fr_1fr]">
        {{-- KONTEN UTAMA --}}
        <article class="glass-card space-y-6 rounded-3xl p-8 text-[var(--color-ink)] shadow-2xl" itemscope itemtype="https://schema.org/Event">
            <meta itemprop="name" content="{{ $event->title }}">
            @if ($startISO)<meta itemprop="startDate" content="{{ $startISO }}">@endif
            @if ($endISO)<meta itemprop="endDate" content="{{ $endISO }}">@endif
            @if ($event->location)<meta itemprop="location" content="{{ $event->location }}">@endif
            <meta itemprop="image" content="{{ $coverUrl }}">

            <div class="flex flex-wrap items-center gap-3">
                <x-badge variant="info">
                    <time datetime="{{ $startISO ?? '' }}">{{ $dateLabel }}</time>
                    @if ($timeLabel) <span class="opacity-80">| {{ $timeLabel }}</span> @endif
                </x-badge>
                @if ($event->category)
                    <x-badge variant="success">{{ $event->category }}</x-badge>
                @endif
                <span class="rounded-full border border-white/15 px-2 py-0.5 text-xs font-semibold {{ $isPast ? 'text-[var(--color-muted)]' : 'text-[var(--color-primary)]' }}">
                    {{ $isPast ? 'Selesai' : 'Mendatang' }}
                </span>
            </div>

            @if ($coverUrl)
                <figure class="overflow-hidden rounded-3xl border border-white/15 bg-[#041f45] shadow-[0_26px_60px_-28px_rgba(5,23,63,0.8)]">
                    <img src="{{ $coverUrl }}" alt="{{ $event->title }}" class="w-full object-cover" loading="eager" itemprop="image">
                </figure>
            @endif

            {{-- Konten: dukung body_html, fallback nl2br --}}
            <div class="prose prose-invert max-w-none" itemprop="description">
                @if (!empty($event->body_html))
                    {!! $event->body_html !!}
                @else
                    {!! nl2br(e($event->body ?? 'Deskripsi acara akan diperbarui segera.')) !!}
                @endif
            </div>

            {{-- Prev/Next opsional: siapkan $prevEvent/$nextEvent di controller bila perlu --}}
            @if (isset($prevEvent) || isset($nextEvent))
                <nav class="mt-6 flex items-center justify-between gap-3 text-sm" aria-label="Navigasi event">
                    <div class="min-w-0">
                        @isset($prevEvent)
                            <a href="{{ route('event.show', $prevEvent) }}"
                               class="inline-flex items-center gap-2 rounded-xl border border-white/20 px-4 py-2 text-[var(--color-ink)] transition hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]">
                                ← {{ Str::limit($prevEvent->title, 48) }}
                            </a>
                        @endisset
                    </div>
                    <div class="min-w-0 text-right">
                        @isset($nextEvent)
                            <a href="{{ route('event.show', $nextEvent) }}"
                               class="inline-flex items-center gap-2 rounded-xl border border-white/20 px-4 py-2 text-[var(--color-ink)] transition hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]">
                                {{ Str::limit($nextEvent->title, 48) }} →
                            </a>
                        @endisset
                    </div>
                </nav>
            @endif
        </article>

        {{-- SIDEBAR --}}
        <aside class="glass-card space-y-6 rounded-3xl p-6 text-[var(--color-ink)] shadow-2xl">
            <h3 class="text-base font-semibold text-[var(--color-ink)]">Ringkasan acara</h3>
            <dl class="space-y-3 text-sm">
                @if ($event->location)
                    <div>
                        <dt class="font-semibold text-[var(--color-ink)]">Lokasi</dt>
                        <dd>{{ $event->location }}</dd>
                    </div>
                @endif
                @if ($timeLabel)
                    <div>
                        <dt class="font-semibold text-[var(--color-ink)]">Waktu</dt>
                        <dd>{{ $timeLabel }}</dd>
                    </div>
                @endif
                <div>
                    <dt class="font-semibold text-[var(--color-ink)]">Status publikasi</dt>
                    <dd>
                        @if ($event->published_at)
                            Dirilis {{ optional($event->published_at)->translatedFormat('d F Y H:i') }}
                        @else
                            Draft internal
                        @endif
                    </dd>
                </div>
            </dl>

            {{-- Share --}}
            <x-blog.share title="Bagikan acara ini" :url="$pageUrl" />

            {{-- Add to calendar --}}
            <div class="flex flex-col gap-2 pt-2">
                <a
                    href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($event->title) }}&dates={{ $startISO ? str_replace([':', '+'], ['', ''], $startISO) : '' }}/{{ $endISO ? str_replace([':', '+'], ['', ''], $endISO) : '' }}&details={{ urlencode($event->excerpt ?? $pageUrl) }}&location={{ urlencode($event->location ?? 'Waduk Manduk') }}"
                    target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center justify-center rounded-full bg-amber-400 px-4 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-[var(--color-ink)] transition hover:bg-amber-300"
                >
                    Tambah ke Google Calendar
                </a>

                <a
                    href="{{ $icsUrl }}"
                    @class([
                        'inline-flex items-center justify-center rounded-full border border-white/20 px-4 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-[var(--color-ink)] transition hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]',
                        ! $hasIcs ? 'opacity-60 cursor-not-allowed' : '',
                    ])
                    {{ $hasIcs ? '' : 'aria-disabled=true' }}
                >
                    Unduh ICS
                </a>
            </div>

            <a
                href="{{ route('event.index') }}"
                class="inline-flex items-center gap-2 rounded-full bg-amber-400 px-4 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-[var(--color-ink)] transition hover:bg-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-200 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-bg)]"
            >
                ← Kembali ke daftar event
            </a>
        </aside>
    </div>
</x-section>
@endsection

@push('head')
    {{-- Noindex untuk draft --}}
    @if (isset($event->is_published) && ! $event->is_published)
        <meta name="robots" content="noindex,follow">
    @endif

    {{-- JSON-LD Event --}}
    @php
        $schema = array_filter([
            '@context' => 'https://schema.org',
            '@type'    => 'Event',
            'name'     => (string) $event->title,
            'description' => (string) ($event->excerpt ?? Str::limit(strip_tags($event->body ?? ''), 160)),
            'startDate'   => $startISO,
            'endDate'     => $endISO,
            'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
            'eventStatus' => 'https://schema.org/EventScheduled',
            'image'       => [$coverUrl],
            'url'         => $pageUrl,
            'location'    => [
                '@type'   => 'Place',
                'name'    => (string) ($event->location ?? 'Waduk Manduk'),
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'Ngargoyoso',
                    'addressRegion'   => 'Karanganyar',
                    'addressCountry'  => 'ID',
                ],
            ],
        ]);
    @endphp
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
@endpush
