@extends('layouts.app', [
    'title' => 'Event & Agenda — Waduk Manduk',
    'description' => 'Jadwal kegiatan tematik yang memperkaya pengalaman wisata Anda di Waduk Manduk.',
])

@section('content')
    @php
        $tz = 'Asia/Jakarta';
    @endphp

    <x-section
        title="Event dan agenda Waduk Manduk"
        subtitle="Jadwal kegiatan tematik yang memperkaya pengalaman wisata Anda."
    >
        <div class="grid gap-6 md:grid-cols-2">
            @forelse ($events as $event)
                @php
                    // Label tampilan
                    $dateLabel = optional($event->event_date)->translatedFormat('d F Y') ?? 'TBA';
                    $start     = optional($event->start_time)->format('H.i');
                    $end       = optional($event->end_time)->format('H.i');
                    $timeLabel = $start && $end ? "{$start} - {$end} WIB" : ($start ? "{$start} WIB" : null);

                    // Untuk <time datetime> (ISO 8601)
                    $dateISO   = optional($event->event_date)->toDateString();
                    $startISO  = $start ? optional($event->start_time)->format('H:i') : null;
                    $endISO    = $end ? optional($event->end_time)->format('H:i') : null;

                    // Status sederhana (opsional)
                    $isPast = optional($event->event_date)->isPast() ?? false;
                @endphp

                <x-card
                    :href="route('event.show', $event)"
                    :title="$event->title"
                    :subtitle="$event->excerpt"
                    aria-label="Buka detail event: {{ $event->title }}"
                >
                    <x-slot:icon>{{ strtoupper(substr($event->category ?? 'EV', 0, 2)) }}</x-slot:icon>

                    <div class="space-y-2 text-sm text-slate-200">
                        @if ($event->category)
                            <p><strong class="text-white">Kategori:</strong> {{ $event->category }}</p>
                        @endif

                        @if ($event->event_date)
                            <p class="flex flex-wrap items-center gap-2">
                                <strong class="text-white">Tanggal:</strong>
                                <time datetime="{{ $dateISO ?? '' }}{{ $startISO ? 'T'.$startISO.':00+07:00' : '' }}">{{ $dateLabel }}</time>
                            </p>
                        @endif

                        @if ($timeLabel)
                            <p><strong class="text-white">Waktu:</strong> {{ $timeLabel }}</p>
                        @endif

                        @if ($event->location)
                            <p><strong class="text-white">Lokasi:</strong> {{ $event->location }}</p>
                        @endif

                        {{-- Status ringkas --}}
                        <p>
                            <span class="rounded-full border border-white/15 px-2 py-0.5 text-xs font-semibold
                                {{ $isPast ? 'text-slate-400' : 'text-amber-300' }}">
                                {{ $isPast ? 'Selesai' : 'Mendatang' }}
                            </span>
                        </p>
                    </div>
                </x-card>
            @empty
                <x-alert variant="info" title="Belum ada event terjadwal">
                    Jadwal kegiatan akan diumumkan segera. Silakan periksa kembali atau hubungi tim admin untuk informasi terbaru.
                </x-alert>
            @endforelse
        </div>

        @if (method_exists($events, 'hasPages') && $events->hasPages())
            <div class="mt-8">
                {{ $events->onEachSide(1)->withQueryString()->links() }}
            </div>
        @endif
    </x-section>
@endsection

@push('head')
    {{-- Noindex untuk halaman > 1 agar hindari konten duplikat --}}
    @if (method_exists($events, 'currentPage') && $events->currentPage() > 1)
        <meta name="robots" content="noindex,follow">
    @endif

    {{-- JSON-LD Event list (SEO) --}}
    @php
        $eventItems = [];
        if($events && $events->count() > 0) {
            foreach($events as $e) {
                $date = optional($e->event_date)->toDateString();
                $start = optional($e->start_time)->format('H:i');
                $end   = optional($e->end_time)->format('H:i');

                $startIso = $date ? ($start ? "{$date}T{$start}:00+07:00" : "{$date}T00:00:00+07:00") : null;
                $endIso   = $date && $end ? "{$date}T{$end}:00+07:00" : null;

                $eventItems[] = array_filter([
                    '@type' => 'Event',
                    'name'  => (string) ($e->title ?? 'Event'),
                    'description' => (string) ($e->excerpt ?? ''),
                    'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
                    'eventStatus' => 'https://schema.org/EventScheduled',
                    'startDate' => $startIso,
                    'endDate'   => $endIso,
                    'location'  => [
                        '@type' => 'Place',
                        'name'  => (string) ($e->location ?? 'Waduk Manduk'),
                        'address' => [
                            '@type' => 'PostalAddress',
                            'addressLocality' => 'Ngargoyoso',
                            'addressRegion'   => 'Karanganyar',
                            'addressCountry'  => 'ID',
                        ],
                    ],
                    'url' => route('event.show', $e),
                ]);
            }
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type'    => 'ItemList',
            'itemListElement' => collect($eventItems)->map(fn ($it, $i) => [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'item'     => $it,
            ])->all(),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
