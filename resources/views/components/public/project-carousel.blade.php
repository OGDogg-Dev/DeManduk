@props(['projects' => []])

<x-section
  id="project"
  variant="muted"
  title="Agenda yang sedang berlangsung"
  subtitle="Event terbaru yang menambah keseruan kunjungan Anda."
>
  <div
    class="flex gap-4 overflow-x-auto pb-4 snap-x snap-mandatory [-ms-overflow-style:none] [scrollbar-width:none]"
    aria-label="Daftar agenda"
    role="group"
  >
    <style>
      /* sembunyikan scrollbar (webkit) */
      [aria-label="Daftar agenda"]::-webkit-scrollbar{display:none}
    </style>

    @foreach ($projects as $project)
      <article class="w-64 sm:w-72 md:w-80 flex-shrink-0 snap-center">
        <div class="card overflow-hidden ring-subtle transition hover:-translate-y-0.5 hover:shadow-lg h-full">
          @if (!empty($project['image']))
            <img
              src="{{ $project['image'] }}"
              alt="{{ $project['title'] ?? 'Poster agenda' }}"
              class="h-40 sm:h-44 md:h-48 w-full object-cover"
              loading="lazy"
            >
          @endif

          <div class="space-y-2 p-4 sm:p-5">
            <h3 class="text-base sm:text-lg font-semibold text-[var(--color-ink)]">
              {{ $project['title'] ?? 'Agenda' }}
            </h3>
            @if (!empty($project['date']))
              <p class="text-xs sm:text-sm uppercase tracking-wide text-[var(--color-muted)]">
                {{ $project['date'] }}
              </p>
            @endif
            <p class="text-sm leading-relaxed text-[var(--color-muted)]">
              {{ $project['description'] ?? '' }}
            </p>

            @if (!empty($project['href']))
              <div class="pt-1">
                <a href="{{ $project['href'] }}" class="text-sm font-medium text-[var(--color-primary)] hover:underline">
                  Detail acara →
                </a>
              </div>
            @endif
          </div>
        </div>
      </article>
    @endforeach
  </div>
</x-section>
