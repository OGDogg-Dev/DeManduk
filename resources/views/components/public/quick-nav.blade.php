@props(['sections' => []])

<nav
  aria-label="Navigasi bagian halaman"
  class="sticky top-[calc(var(--header-h,64px)+8px)] z-30 border-y border-[var(--color-border)] bg-[var(--color-bg)]/80 backdrop-blur supports-[backdrop-filter]:bg-[var(--color-bg)]/70"
>
  <div class="container-app">
    <ul
      class="-mx-2 flex gap-2 overflow-x-auto py-3 [scrollbar-width:none]"
      data-scrollspy
    >
      <style>
        /* sembunyikan scrollbar (webkit) */
        [data-scrollspy]::-webkit-scrollbar{display:none}
      </style>

      @foreach ($sections as $section)
        @php([$href, $label] = $section)
        <li class="px-2">
          <a
            href="{{ $href }}"
            class="nav-pill text-xs uppercase tracking-[0.30em] data-[active=true]:nav-pill--active"
            data-spy-link="{{ $href }}"
          >
            {{ $label }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</nav>

@once
@push('scripts')
<script>
(() => {
  const list = document.querySelector('[data-scrollspy]');
  if (!list) return;

  const links = Array.from(list.querySelectorAll('[data-spy-link]'));
  const ids   = links
    .map(a => (a.getAttribute('data-spy-link') || '').trim())
    .filter(h => h.startsWith('#'))
    .map(h => h.slice(1));

  const targets = ids
    .map(id => document.getElementById(id))
    .filter(Boolean);

  const headerH = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-h')) || 64;
  const extraOffset = 8 + list.offsetHeight; // ruang di bawah header + tinggi quick-nav

  // Smooth scroll dengan offset header
  links.forEach(a => {
    a.addEventListener('click', (e) => {
      const href = a.getAttribute('href') || '';
      if (!href.startsWith('#')) return;
      const el = document.querySelector(href);
      if (!el) return;

      e.preventDefault();
      
      // Calculate the correct scroll position with proper offset
      const elementPosition = el.getBoundingClientRect().top + window.pageYOffset;
      const offsetPosition = elementPosition - headerH - 12; // padding kecil
      
      window.scrollTo({
        top: offsetPosition,
        behavior: (matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth')
      });

      // aktifkan state segera (UX responsif)
      setActive(href);
    });
  });

  // Scrollspy observer
  const io = new IntersectionObserver((entries) => {
    // Only activate the first intersecting element to avoid conflicts
    let activeEntry = null;
    for (const entry of entries) {
      if (entry.isIntersecting) {
        if (!activeEntry || entry.boundingClientRect.top < activeEntry.boundingClientRect.top) {
          activeEntry = entry;
        }
      }
    }
    
    if (activeEntry) {
      const id = '#' + (activeEntry.target.id || '');
      setActive(id);
    }
  }, {
    root: null,
    rootMargin: `-${headerH + extraOffset}px 0px -40% 0px`,
    threshold: [0.0, 0.2]
  });

  targets.forEach(t => io.observe(t));

  function setActive(hash){
    links.forEach(a => {
      const on = (a.getAttribute('data-spy-link') === hash);
      a.setAttribute('data-active', String(on));
      a.toggleAttribute('aria-current', on);
      if (on) {
        // pastikan item aktif tetap terlihat saat list di-scroll
        a.scrollIntoView({ inline: 'center', behavior: 'smooth', block: 'nearest' });
      }
    });
  }
})();
</script>
@endpush
@endonce
