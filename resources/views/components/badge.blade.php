@props([
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'bg-slate-100 text-slate-700 ring-slate-200',
        'success' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        'warning' => 'bg-amber-100 text-amber-800 ring-amber-200',
        'danger' => 'bg-rose-100 text-rose-700 ring-rose-200',
        'info' => 'bg-blue-100 text-blue-700 ring-blue-200',
    ];
@endphp

<span {{ $attributes->class([
    'inline-flex items-center gap-2 rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset',
    $variants[$variant] ?? $variants['default'],
]) }}>
    {{ $slot }}
</span>
