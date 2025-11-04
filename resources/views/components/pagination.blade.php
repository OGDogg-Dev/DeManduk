@props([
    'links' => [],   // [['href' => '...', 'label' => '1', 'active' => true], ...] ; gunakan null/'' utk ellipsis
    'prev'  => null, // ['href' => '...', 'label' => 'Sebelumnya']
    'next'  => null, // ['href' => '...', 'label' => 'Berikutnya']
])

@if ($links)
<nav class="flex items-center justify-between gap-4 text-sm" aria-label="Pagination">
  {{-- Prev --}}
  <div class="flex-1">
    @if ($prev && !empty($prev['href']))
      <a
        href="{{ $prev['href'] }}"
        rel="prev"
        class="inline-flex items-center gap-2 rounded-xl border border-[var(--color-border)] bg-white px-4 py-2 font-medium text-[var(--color-ink)] transition hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
      >
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
        <span class="hidden sm:inline">{{ $prev['label'] ?? 'Sebelumnya' }}</span>
        <span class="sr-only">Halaman sebelumnya</span>
      </a>
    @else
      <span
        aria-disabled="true"
        class="inline-flex cursor-not-allowed items-center gap-2 rounded-xl border border-[var(--color-border)] bg-white px-4 py-2 font-medium text-slate-400"
      >
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
        <span class="hidden sm:inline">{{ $prev['label'] ?? 'Sebelumnya' }}</span>
      </span>
    @endif
  </div>

  {{-- Numbered pages --}}
  <ul class="flex items-center gap-1">
    @foreach ($links as $link)
      @php
        $isActive = (bool)($link['active'] ?? false);
        $hasHref  = !empty($link['href'] ?? null);
      @endphp

      <li>
        @if ($hasHref)
          <a
            href="{{ $link['href'] }}"
            @class([
              'inline-flex size-10 items-center justify-center rounded-lg border text-[var(--color-ink)] transition focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]',
              'bg-[var(--color-primary)] border-[var(--color-primary)] text-white shadow' => $isActive,
              'bg-white border-[var(--color-border)] hover:bg-slate-100' => ! $isActive,
            ])
            {{ $isActive ? 'aria-current=page' : '' }}
          >
            {{ $link['label'] ?? '' }}
          </a>
        @else
          {{-- Ellipsis / separator --}}
          <span class="inline-flex size-10 items-center justify-center rounded-lg text-slate-400 select-none" aria-hidden="true">…</span>
        @endif
      </li>
    @endforeach
  </ul>

  {{-- Next --}}
  <div class="flex-1 text-right">
    @if ($next && !empty($next['href']))
      <a
        href="{{ $next['href'] }}"
        rel="next"
        class="inline-flex items-center gap-2 rounded-xl border border-[var(--color-border)] bg-white px-4 py-2 font-medium text-[var(--color-ink)] transition hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
      >
        <span class="hidden sm:inline">{{ $next['label'] ?? 'Berikutnya' }}</span>
        <span class="sr-only">Halaman berikutnya</span>
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      </a>
    @else
      <span
        aria-disabled="true"
        class="inline-flex cursor-not-allowed items-center gap-2 rounded-xl border border-[var(--color-border)] bg-white px-4 py-2 font-medium text-slate-400"
      >
        <span class="hidden sm:inline">{{ $next['label'] ?? 'Berikutnya' }}</span>
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      </span>
    @endif
  </div>
</nav>
@endif
