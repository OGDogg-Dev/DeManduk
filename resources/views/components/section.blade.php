@props([
    'title'    => null,
    'subtitle' => null,
    'id'       => null,
    'variant'  => 'default', // default|muted|accent|dark
    'align'    => 'center',  // start|center|end
])

@php
    // Background & warna teks mengikuti design tokens (app.css)
    $bg = [
        'default' => 'bg-transparent',
        'muted'   => 'bg-slate-50',
        'accent'  => 'bg-[var(--color-primary-100)]',
        'dark'    => 'bg-slate-900', // sengaja gelap untuk kontras yang baik lintas tema
    ][$variant] ?? 'bg-transparent';

    $headingColor = [
        'default' => 'text-[var(--color-ink)]',
        'muted'   => 'text-[var(--color-ink)]',
        'accent'  => 'text-[var(--color-ink)]',
        'dark'    => 'text-white',
    ][$variant] ?? 'text-[var(--color-ink)]';

    $subtitleColor = [
        'default' => 'text-[var(--color-muted)]',
        'muted'   => 'text-[var(--color-muted)]',
        'accent'  => 'text-[var(--color-muted)]',
        'dark'    => 'text-slate-300',
    ][$variant] ?? 'text-[var(--color-muted)]';

    $textAlignment = [
        'start'  => 'text-left',
        'center' => 'text-center',
        'end'    => 'text-right',
    ][$align] ?? 'text-center';

    $headingId = $id ? $id.'-title' : null;
@endphp

<section
  @if ($id) id="{{ $id }}" @endif
  aria-labelledby="{{ $headingId }}"
  {{ $attributes->class(["py-8 sm:py-12 md:py-16 $bg"]) }}
>
  <div class="container-app flex flex-col gap-6 sm:gap-8 md:gap-12">
    @if ($title || $subtitle)
      <div class="{{ $textAlignment }} space-y-2 sm:space-y-3">
        @if ($title)
          <h2 id="{{ $headingId }}" class="text-2xl sm:text-3xl md:text-4xl font-semibold tracking-tight {{ $headingColor }}">
            {{ $title }}
          </h2>
        @endif

        @if ($subtitle)
          <p class="text-sm sm:text-base md:text-[15px] leading-6 sm:leading-7 {{ $subtitleColor }}">
            {{ $subtitle }}
          </p>
        @endif
      </div>
    @endif

    <div class="space-y-4 sm:space-y-6 md:space-y-8">
      {{ $slot }}
    </div>
  </div>
</section>
