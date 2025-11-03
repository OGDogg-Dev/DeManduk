@props([
    'mapsUrl' => 'https://maps.google.com/maps?q=Waduk%20Manduk&t=&z=15&ie=UTF8&iwloc=&output=embed',
    'title' => 'Peta Lokasi Waduk Manduk',
    'linkLabel' => 'Buka di Google Maps',
    'directionsUrl' => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
])

<div class="glass-card overflow-hidden rounded-2xl">
    <div class="aspect-video bg-[#051938]">
        <iframe
            src="{{ $mapsUrl }}"
            title="{{ $title }}"
            loading="lazy"
            class="h-full w-full border-0"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
    <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300">{{ $title }}</h3>
            <p class="text-sm text-slate-200">
                Gunakan tombol berikut jika embed tidak muncul atau untuk membuka rute langsung di aplikasi Maps.
            </p>
        </div>
        <a
            href="{{ $directionsUrl }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-full bg-amber-400 px-5 py-2 text-sm font-semibold uppercase tracking-[0.2em] text-[#021024] transition hover:bg-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-200 focus-visible:ring-offset-2 focus-visible:ring-offset-[#020f24]"
        >
            <span aria-hidden="true">🧭</span>
            {{ $linkLabel }}
        </a>
    </div>
</div>
