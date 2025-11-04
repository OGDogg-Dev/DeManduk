@props([
    'mapsUrl'       => 'https://maps.google.com/maps?q=Waduk%20Manduk&t=&z=15&ie=UTF8&iwloc=&output=embed',
    'title'         => 'Peta Lokasi Waduk Manduk',
    'linkLabel'     => 'Buka di Google Maps',
    'directionsUrl' => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
])

@php
    // Derivasi URL "buka di Google Maps" dari embed (hapus output=embed)
    $openUrl = preg_replace('/(&|\?)output=embed\b/', '$1', $mapsUrl) ?: $mapsUrl;
@endphp

<div class="card overflow-hidden">
    <div class="relative aspect-video bg-slate-100">
        <iframe
            src="{{ $mapsUrl }}"
            title="{{ $title }} — peta interaktif"
            aria-label="{{ $title }}"
            loading="lazy"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            class="absolute inset-0 h-full w-full border-0"
            style="border:0"
        ></iframe>
        <noscript>
            <div class="absolute inset-0 grid place-content-center bg-white p-4 text-sm text-slate-600">
                <p>Aktifkan JavaScript untuk melihat peta. <a href="{{ $openUrl }}" target="_blank" rel="noopener" class="underline">Buka di Google Maps</a></p>
            </div>
        </noscript>
    </div>

    <div class="flex flex-col gap-3 border-t border-[var(--color-border)] p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">{{ $title }}</h3>
            <p class="mt-1 text-sm text-[var(--color-muted)]">
                Jika embed tidak muncul, gunakan tombol di kanan untuk membuka rute atau halaman Google Maps.
            </p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a
                href="{{ $directionsUrl ?: $openUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="btn-primary rounded-full px-5 py-2.5"
            >
                Rute ke Lokasi
            </a>
            <a
                href="{{ $openUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="btn-ghost rounded-full px-5 py-2.5"
            >
                {{ $linkLabel }}
            </a>
        </div>
    </div>
</div>
