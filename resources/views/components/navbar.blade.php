@php
    $navItems = [
        ['label' => 'Beranda', 'route' => 'home'],
        ['label' => 'Galeri', 'route' => 'galeri'],
        ['label' => 'Event', 'route' => 'event.index'],
        ['label' => 'Berita', 'route' => 'blog.index'],
        ['label' => 'Kontak', 'route' => 'kontak'],
        ['label' => 'QRIS', 'route' => 'qris'],
        ['label' => 'SOP', 'route' => 'sop'],
    ];

    $brandTitle = $siteTitle ?? "D'Manduk";
    $brandLogo = \App\Support\Media::url($siteLogoPath ?? null);
    $brandInitials = strtoupper(mb_substr($brandTitle, 0, 2));
@endphp

<!-- Skip to content untuk keyboard user -->
<a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-blue-600 focus:px-3 focus:py-2 focus:text-white">
  Loncat ke konten
</a>

<!-- Header: fixed agar tidak membuat jarak -->
<header
  data-header
  class="fixed inset-x-0 top-0 z-40 border-b border-slate-200/70 bg-white/85 backdrop-blur supports-[backdrop-filter]:bg-white/70 dark:border-slate-800/60 dark:bg-slate-950/70"
>
  <nav
    class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-4 py-3 sm:px-6 lg:px-8 lg:justify-start"
    aria-label="Navigasi utama"
  >
    <!-- Brand -->
    <div class="flex items-center gap-3">
      <a href="{{ route('home') }}" class="group flex items-center gap-3">
        @if ($brandLogo)
          <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}" class="h-10 w-10 rounded-full border border-blue-200 object-cover">
        @else
          <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 font-semibold text-white ring-1 ring-blue-500/30 dark:ring-blue-400/20">
            {{ $brandInitials }}
          </span>
        @endif
        <div class="hidden flex-col sm:flex">
          <span class="text-[11px] font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Portal Resmi</span>
          <span class="text-lg font-bold text-slate-900 dark:text-white">{{ $brandTitle }}</span>
        </div>
      </a>
    </div>

    <!-- Toggle (mobile) -->
    <button
      type="button"
      class="ml-auto inline-flex items-center justify-center rounded-lg border border-slate-200 p-2 text-slate-700 transition hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:border-slate-800 dark:text-slate-200 dark:hover:bg-slate-900 lg:hidden"
      data-nav-toggle
      aria-expanded="false"
      aria-controls="primary-navigation"
      aria-label="Buka navigasi"
    >
      <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    <!-- Menu -->
    <div
      id="primary-navigation"
      data-nav-menu
      class="hidden w-full flex-1 -translate-y-2 flex-col gap-6 rounded-2xl border border-slate-200 bg-white p-6 opacity-0 shadow-lg transition duration-200 will-change-transform dark:border-slate-800 dark:bg-slate-950
             lg:ml-16 xl:ml-24 2xl:ml-28 lg:flex lg:w-auto lg:translate-y-0 lg:flex-row lg:items-center lg:gap-8 lg:border-none lg:bg-transparent lg:p-0 lg:opacity-100 lg:shadow-none"
      aria-hidden="true"
    >
      <ul class="flex flex-col items-start gap-4 text-[15px] font-semibold text-slate-700 dark:text-slate-200 lg:flex-row lg:items-center lg:gap-6">
        @foreach ($navItems as $item)
          @php
            $active = request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*');
          @endphp
          <li class="w-full lg:w-auto">
            <a
              href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
              @class([
                'group inline-flex items-center gap-2 rounded-lg px-3 py-2 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2',
                'text-slate-700 hover:text-slate-900 hover:bg-slate-100/70 dark:text-slate-200 dark:hover:text-white dark:hover:bg-slate-900/60 lg:hover:bg-transparent' => ! $active,
                'bg-blue-600 text-white shadow-sm hover:bg-blue-700' => $active,
              ])
              {{ $active ? 'aria-current=page' : '' }}
              data-close-on-click
            >
              <span class="relative">
                {{ $item['label'] }}
                @unless($active)
                  <span class="pointer-events-none absolute -bottom-1 left-0 block h-0.5 w-0 rounded bg-slate-300 transition-all duration-200 group-hover:w-full dark:bg-slate-600"></span>
                @endunless
              </span>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  </nav>
</header>

@push('styles')
<style>
  /* Offset aman untuk anchor/skip-link agar tidak ketutup header */
  :root { --header-h: 64px; } /* fallback */
  #main-content { scroll-margin-top: var(--header-h); }
</style>
@endpush

@push('scripts')
<script>
  (function () {
    const header = document.querySelector('[data-header]');
    const btn = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');
    if (!header || !btn || !menu) return;

    // CSS var tinggi header untuk offset anchor (#main-content)
    const setHeaderVar = () => {
      document.documentElement.style.setProperty('--header-h', header.offsetHeight + 'px');
    };
    setHeaderVar();
    if (window.ResizeObserver) new ResizeObserver(setHeaderVar).observe(header);
    window.addEventListener('resize', setHeaderVar, { passive: true });

    const openMenu = () => {
      menu.classList.remove('hidden');
      menu.setAttribute('aria-hidden', 'false');
      btn.setAttribute('aria-expanded', 'true');
      requestAnimationFrame(() => {
        menu.classList.remove('opacity-0', '-translate-y-2');
      });
      const firstLink = menu.querySelector('a');
      firstLink && firstLink.focus();
      document.addEventListener('keydown', onKeyDown);
      document.addEventListener('click', onClickOutside, true);
    };

    const closeMenu = () => {
      menu.classList.add('opacity-0', '-translate-y-2');
      menu.setAttribute('aria-hidden', 'true');
      btn.setAttribute('aria-expanded', 'false');
      const onEnd = (e) => {
        if (e.target !== menu) return;
        menu.classList.add('hidden');
        menu.removeEventListener('transitionend', onEnd);
      };
      menu.addEventListener('transitionend', onEnd);
      document.removeEventListener('keydown', onKeyDown);
      document.removeEventListener('click', onClickOutside, true);
    };

    const onKeyDown = (e) => { if (e.key === 'Escape') { closeMenu(); btn.focus(); } };
    const onClickOutside = (e) => { if (!menu.contains(e.target) && !btn.contains(e.target)) closeMenu(); };

    btn.addEventListener('click', () => {
      const isOpen = btn.getAttribute('aria-expanded') === 'true';
      isOpen ? closeMenu() : openMenu();
    });

    // Tutup menu saat klik item (mobile)
    menu.querySelectorAll('[data-close-on-click]').forEach((a) => {
      a.addEventListener('click', () => {
        if (window.matchMedia('(max-width: 1023px)').matches) closeMenu();
      });
    });

    // Efek bayangan saat scroll
    const onScroll = () => {
      const scrolled = window.scrollY > 2;
      header.classList.toggle('shadow-md', scrolled);
      header.classList.toggle('backdrop-blur', true);
    };
    onScroll();
    document.addEventListener('scroll', onScroll, { passive: true });
  })();
</script>
@endpush

