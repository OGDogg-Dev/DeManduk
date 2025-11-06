@props(['features' => []])

<x-section
  id="service"
  title="Fasilitas yang tersedia"
  subtitle="Pelayanan lengkap untuk mendukung kenyamanan dan keamanan wisata."
>
  <div class="grid grid-cols-1 gap-4 sm:gap-5 md:gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($features as $feature)
      <article class="card ring-subtle p-5 sm:p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
        @if (!empty($feature['icon']))
          <div class="mb-3 inline-flex size-10 items-center justify-center rounded-xl bg-[var(--color-primary-100)] text-[var(--color-primary-600)]">
            {!! $feature['icon'] !!}
          </div>
        @endif

        <h3 class="text-lg font-semibold text-[var(--color-ink)]">
          {{ $feature['title'] }}
        </h3>
        <p class="mt-2 text-sm leading-relaxed text-[var(--color-muted)]">
          {{ $feature['description'] }}
        </p>
      </article>
    @endforeach
  </div>
</x-section>
