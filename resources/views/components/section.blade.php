@props([
    'title' => null,
    'subtitle' => null,
    'id' => null,
    'variant' => 'default',
    'align' => 'center',
])

@php
    $background = [
        'default' => 'bg-white',
        'muted' => 'bg-slate-100',
        'accent' => 'bg-blue-50',
        'dark' => 'bg-slate-900 text-white',
    ][$variant] ?? 'bg-white';

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
                            'text-3xl font-bold tracking-tight drop-shadow-sm',
                            'text-slate-900' => $variant !== 'dark',
                            'text-white drop-shadow-none' => $variant === 'dark',
                        ])
                    >
                        {{ $title }}
                    </h2>
                @endif
                @if ($subtitle)
                    <p
                        @class([
                            'text-base',
                            'text-slate-600' => $variant !== 'dark',
                            'text-slate-200' => $variant === 'dark',
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
