@props([
    'variant'   => 'primary', // primary | ghost
    'threshold' => 280,       // px scroll sebelum tombol muncul
    'ariaLabel' => 'Kembali ke atas',
])

@php
  $variants = [
    'primary' => 'bg-[var(--color-primary)] text-white border-[var(--color-primary)] hover:bg-[var(--color-primary-600)]',
    'ghost'   => 'bg-white text-[var(--color-ink)] border-[var(--color-border)] hover:bg-slate-100',
  ];
  $style = $variants[$variant] ?? $variants['primary'];
@endphp

<button
  type="button"
  data-backtotop
  data-threshold="{{ $threshold }}"
  class="fixed bottom-5 right-5 z-40 hidden rounded-full border p-3 shadow-lg transition
         focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300
         focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]
         {{ $style }}"
  aria-label="{{ $ariaLabel }}"
  title="{{ $ariaLabel }}"
>
  {{-- Icon: chevron-up --}}
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5" aria-hidden="true">
    <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .53.22l4.25 4.25a.75.75 0 1 1-1.06 1.06L10.75 5.91v10.84a.75.75 0 0 1-1.5 0V5.91L6.28 8.53a.75.75 0 0 1-1.06-1.06l4.25-4.25A.75.75 0 0 1 10 3Z" clip-rule="evenodd"/>
  </svg>
  <span class="sr-only">{{ $ariaLabel }}</span>
</button>

@once
@push('scripts')
<script>
(() => {
  const btn = document.querySelector('[data-backtotop]');
  if (!btn) return;

  const threshold = Number(btn.getAttribute('data-threshold') || 280);

  const onScroll = () => {
    if (window.scrollY > threshold) {
      btn.classList.remove('hidden');
    } else {
      btn.classList.add('hidden');
    }
  };

  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  const toTop = () => {
    window.scrollTo({ top: 0, behavior: prefersReduced.matches ? 'auto' : 'smooth' });
  };

  onScroll();
  document.addEventListener('scroll', onScroll, { passive: true });
  btn.addEventListener('click', toTop);
})();
</script>
@endpush
@endonce
