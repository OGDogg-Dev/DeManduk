@props([
    'title' => null,
    'subtitle' => null,
    'id' => null,
    'variant' => 'default',
    'align' => 'center',
])

@php
    $background = [
        'default' => 'bg-transparent text-slate-100',
        'muted' => 'bg-[#081d3c] text-slate-100',
        'accent' => 'bg-[#0f305d] text-slate-100',
        'dark' => 'bg-[#010d22] text-white',
    ][$variant] ?? 'bg-transparent text-slate-100';

    $textAlignment = [
        'start' => 'text-left',
        'center' => 'text-center',
        'end' => 'text-right',
    ][$align] ?? 'text-center';
@endphp

<section @if ($id) id="{{ $id }}" @endif {{ $attributes->class(["py-16 sm:py-20 {$background}"]) }}>
    <div class="mx-auto flex max-w-6xl flex-col gap-12 px-4 sm:px-6 lg:px-8">
        @if ($title || $subtitle)
            <div class="{{ $textAlignment }} space-y-4">
                @if ($title)
                    <h2
                        @class([
                            'text-3xl font-semibold tracking-tight drop-shadow-sm font-serif text-white',
                            'text-white drop-shadow-none' => true,
                        ])
                    >
                        {{ $title }}
                    </h2>
                @endif
                @if ($subtitle)
                    <p
                        @class([
                            'text-base text-slate-200',
                        ])
                    >
                        {{ $subtitle }}
                    </p>
                @endif
            </div>
        @endif
        <div class="space-y-8">
            {{ $slot }}
        </div>
    </div>
</section>
