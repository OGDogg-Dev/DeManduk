@extends('layouts.app')

@section('content')
    <x-section
        title="Event dan agenda Waduk Manduk"
        subtitle="Jadwal kegiatan tematik yang memperkaya pengalaman wisata Anda."
    >
        <div class="grid gap-6 md:grid-cols-2">
            @forelse ($events as $event)
                @php
                    $dateLabel = $event->event_date?->translatedFormat('d F Y') ?? 'TBA';
                    $start = $event->start_time?->format('H.i') ?? null;
                    $end = $event->end_time?->format('H.i') ?? null;
                    $timeLabel = $start && $end ? "$start - $end WIB" : ($start ? "$start WIB" : null);
                @endphp
                <x-card :href="route('event.show', $event)" :title="$event->title" :subtitle="$event->excerpt">
                    <x-slot:icon>{{ strtoupper(substr($event->category ?? 'EV', 0, 2)) }}</x-slot:icon>
                    <div class="space-y-2 text-sm text-slate-600">
                        @if ($event->category)
                            <p><strong>Kategori:</strong> {{ $event->category }}</p>
                        @endif
                        @if ($event->event_date)
                            <p><strong>Tanggal:</strong> {{ $dateLabel }}</p>
                        @endif
                        @if ($timeLabel)
                            <p><strong>Waktu:</strong> {{ $timeLabel }}</p>
                        @endif
                        @if ($event->location)
                            <p><strong>Lokasi:</strong> {{ $event->location }}</p>
                        @endif
                    </div>
                </x-card>
            @empty
                <x-alert variant="info" title="Belum ada event terjadwal">
                    Jadwal kegiatan akan diumumkan segera. Silakan periksa kembali atau hubungi tim admin untuk informasi terbaru.
                </x-alert>
            @endforelse
        </div>

        @if ($events instanceof \Illuminate\Contracts\Pagination\Paginator)
            <div class="mt-8">
                {{ $events->links() }}
            </div>
        @endif
    </x-section>
@endsection
