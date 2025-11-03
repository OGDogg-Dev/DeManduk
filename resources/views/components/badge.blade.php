@props([
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'bg-white/10 text-slate-200 ring-white/20',
        'success' => 'bg-emerald-400/20 text-emerald-200 ring-emerald-300/40',
        'warning' => 'bg-amber-400/20 text-amber-200 ring-amber-300/40',
        'danger' => 'bg-rose-400/20 text-rose-200 ring-rose-300/40',
        'info' => 'bg-blue-400/20 text-blue-200 ring-blue-300/40',
    ];
@endphp

<span {{ $attributes->class([
    'inline-flex items-center gap-2 rounded-full px-2.5 py-1 text-xs font-semibold uppercase tracking-[0.2em] ring-1 ring-inset',
    $variants[$variant] ?? $variants['default'],
]) }}>
    {{ $slot }}
</span>
