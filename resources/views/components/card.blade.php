@props([
    'title'    => null,
    'subtitle' => null,
    'href'     => null,
    'as'       => null,   // opsional: paksa tag (e.g. 'button', 'section')
    'icon'     => null,   // slot ikon optional (emoji/SVG/component)
])

@php
    $tag    = $as ?? ($href ? 'a' : 'div');
    $isLink = $href || $as === 'a';

    $base   = 'card flex flex-col gap-4 p-4 sm:p-5 md:p-6 transition -translate-y-0 hover:-translate-y-0.5
               hover:shadow-lg focus:outline-none focus-visible:ring-2
               focus-visible:ring-blue-300 focus-visible:ring-offset-2
               focus-visible:ring-offset-[var(--color-surface)]';

    $titleClass    = 'text-xl font-semibold text-[var(--color-ink)] '.($isLink ? 'group-hover:text-[var(--color-primary)] transition-colors' : '');
    $subtitleClass = 'text-sm leading-relaxed text-[var(--color-muted)]';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => 'group '.$base]) }}
>
    @isset($icon)
        <div class="inline-flex size-12 items-center justify-center rounded-xl bg-[var(--color-primary-100)] text-[var(--color-primary-600)]">
            {{ $icon }}
        </div>
    @endisset

    <div class="space-y-1">
        @isset($title)
            <h3 class="{{ $titleClass }}">{{ $title }}</h3>
        @endisset

        @isset($subtitle)
            <p class="{{ $subtitleClass }}">{{ $subtitle }}</p>
        @endisset
    </div>

    <div class="flex-1 min-w-0">
        {{ $slot }}
    </div>
</{{ $tag }}>
