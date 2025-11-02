@extends('layouts.app')

@section('content')
    @php
        $dateLabel = $event->event_date?->translatedFormat('l, d F Y') ?? 'Jadwal diumumkan';
        $start = $event->start_time?->format('H.i') ?? null;
        $end = $event->end_time?->format('H.i') ?? null;
        $timeLabel = $start && $end ? "$start - $end WIB" : ($start ? "$start WIB" : null);
        $coverUrl = \App\Support\Media::url($event->cover_image);
    @endphp

    <x-section
        :title="$event->title"
        :subtitle="$event->excerpt"
    >
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr]">
            <div class="space-y-6">
                <div class="flex flex-wrap items-center gap-3">
                    <x-badge variant="info">{{ $dateLabel }} @if ($timeLabel) | {{ $timeLabel }} @endif</x-badge>
                    @if ($event->category)
                        <x-badge variant="success">{{ $event->category }}</x-badge>
                    @endif
                </div>

                @if ($coverUrl)
                    <img src="{{ $coverUrl }}" alt="{{ $event->title }}" class="w-full rounded-3xl border border-slate-200 object-cover shadow-sm">
                @endif

                <div class="prose prose-slate max-w-none">
                    {!! nl2br(e($event->body ?? 'Deskripsi acara akan diperbarui segera.')) !!}
                </div>
            </div>
            <aside class="space-y-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900">Ringkasan acara</h3>
                <dl class="space-y-3 text-sm text-slate-600">
                    @if ($event->location)
                        <div>
                            <dt class="font-semibold text-slate-800">Lokasi</dt>
                            <dd>{{ $event->location }}</dd>
                        </div>
                    @endif
                    @if ($timeLabel)
                        <div>
                            <dt class="font-semibold text-slate-800">Waktu</dt>
                            <dd>{{ $timeLabel }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="font-semibold text-slate-800">Status publikasi</dt>
                        <dd>
                            @if ($event->published_at)
                                Dirilis {{ $event->published_at->translatedFormat('d F Y H:i') }}
                            @else
                                Draft internal
                            @endif
                        </dd>
                    </div>
                </dl>
                <a
                    href="{{ route('event.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    <- Kembali ke daftar event
                </a>
            </aside>
        </div>
    </x-section>
@endsection
