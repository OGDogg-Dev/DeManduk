@props([
    'title'      => 'Mengapa harus ke Waduk Manduk',
    'subtitle'   => 'Wisata alam yang memadukan ketenangan waduk, kuliner lokal, serta ruang aktivitas komunal.',
    'paragraphs' => [],
    'image'      => null,
    'ctaLabel'   => 'Baca sejarah lengkap',
    'ctaUrl'     => route('home') . '#about',
])

@php($imageUrl = $image ?? asset('images/gallery/gallery-6.svg'))

<x-section id="about" :title="$title" :subtitle="$subtitle">
  <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
    {{-- Deskripsi --}}
    <div class="card p-6 sm:p-8 space-y-5">
      @forelse($paragraphs as $paragraph)
        <p class="text-[15px] leading-7 text-[var(--color-muted)]">{{ $paragraph }}</p>
      @empty
        <p class="text-[15px] leading-7 text-[var(--color-muted)]">
          Waduk Manduk adalah bagian dari rencana pengembangan Waduk Gondang di Kabupaten Karanganyar, Jawa Tengah,
          yang bertujuan memperluas daya tampung air. Kawasan ini dikelola sebagai destinasi wisata dengan pemanfaatan
          teknologi digital, serta melibatkan BUMDes dan Komunitas Peduli Waduk (KPW) dalam pengelolaan dan pemberdayaan
          masyarakat lokal.
        </p>
      @endforelse

      {{--  <a href="{{ $ctaUrl }}" class="inline-flex items-center gap-2 text-[var(--color-primary)] font-medium hover:underline">
        {{ $ctaLabel }}
      </a> --}}
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
