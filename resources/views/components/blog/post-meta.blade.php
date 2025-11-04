@props([
    'date'     => null, // string | \Carbon\CarbonInterface
    'readTime' => null, // mis. "4 menit"
    'author'   => null, // nama penulis
])

@php
    use Carbon\CarbonInterface;

    // Normalisasi tanggal
    $dateText = null;
    $dateTimeAttr = null;

    if ($date instanceof CarbonInterface) {
        // contoh: 4 Nov 2025 (lokal id)
        $dateText = $date->locale('id')->translatedFormat('j M Y');
        $dateTimeAttr = $date->toDateString();
    } else {
        $dateText = $date; // anggap sudah diformat
        // jika ingin, bisa parse manual; dibiarkan null agar aman
    }

    $itemWrap = 'inline-flex items-center gap-1 after:mx-2 after:text-[var(--color-muted)] after:content-["•"] last:after:content-[""]';
    $iconCls  = 'h-3.5 w-3.5 opacity-80';
@endphp

<dl class="flex flex-wrap items-center gap-y-2 text-[11px] font-medium uppercase tracking-[0.2em] text-[var(--color-muted)]">
    @if ($dateText)
        <div class="{{ $itemWrap }}">
            <dt class="sr-only">Tanggal terbit</dt>
            <dd class="inline-flex items-center gap-1">
                {{-- ikon kalender --}}
                <svg class="{{ $iconCls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/>
                </svg>
                @if ($dateTimeAttr)
                    <time datetime="{{ $dateTimeAttr }}">{{ $dateText }}</time>
                @else
                    <span>{{ $dateText }}</span>
                @endif
            </dd>
        </div>
    @endif

    @if ($readTime)
        <div class="{{ $itemWrap }}">
            <dt class="sr-only">Durasi baca</dt>
            <dd class="inline-flex items-center gap-1">
                {{-- ikon jam --}}
                <svg class="{{ $iconCls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
                </svg>
                <span>{{ $readTime }}</span>
            </dd>
        </div>
    @endif

    @if ($author)
        <div class="{{ $itemWrap }}">
            <dt class="sr-only">Penulis</dt>
            <dd class="inline-flex items-center gap-1">
                {{-- ikon pena --}}
                <svg class="{{ $iconCls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
                </svg>
                <span class="normal-case tracking-normal">{{ $author }}</span>
            </dd>
        </div>
    @endif
</dl>
