@props([
    'mapsUrl' => 'https://maps.google.com/maps?q=Waduk%20Manduk&t=&z=15&ie=UTF8&iwloc=&output=embed',
    'title' => 'Peta Lokasi Waduk Manduk',
    'linkLabel' => 'Buka di Google Maps',
    'directionsUrl' => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
])

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="aspect-video bg-slate-200">
        <iframe
            src="{{ $mapsUrl }}"
            title="{{ $title }}"
            loading="lazy"
            class="h-full w-full border-0"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
    <div class="flex flex-col gap-3 p-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">{{ $title }}</h3>
            <p class="text-sm text-slate-600">
                Gunakan tombol berikut jika embed tidak muncul atau untuk membuka rute langsung di aplikasi Maps.
            </p>
        </div>
        <a
            href="{{ $directionsUrl }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
        >
            <span aria-hidden="true">[map]</span>
            {{ $linkLabel }}
        </a>
    </div>
</div>
