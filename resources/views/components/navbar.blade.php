@php
    $navItems = [
        ['label' => 'Beranda', 'route' => 'home'],
        ['label' => 'Galeri', 'route' => 'galeri'],
        ['label' => 'Event', 'route' => 'event.index', 'active' => ['event.*']],
        ['label' => 'Berita', 'route' => 'news.index', 'active' => ['news.*']],
        ['label' => 'Kontak', 'route' => 'kontak'],
        ['label' => 'QRIS', 'route' => 'qris'],
        ['label' => 'SOP', 'route' => 'sop'],
    
    ];

    $brandTitle = $siteTitle ?? "D'Manduk";
    $brandLogo = \App\Support\Media::url($siteLogoPath ?? null);
    $brandInitials = strtoupper(mb_substr($brandTitle, 0, 2));
@endphp

<!-- Skip to content untuk keyboard user -->
<a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-amber-400 focus:px-3 focus:py-2 focus:text-[#021024]">
  Loncat ke konten
</a>

<!-- Header: fixed agar tidak membuat jarak -->
<header
  data-header
  class="fixed inset-x-0 top-0 z-40 border-b border-white/10 bg-gradient-to-r from-[#010b1f]/95 via-[#041b3c]/95 to-[#010b1f]/95 backdrop-blur"
>
  <nav
    class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-4 py-4 sm:px-6 lg:px-8 lg:justify-start"
    aria-label="Navigasi utama"
  >
    <!-- Brand -->
    <div class="flex items-center gap-3">
      <a href="{{ route('home') }}" class="group flex items-center gap-3">
        @if ($brandLogo)
          <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}" class="h-11 w-11 rounded-full bg-white/10 object-cover ring-1 ring-white/20">
        @else
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-[#0f2c53] font-semibold text-white ring-1 ring-white/15">
            {{ $brandInitials }}
          </span>
        @endif
        <div class="hidden flex-col sm:flex">
          <span class="text-[11px] font-semibold uppercase tracking-[0.4em] text-white/50">Portal Resmi</span>
          <span class="text-lg font-bold text-white">{{ $brandTitle }}</span>
        </div>
      </a>
    </div>

    <!-- Toggle (mobile) -->
    <button
      type="button"
      class="ml-auto inline-flex items-center justify-center rounded-lg border border-white/20 p-2 text-white transition hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2 focus-visible:ring-offset-[#020f24] lg:hidden"
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
      class="hidden w-full flex-1 -translate-y-2 flex-col gap-6 rounded-2xl border border-white/15 bg-[#020b1f]/95 p-6 opacity-0 shadow-[0_24px_70px_-30px_rgba(5,25,58,0.9)] transition duration-200 will-change-transform
             lg:ml-16 xl:ml-24 2xl:ml-28 lg:flex lg:w-auto lg:translate-y-0 lg:flex-row lg:items-center lg:gap-10 lg:border-none lg:bg-transparent lg:p-0 lg:opacity-100 lg:shadow-none"
      aria-hidden="true"
    >
      <ul class="flex flex-col items-start gap-4 text-[15px] font-semibold uppercase tracking-[0.2em] text-white/70 lg:flex-row lg:items-center lg:gap-8">
        @foreach ($navItems as $item)
          @php
            $patterns = array_merge(
                [$item['route']],
                $item['active'] ?? [],
                [$item['route'] . '.*']
            );
            $active = false;
            foreach ($patterns as $pattern) {
                if (request()->routeIs($pattern)) {
                    $active = true;
                    break;
                }
            }
          @endphp
          <li class="w-full lg:w-auto">
            <a
                href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                @class([
                    'group inline-flex items-center gap-2 rounded-lg px-3 py-2 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2 focus-visible:ring-offset-[#020f24]',
                    'text-white/70 hover:text-white hover:bg-white/5 lg:hover:bg-transparent' => ! $active,
                    'text-amber-400 lg:border-b-2 lg:border-amber-400 lg:pb-3' => $active,
                ])
                {{ $active ? 'aria-current=page' : '' }}
                data-close-on-click
            >
                <span class="relative">
                    {{ mb_strtoupper($item['label']) }}
                    @unless($active)
                        <span class="pointer-events-none absolute -bottom-1 left-0 block h-0.5 w-0 rounded bg-amber-500/50 transition-all duration-200 group-hover:w-full"></span>
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

