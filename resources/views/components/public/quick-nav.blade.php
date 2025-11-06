@props(['sections' => []])

<nav
  aria-label="Navigasi bagian halaman"
  class="sticky top-[calc(var(--header-h,64px)+8px)] z-30 border-y border-[var(--color-border)] bg-[var(--color-bg)]/80 backdrop-blur supports-[backdrop-filter]:bg-[var(--color-bg)]/70"
>
  <div class="container-responsive">
    <ul
      class="-mx-1 sm:-mx-2 flex gap-1 sm:gap-2 overflow-x-auto py-2 sm:py-3 [scrollbar-width:none] min-h-[52px]"
      data-scrollspy
    >
      <style>
        /* sembunyikan scrollbar (webkit) */
        [data-scrollspy]::-webkit-scrollbar{display:none}
      </style>

      @foreach ($sections as $section)
        @php([$href, $label] = $section)
        <li class="px-1 sm:px-2">
          <a
            href="{{ $href }}"
            class="nav-pill py-2 px-3 sm:px-4 text-xs sm:text-sm uppercase tracking-[0.25em] data-[active=true]:nav-pill--active touch-target-sm min-w-max"
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
  const ready = (fn) => {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', fn, { once: true });
    } else {
      fn();
    }
  };

  const initScrollSpy = (list) => {
    const nav = list.closest('nav');
    const links = Array.from(list.querySelectorAll('[data-spy-link]'));
    if (!links.length) return;

    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)');

    const resolveTargets = () => links
      .map((link) => link.getAttribute('data-spy-link') || link.getAttribute('href') || '')
      .filter((hash) => hash.startsWith('#'))
      .map((hash) => {
        const target = document.querySelector(hash);
        return target ? { hash, el: target } : null;
      })
      .filter(Boolean);

    let targets = resolveTargets();

    const computeHeaderHeight = () => {
      const raw = getComputedStyle(document.documentElement).getPropertyValue('--header-h');
      const parsed = parseInt(raw, 10);
      if (Number.isFinite(parsed) && parsed > 0) {
        return parsed;
      }
      const header = document.querySelector('[data-header]');
      return header ? Math.round(header.getBoundingClientRect().height) : 64;
    };

    const computeOffset = () => {
      const headerH = computeHeaderHeight();
      const navH = nav ? Math.round(nav.getBoundingClientRect().height) : Math.round(list.getBoundingClientRect().height);
      return headerH + navH + 12;
    };

    const setActive = (hash, center = false) => {
      if (!hash) return;
      links.forEach((link) => {
        const isActive = link.getAttribute('data-spy-link') === hash;
        link.setAttribute('data-active', String(isActive));
        link.toggleAttribute('aria-current', isActive);
        if (isActive && center) {
          link.scrollIntoView({
            inline: 'center',
            block: 'nearest',
            behavior: prefersReduced.matches ? 'auto' : 'smooth',
          });
        }
      });
    };

    const scrollToHash = (hash) => {
      const target = targets.find((entry) => entry.hash === hash);
      if (!target) return false;

      const offset = computeOffset();
      const destination = target.el.getBoundingClientRect().top + window.pageYOffset - offset;
      window.scrollTo({
        top: destination,
        behavior: prefersReduced.matches ? 'auto' : 'smooth',
      });
      return true;
    };

    links.forEach((link) => {
      link.addEventListener('click', (event) => {
        const hash = link.getAttribute('data-spy-link') || link.getAttribute('href') || '';
        if (!hash.startsWith('#')) return;

        targets = resolveTargets();
        if (scrollToHash(hash)) {
          event.preventDefault();
          setActive(hash, true);
        }
      });
    });

    let ticking = false;

    const updateActive = () => {
      targets = resolveTargets();
      const offset = computeOffset();
      let currentHash = targets.length ? targets[0].hash : '';

      for (const entry of targets) {
        const distance = entry.el.getBoundingClientRect().top - offset;
        if (distance <= 0) {
          currentHash = entry.hash;
        } else {
          break;
        }
      }

      setActive(currentHash);
      ticking = false;
    };

    const handleScroll = () => {
      if (!ticking) {
        ticking = true;
        requestAnimationFrame(updateActive);
      }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    window.addEventListener('resize', updateActive, { passive: true });

    updateActive();
  };

  ready(() => {
    document.querySelectorAll('[data-scrollspy]').forEach(initScrollSpy);
  });
})();
</script>
@endpush
@endonce
