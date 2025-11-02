@props([
    'title' => 'Mengapa harus ke Waduk Manduk',
    'subtitle' => 'Wisata alam yang memadukan ketenangan waduk, kuliner lokal, serta ruang aktivitas komunal.',
    'paragraphs' => [],
    'image' => null,
    'ctaLabel' => 'Baca sejarah lengkap ->',
    'ctaUrl' => route('profile'),
])

<x-section id="about" :title="$title" :subtitle="$subtitle">
    <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
        <div class="space-y-5 text-slate-700">
            @forelse($paragraphs as $paragraph)
                <p>{{ $paragraph }}</p>
            @empty
                <p>
                    Waduk Manduk dikenal sebagai destinasi wisata air yang bersih dan ramah keluarga. Pengunjung dapat menikmati
                    panorama senja, berperahu santai, hingga mengikuti agenda komunitas yang rutin digelar di amphitheater.
                </p>
            @endforelse

            <a
                href="{{ $ctaUrl }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 transition hover:text-blue-700"
            >
                {{ $ctaLabel }}
            </a>
        </div>
        <div class="relative">
            <div class="aspect-square overflow-hidden rounded-3xl border border-slate-200 shadow-xl">
                @php($imageUrl = $image ?? Vite::asset('resources/images/gallery/gallery-6.svg'))
                <img
                    src="{{ $imageUrl }}"
                    alt="Panorama Waduk Manduk"
                    class="h-full w-full object-cover"
                    loading="lazy"
                >
            </div>
        </div>
    </div>
</x-section>
