@props([
    'date' => null,
    'readTime' => null,
    'author' => null,
])

<dl class="flex flex-wrap items-center gap-x-5 gap-y-2 text-[10px] font-medium uppercase tracking-[0.3em] text-slate-400">
    @if ($date)
        <div class="flex items-center gap-2">
            <dt class="sr-only">Tanggal terbit</dt>
            <dd class="inline-flex items-center gap-1">
                <span aria-hidden="true">🗓️</span>
                {{ $date }}
            </dd>
        </div>
    @endif
    @if ($readTime)
        <div class="flex items-center gap-2">
            <dt class="sr-only">Durasi baca</dt>
            <dd class="inline-flex items-center gap-1">
                <span aria-hidden="true">⏱️</span>
                {{ $readTime }}
            </dd>
        </div>
    @endif
    @if ($author)
        <div class="flex items-center gap-2">
            <dt class="sr-only">Penulis</dt>
            <dd class="inline-flex items-center gap-1">
                <span aria-hidden="true">✍️</span>
                {{ $author }}
            </dd>
        </div>
    @endif
</dl>
