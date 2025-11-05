@props([
    'title' => null,
    'variant' => 'info',
])

@php
    $styles = [
        'info' => ['bg' => 'bg-white/5', 'border' => 'border-white/20', 'text' => 'text-black', 'icon' => 'ℹ'],
        'success' => ['bg' => 'bg-emerald-500/10', 'border' => 'border-emerald-300/40', 'text' => 'text-black', 'icon' => '✔'],
        'warning' => ['bg' => 'bg-amber-500/10', 'border' => 'border-amber-300/50', 'text' => 'text-black', 'icon' => '⚠'],
        'danger' => ['bg' => 'bg-rose-500/10', 'border' => 'border-rose-300/40', 'text' => 'text-black', 'icon' => '✕'],
    ];

    $selected = $styles[$variant] ?? $styles['info'];
@endphp

<div {{ $attributes->class([
    "glass-card flex gap-3 rounded-2xl border p-5 text-sm {$selected['bg']} {$selected['border']} {$selected['text']}",
]) }}>
    <span class="text-base font-semibold leading-none" aria-hidden="true">{{ $selected['icon'] }}</span>
    <div class="space-y-1">
        @if ($title)
            <p class="font-semibold">{{ $title }}</p>
        @endif
        <div class="text-sm leading-relaxed">
            {{ $slot }}
        </div>
    </div>
</div>
