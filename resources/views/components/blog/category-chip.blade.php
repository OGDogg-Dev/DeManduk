@props([
    'label',
    'href'   => '#',
    'active' => false,
    'size'   => 'sm',   // xs | sm | md
    'icon'   => null,   // optional SVG/emoji
])

@php
  $sizes = [
    'xs' => 'px-2.5 py-1 text-[10px]',
    'sm' => 'px-3.5 py-1.5 text-[11px]',
    'md' => 'px-4 py-2 text-xs',
  ];
  $sizeClass = $sizes[$size] ?? $sizes['sm'];

  $base = "inline-flex items-center gap-2 rounded-full border transition
           focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300
           focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)] $sizeClass";

  $on   = "bg-[var(--color-primary)] border-[var(--color-primary)] text-white";
  $off  = "bg-white border-[var(--color-border)] text-[var(--color-ink)] hover:bg-slate-100";
@endphp

<a
  href="{{ $href }}"
  {{ $attributes->merge(['class' => $base.' '.($active ? $on : $off)]) }}
  {{ $active ? 'aria-current=page' : '' }}
>
  @if ($icon)
    <span class="inline-grid size-3.5 place-content-center" aria-hidden="true">{!! $icon !!}</span>
  @endif
  <span class="uppercase tracking-[0.25em]">{{ $label }}</span>
</a>
