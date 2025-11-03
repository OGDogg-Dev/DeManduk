@props([
    'title' => 'Mengapa harus ke Waduk Manduk',
    'subtitle' => 'Wisata alam yang memadukan ketenangan waduk, kuliner lokal, serta ruang aktivitas komunal.',
    'paragraphs' => [],
    'image' => null,
    'ctaLabel' => 'Baca sejarah lengkap ->',
    'ctaUrl' => route('profile'),
])

<x-section id="about" :title="$title" :subtitle="$subtitle" class="bg-transparent">
    <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
        <div class="glass-card rounded-3xl p-8 shadow-xl space-y-5 text-slate-100">
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
                class="inline-flex items-center gap-2 text-sm font-semibold text-amber-400 transition hover:text-amber-300"
            >
                {{ $ctaLabel }}
            </a>
        </div>
        <div class="relative">
            <div class="aspect-square overflow-hidden rounded-3xl border border-white/15 shadow-[0_28px_70px_-30px_rgba(9,21,50,0.8)]">
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
