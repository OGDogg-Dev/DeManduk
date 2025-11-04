@props([
  'mapsUrl',
  'title'         => 'Peta Interaktif',
  'linkLabel'     => 'Buka di Google Maps',
  'directionsUrl' => null, // opsional, kalau null pakai openUrl
])

@php
  // Ubah embed → halaman Maps biasa (hapus output=embed)
  $openUrl = preg_replace('/(&|\?)output=embed\b/', '$1', $mapsUrl ?? '') ?: 'https://maps.app.goo.gl/';
  $gotoUrl = $directionsUrl ?: $openUrl;
@endphp

<div class="card p-0 overflow-hidden">
  <div class="relative aspect-[16/9] w-full bg-slate-100">
    <iframe
      src="{{ $mapsUrl }}"
      title="{{ $title }} — peta lokasi"
      aria-label="{{ $title }}"
      loading="lazy"
      allowfullscreen
      referrerpolicy="no-referrer-when-downgrade"
      class="absolute inset-0 h-full w-full"
      style="border:0"
    ></iframe>
    <noscript>
      <div class="absolute inset-0 grid place-content-center bg-white text-sm text-slate-600 p-4">
        <p>Aktifkan JavaScript untuk melihat peta. <a href="{{ $openUrl }}" target="_blank" rel="noopener" class="underline">Buka di Google Maps</a></p>
      </div>
    </noscript>
  </div>

  <div class="flex flex-col gap-3 border-t border-[var(--color-border)] p-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-[var(--color-muted)]">
      Tip: Cubit/zoom untuk memperbesar, atau buka rute di aplikasi Google Maps.
    </p>
    <div class="flex flex-wrap gap-3">
      <a href="{{ $gotoUrl }}" target="_blank" rel="noopener" class="btn-primary rounded-full px-5 py-2.5">
        Rute ke Lokasi
      </a>
      <a href="{{ $openUrl }}" target="_blank" rel="noopener" class="btn-ghost rounded-full px-5 py-2.5">
        {{ $linkLabel }}
      </a>
    </div>
  </div>
</div>
