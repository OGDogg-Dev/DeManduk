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
    {{ $attributes->class('group flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2') }}
>
    @isset($icon)
        <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-2xl text-blue-600">
            {{ $icon }}
        </div>
    @endisset

    <div class="space-y-3">
        @if ($title)
            <h3 class="text-xl font-semibold text-slate-900 group-hover:text-blue-600">{{ $title }}</h3>
        @endif
        @if ($subtitle)
            <p class="text-sm leading-relaxed text-slate-600">{{ $subtitle }}</p>
        @endif
    </div>

    <div class="flex-1">
        {{ $slot }}
    </div>
</{{ $tag }}>
