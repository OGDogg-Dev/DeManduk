@props([
    'title'      => 'Mengapa harus ke Waduk Manduk',
    'subtitle'   => 'Wisata alam yang memadukan ketenangan waduk, kuliner lokal, serta ruang aktivitas komunal.',
    'paragraphs' => [],
    'image'      => null,
    'ctaLabel'   => 'Baca sejarah lengkap →',
    'ctaUrl'     => route('profile'),
])

@php($imageUrl = $image ?? Vite::asset('resources/images/gallery/gallery-6.svg'))

<x-section id="about" :title="$title" :subtitle="$subtitle">
  <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
    {{-- Deskripsi --}}
    <div class="card p-6 sm:p-8 space-y-5">
      @forelse($paragraphs as $paragraph)
        <p class="text-[15px] leading-7 text-[var(--color-muted)]">{{ $paragraph }}</p>
      @empty
        <p class="text-[15px] leading-7 text-[var(--color-muted)]">
          Waduk Manduk dikenal sebagai destinasi wisata air yang bersih dan ramah keluarga. Pengunjung dapat menikmati
          panorama senja, berperahu santai, hingga mengikuti agenda komunitas yang rutin digelar di amphitheater.
        </p>
      @endforelse

      <a href="{{ $ctaUrl }}" class="inline-flex items-center gap-2 text-[var(--color-primary)] font-medium hover:underline">
        {{ $ctaLabel }}
      </a>
    </div>

    {{-- Gambar --}}
    <div class="relative">
      <figure class="overflow-hidden rounded-[20px] ring-subtle">
        <img
          src="{{ $imageUrl }}"
          alt="Panorama Waduk Manduk"
          class="h-full w-full object-cover"
          loading="lazy"
        >
      </figure>
    </div>
  </div>
</x-section>
