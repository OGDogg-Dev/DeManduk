@props([
    'stats'      => [],
    'procedures' => [],
    'title'      => 'Statistik & Prosedur Operasional',
    'subtitle'   => 'Data kunjungan terbaru dan poin utama standar operasional Waduk Manduk.',
])

<x-section id="statistik" variant="muted" :title="$title" :subtitle="$subtitle">
  <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
    {{-- Stats --}}
    <div class="grid gap-6 sm:grid-cols-2">
      @foreach ($stats as $stat)
        <article class="card ring-subtle p-6 text-center">
          <p
            class="text-3xl font-semibold text-[var(--color-ink)]"
            data-counter
            data-counter-to="{{ preg_replace('/\D/', '', $stat['value'] ?? '') }}"
            aria-label="{{ $stat['value'] ?? '' }}"
          >0</p>
          <p class="mt-2 text-sm text-[var(--color-muted)]">{{ $stat['label'] ?? '' }}</p>
        </article>
      @endforeach
    </div>

    {{-- Procedures --}}
    <div class="space-y-4">
      @foreach ($procedures as $item)
        <article class="card ring-subtle p-6">
          <h3 class="text-base font-semibold text-[var(--color-ink)]">{{ $item['title'] ?? '' }}</h3>
          <p class="mt-2 text-sm text-[var(--color-muted)]">{{ $item['description'] ?? '' }}</p>
        </article>
      @endforeach
    </div>
  </div>
</x-section>

@once
@push('scripts')
<script>
(() => {
  const els = Array.from(document.querySelectorAll('[data-counter]'));
  if (!els.length) return;

  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  const formatID = (n) => n.toLocaleString('id-ID');

  const animate = (el) => {
    const to = Number(el.getAttribute('data-counter-to') || '0');
    if (!to) { el.textContent = '0'; return; }
    if (prefersReduced.matches) { el.textContent = formatID(to); return; }

    const duration = 1200;
    const start = performance.now();
    const from = 0;

    const step = (now) => {
      const t = Math.min(1, (now - start) / duration);
      const eased = 1 - Math.pow(1 - t, 3); // easeOutCubic
      const val = Math.floor(from + (to - from) * eased);
      el.textContent = formatID(val);
      if (t < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  };

  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting && e.intersectionRatio > 0.4) {
        animate(e.target);
        io.unobserve(e.target);
      }
    });
  }, { threshold: [0.4] });

  els.forEach((el) => io.observe(el));
})();
</script>
@endpush
@endonce
