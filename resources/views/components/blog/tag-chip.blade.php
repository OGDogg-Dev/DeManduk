@props([
    'label',
    'href'      => '#',
    'active'    => false,
    'size'      => 'sm',   // xs | sm | md
    'showHash'  => true,   // tampilkan tanda '#'
    'count'     => null,   // optional badge jumlah (angka)
])

@php
  $sizes = [
    'xs' => 'px-2.5 py-1 text-[10px]',
    'sm' => 'px-3 py-1.5 text-[11px]',
    'md' => 'px-3.5 py-2 text-xs',
  ];
  $sizeClass = $sizes[$size] ?? $sizes['sm'];

  $base = "inline-flex items-center gap-1 rounded-full border transition
           focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300
           focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)] $sizeClass";

  $on  = "bg-[var(--color-primary)] border-[var(--color-primary)] text-white";
  $off = "bg-white border-[var(--color-border)] text-[var(--color-ink)] hover:bg-slate-100";
@endphp

<a
  href="{{ $href }}"
  {{ $attributes->merge(['class' => $base.' '.($active ? $on : $off)]) }}
  {{ $active ? 'aria-current=page' : '' }}
>
  @if ($showHash)
    <span aria-hidden="true">#</span>
  @endif
  <span class="font-medium">{{ $label }}</span>

  @if (!is_null($count))
    <span class="ml-1 rounded-full bg-black/5 px-1.5 text-[10px] leading-none">
      {{ $count }}
    </span>
  @endif
</a>
