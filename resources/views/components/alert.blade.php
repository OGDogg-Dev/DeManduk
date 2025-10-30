@props([
    'title' => null,
    'variant' => 'info',
])

@php
    $styles = [
        'info' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-200', 'text' => 'text-blue-800', 'icon' => '[i]'],
        'success' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'text' => 'text-emerald-800', 'icon' => '[ok]'],
        'warning' => ['bg' => 'bg-amber-50', 'border' => 'border-amber-200', 'text' => 'text-amber-800', 'icon' => '[!]'],
        'danger' => ['bg' => 'bg-rose-50', 'border' => 'border-rose-200', 'text' => 'text-rose-800', 'icon' => '[x]'],
    ];

    $selected = $styles[$variant] ?? $styles['info'];
@endphp

<div {{ $attributes->class([
    "flex gap-3 rounded-2xl border p-4 text-sm {$selected['bg']} {$selected['border']} {$selected['text']}",
]) }}>
    <span class="text-sm font-semibold leading-none" aria-hidden="true">{{ $selected['icon'] }}</span>
    <div class="space-y-1">
        @if ($title)
            <p class="font-semibold">{{ $title }}</p>
        @endif
        <div class="text-sm leading-relaxed">
            {{ $slot }}
        </div>
    </div>
</div>
