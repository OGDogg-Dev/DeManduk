@props([
    'title' => null,
    'subtitle' => null,
    'href' => null,
])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @endif
    {{ $attributes->class('group flex flex-col gap-4 rounded-2xl border border-white/15 bg-[#031838]/80 p-6 shadow-[0_26px_60px_-28px_rgba(5,23,63,0.8)] backdrop-blur transition hover:-translate-y-1 hover:shadow-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#020f24]') }}
>
    @isset($icon)
        <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-amber-400/20 text-2xl text-amber-300">
            {{ $icon }}
        </div>
    @endisset

    <div class="space-y-3">
        @if ($title)
            <h3 class="text-xl font-semibold text-white group-hover:text-amber-300">{{ $title }}</h3>
        @endif
        @if ($subtitle)
            <p class="text-sm leading-relaxed text-slate-300">{{ $subtitle }}</p>
        @endif
    </div>

    <div class="flex-1">
        {{ $slot }}
    </div>
</{{ $tag }}>
