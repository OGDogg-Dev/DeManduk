@props([
    'title'    => 'Belum ada artikel',
    'message'  => 'Konten blog akan segera tersedia. Sementara itu, pantau halaman agenda untuk informasi terbaru seputar aktivitas Waduk Manduk.',
    'icon'     => null,         // optional: SVG/emoji
    'ctaHref'  => null,         // optional: URL tombol
    'ctaLabel' => 'Lihat agenda', // optional: label tombol
    'dashed'   => false,        // optional: pakai border dashed (true/false)
])

@php
  $wrap = 'card p-10 text-center';
  $border = $dashed ? 'border border-dashed border-[var(--color-border)]' : '';
@endphp

<div {{ $attributes->merge(['class' => "$wrap $border"]) }} role="status" aria-live="polite">
  {{-- Icon / Badge --}}
  <div class="mx-auto mb-3 inline-grid size-12 place-content-center rounded-2xl bg-slate-100 text-slate-600">
    @if ($icon)
      <span aria-hidden="true" class="text-lg">{!! $icon !!}</span>
    @else
      <span aria-hidden="true" class="text-lg font-semibold">N/A</span>
    @endif
  </div>

  {{-- Title --}}
  <h3 class="text-xl font-semibold text-[var(--color-ink)]">
    {{ $title }}
  </h3>

  {{-- Message --}}
  <p class="mx-auto mt-2 max-w-md text-sm leading-7 text-[var(--color-muted)]">
    {{ $message }}
  </p>

  {{-- Extra content slot (opsional) --}}
  @if (trim($slot))
    <div class="mt-3 text-sm text-[var(--color-muted)]">
      {{ $slot }}
    </div>
  @endif

  {{-- CTA (opsional) --}}
  @if ($ctaHref)
    <div class="mt-5">
      <a href="{{ $ctaHref }}" class="btn-primary rounded-full px-5 py-2.5">
        {{ $ctaLabel }}
      </a>
    </div>
  @endif
</div>
