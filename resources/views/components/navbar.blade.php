@php
  $navItems = [
      ['label' => 'Beranda', 'route' => 'home'],
      ['label' => 'Galeri',  'route' => 'galeri'],
      ['label' => 'Event',   'route' => 'event.index', 'active' => ['event.*']],
      ['label' => 'Berita',  'route' => 'news.index',  'active' => ['news.*']],
      ['label' => 'Kontak',  'route' => 'kontak'],
      ['label' => 'QRIS',    'route' => 'qris'],
  ];

  $brandTitle    = $siteTitle ?? "D'Manduk";
  $brandLogo     = \App\Support\Media::url($siteLogoPath ?? null);
  $brandInitials = strtoupper(mb_substr($brandTitle, 0, 2));

  $isActive = function(array $item) {
      $patterns = array_merge([$item['route']], $item['active'] ?? [], [$item['route'].'.*']);
      foreach ($patterns as $p) if (request()->routeIs($p)) return true;
      return false;
  };
@endphp

<header
  data-header
  class="fixed inset-x-0 top-0 z-40 border-b border-[var(--color-border)] bg-[var(--color-bg)]/80 backdrop-blur"
>
  <nav class="container-app flex items-center justify-between gap-6 py-4 lg:justify-start" aria-label="Navigasi utama">
    {{-- Brand --}}
    <a href="{{ route('home') }}" class="group flex items-center gap-3 min-w-0">
      @if ($brandLogo)
        <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}" class="h-10 w-10 rounded-xl object-cover ring-subtle">
      @else
        <span class="grid h-10 w-10 place-content-center rounded-xl bg-slate-200 text-slate-800 ring-subtle font-semibold">
          {{ $brandInitials }}
        </span>
      @endif
      <div class="flex flex-col leading-tight text-left min-w-0">
        <span class="hidden sm:inline text-[11px] font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">Portal Resmi</span>
        <span class="text-sm sm:text-base font-semibold text-[var(--color-ink)] truncate">{{ $brandTitle }}</span>
      </div>
    </a>

    {{-- Mobile toggle --}}
    <button
      type="button"
      class="ml-auto inline-flex items-center justify-center rounded-lg border border-[var(--color-border)] px-2 py-2 text-[var(--color-ink)] hover:bg-white lg:hidden"
      data-nav-toggle
      aria-expanded="false"
      aria-controls="primary-navigation"
      aria-label="Buka navigasi"
    >
      <svg class="h-6 w-6 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    {{-- Desktop menu --}}
    <div class="hidden lg:block lg:ml-16 xl:ml-24 2xl:ml-28">
      <div class="nav-pill-group py-1">
        @foreach ($navItems as $item)
          @php $active = $isActive($item); @endphp
          <a
            href="{{ \Illuminate\Support\Facades\Route::has($item['route']) ? route($item['route']) : '#' }}"
            class="nav-pill px-4 py-2 text-sm font-medium transition-colors duration-200 {{ $active ? 'nav-pill--active' : 'text-slate-700 hover:text-[var(--color-ink)] hover:bg-white/70' }}"
            {{ $active ? 'aria-current=page' : '' }}
          >
            {{ $item['label'] }}
          </a>
        @endforeach
      </div>
    </div>

    {{-- Desktop CTA (opsional) --}}
    
  </nav>

  {{-- Mobile sheet --}}
  {{-- Mobile dropdown --}}
  <div
    id="primary-navigation"
    data-nav-menu
    class="fixed inset-x-0 z-50 hidden bg-white shadow-xl top-20 transition-all duration-300 ease-out"
    aria-hidden="true"
    style="opacity: 0; transform: translateY(-10px);"
  >
    <div
      id="mobile-drawer"
      role="dialog"
      aria-modal="true"
      aria-labelledby="mobile-drawer-title"
      class="w-full bg-white border-b border-[var(--color-border)] overflow-hidden"
    >
      <div class="flex flex-col h-full">
        <div class="p-4 border-b border-[var(--color-border)] bg-[var(--color-surface)]">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <h2 id="mobile-drawer-title" class="sr-only">Menu utama</h2>
              <div class="flex flex-col">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">Menu</span>
                <span class="text-base font-semibold text-[var(--color-ink)]">Navigasi</span>
              </div>
            </div>
            <button
              type="button"
              class="inline-flex items-center justify-center rounded-lg border border-[var(--color-border)] px-3 py-2 text-[var(--color-ink)] hover:bg-slate-100 transition-colors duration-200"
              data-nav-close
              aria-label="Tutup navigasi"
            >
              <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
        </div>

        <nav class="py-2">
          <div class="space-y-1 px-4">
            @foreach ($navItems as $item)
              @php $active = $isActive($item); @endphp
              <a
                href="{{ \Illuminate\Support\Facades\Route::has($item['route']) ? route($item['route']) : '#' }}"
                class="block w-full text-left rounded-xl px-3 py-3 text-sm sm:text-base font-medium transition-all duration-200 touch-target {{ $active ? 'bg-[var(--color-primary)] text-white shadow-lg' : 'text-[var(--color-ink)] hover:bg-slate-100 hover:shadow-sm' }}"
                {{ $active ? 'aria-current=page' : '' }}
                data-close-on-click
              >
                {{ $item['label'] }}
              </a>
            @endforeach
          </div>
          
          <div class="mt-6 pt-4 border-t border-[var(--color-border)] px-4 pb-4">
            <a href="{{ route('qris') }}" class="btn btn-primary w-full justify-center py-3 text-sm sm:text-base touch-target-sm">Unduh Poster QRIS</a>
          </div>
        </nav>
      </div>
    </div>
  </div>

</header>

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

    ready(() => {
      const header = document.querySelector('[data-header]');
      const btn    = document.querySelector('[data-nav-toggle]');
      const menu   = document.querySelector('[data-nav-menu]');
      const drawer = document.getElementById('mobile-drawer');
      const main   = document.getElementById('main-content');

      if (!header || !btn || !menu || !drawer) {
        return;
      }

      const updateHeaderHeight = () => {
        document.documentElement.style.setProperty('--header-h', `${header.offsetHeight}px`);
      };
      updateHeaderHeight();
      if ('ResizeObserver' in window) {
        const ro = new ResizeObserver(updateHeaderHeight);
        ro.observe(header);
      } else {
        window.addEventListener('resize', updateHeaderHeight);
      }

      const focusableSel = [
        'a[href]',
        'button:not([disabled])',
        'input:not([disabled])',
        'select:not([disabled])',
        'textarea:not([disabled])',
        '[tabindex]:not([tabindex="-1"])',
      ].join(',');

      let lastFocused = null;
      let lockedScrollY = 0;
      let transitionTimer = null;

      const lockScroll = () => {
        lockedScrollY = window.scrollY || 0;
        document.body.style.top = `-${lockedScrollY}px`;
        document.body.style.position = 'fixed';
        document.body.style.width = '100%';
      };

      const unlockScroll = () => {
        document.body.style.position = '';
        document.body.style.width = '';
        document.body.style.top = '';
        window.scrollTo({ top: lockedScrollY, behavior: 'auto' });
      };

      const setInert = (active) => {
        if (!main) return;
        if (active) {
          main.setAttribute('inert', '');
          main.setAttribute('aria-hidden', 'true');
        } else {
          main.removeAttribute('inert');
          main.removeAttribute('aria-hidden');
        }
      };

      const focusTrap = (event) => {
        if (event.key !== 'Tab') return;
        const focusable = drawer.querySelectorAll(focusableSel);
        if (!focusable.length) return;

        const first = focusable[0];
        const last  = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
          event.preventDefault();
          last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
          event.preventDefault();
          first.focus();
        }
      };

      const handleEscape = (event) => {
        if (event.key === 'Escape') {
          close(true);
        }
      };

      const afterTransition = () => {
        menu.classList.add('hidden');
        menu.style.visibility = '';
        menu.style.opacity = '';
        menu.style.transform = 'translateY(-10px)';
        menu.removeEventListener('transitionend', afterTransition);
        if (transitionTimer) {
          clearTimeout(transitionTimer);
          transitionTimer = null;
        }
      };

      const open = () => {
        if (btn.getAttribute('aria-expanded') === 'true') return;

        lastFocused = document.activeElement;
        menu.classList.remove('hidden');
        menu.style.visibility = 'visible';
        requestAnimationFrame(() => {
          menu.style.opacity = '1';
          menu.style.transform = 'translateY(0)';
        });

        btn.setAttribute('aria-expanded', 'true');
        menu.setAttribute('aria-hidden', 'false');

        lockScroll();
        setInert(true);

        const firstFocusable = drawer.querySelector(focusableSel);
        (firstFocusable || drawer).focus();

        document.addEventListener('keydown', focusTrap);
        document.addEventListener('keydown', handleEscape);
      };

      const close = (restoreFocus = false) => {
        if (btn.getAttribute('aria-expanded') !== 'true') return;

        menu.style.opacity = '0';
        menu.style.transform = 'translateY(-10px)';
        menu.setAttribute('aria-hidden', 'true');
        btn.setAttribute('aria-expanded', 'false');

        transitionTimer = setTimeout(afterTransition, 320);
        menu.addEventListener('transitionend', afterTransition, { once: true });

        unlockScroll();
        setInert(false);

        document.removeEventListener('keydown', focusTrap);
        document.removeEventListener('keydown', handleEscape);

        if (restoreFocus && lastFocused instanceof HTMLElement) {
          lastFocused.focus({ preventScroll: true });
        }
      };

      btn.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        expanded ? close(false) : open();
      });

      menu.querySelectorAll('[data-close-on-click]').forEach((link) => {
        link.addEventListener('click', () => {
          if (matchMedia('(max-width: 1023px)').matches) {
            close(false);
          }
        });
      });

      const closeBtn = menu.querySelector('button[data-nav-close]');
      closeBtn?.addEventListener('click', (event) => {
        event.stopPropagation();
        close(true);
      });

      menu.addEventListener('click', (event) => {
        if (event.target === menu) {
          close(true);
        }
      });

      const updateHeaderShadow = () => {
        header.classList.toggle('shadow-sm', window.scrollY > 4);
      };
      updateHeaderShadow();
      document.addEventListener('scroll', updateHeaderShadow, { passive: true });
    });
  })();
  </script>
@endpush
