@props([
    'title'        => 'Jelajahi Waduk Manduk',
    'subtitle'     => 'Destinasi wisata alam yang memadukan panorama waduk, kuliner tradisional, dan fasilitas keluarga.',
    'eyebrow'      => 'Destinasi Wisata Unggulan',
    'ctaPrimary'   => null,   // ['href' => '#', 'label' => 'Kunjungi Sekarang']
    'ctaSecondary' => null,   // ['href' => '#', 'label' => 'Pelajari Lebih Lanjut']
    'image'        => Vite::asset('resources/images/hero-illustration.svg'),
    'stats'        => [],     // [['label'=>'Pengunjung/bln','value'=>'5.962'], ...]
])

<section class="-mx-4 sm:-mx-6 lg:-mx-8" aria-labelledby="hero-title">
  <div class="relative overflow-hidden">
    {{-- Background lembut ala Figma --}}
    <div class="absolute inset-0 -z-10">
      <div class="h-full w-full bg-[var(--color-bg)]">
        <div class="absolute -top-24 -left-24 h-80 w-80 rounded-full opacity-30 blur-3xl"
             style="background: radial-gradient(closest-side, var(--color-primary-100), transparent)"></div>
        <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full opacity-40 blur-3xl"
             style="background: radial-gradient(closest-side, #e2e8f0, transparent)"></div>
      </div>
    </div>

    <div class="container-app py-14 sm:py-16 lg:py-20">
      <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
        {{-- Kiri: Teks --}}
        <div class="max-w-2xl">
          @if ($eyebrow)
            <span class="inline-flex items-center gap-2 rounded-full bg-[var(--color-primary-100)] px-3 py-1 text-xs font-semibold uppercase tracking-wide text-[var(--color-primary-600)]">
              {{ $eyebrow }}
            </span>
          @endif>

          <h1 id="hero-title"
              class="mt-4 text-balance font-serif text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tight text-[var(--color-bg)]">
            {{ $title }}
          </h1>

          @if ($subtitle)
            <p class="mt-3 text-lg sm:text-xl leading-7 text-[var(--color-bg)]">
              {{ $subtitle }}
            </p>
          @endif

          <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:gap-4">
            @if ($ctaPrimary)
              <a href="{{ $ctaPrimary['href'] ?? '#' }}" class="btn-primary">
                {{ $ctaPrimary['label'] ?? 'Kunjungi Sekarang' }}
              </a>
            @endif
            @if ($ctaSecondary)
              <a href="{{ $ctaSecondary['href'] ?? '#' }}" class="btn-ghost">
                {{ $ctaSecondary['label'] ?? 'Pelajari Lebih Lanjut' }}
              </a>
            @endif
          </div>

          @if ($stats)
            <dl class="mt-8 grid gap-6 sm:grid-cols-3">
              @foreach ($stats as $stat)
                <div>
                  <dt class="text-xs font-semibold uppercase tracking-wide text-[var(--color-muted)]">
                    {{ $stat['label'] ?? '' }}
                  </dt>
                  <dd class="mt-1 text-2xl font-semibold text-[var(--color-ink)]">
                    {{ $stat['value'] ?? '' }}
                  </dd>
                </div>
              @endforeach
            </dl>
          @endif
        </div>

        {{-- Kanan: Ilustrasi/Foto --}}
        <div class="relative">
          <div class="relative aspect-[4/3] w-full overflow-hidden rounded-[20px] card p-0">
            <img src="{{ $image }}" alt="Panorama Waduk Manduk" class="absolute inset-0 h-full w-full object-cover" loading="lazy">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
