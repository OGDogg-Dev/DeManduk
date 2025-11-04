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
    <a href="{{ route('home') }}" class="group flex items-center gap-3">
      @if ($brandLogo)
        <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}" class="h-10 w-10 rounded-xl object-cover ring-subtle">
      @else
        <span class="grid h-10 w-10 place-content-center rounded-xl bg-slate-200 text-slate-800 ring-subtle font-semibold">
          {{ $brandInitials }}
        </span>
      @endif
      <div class="hidden flex-col sm:flex">
        <span class="text-[11px] font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">Portal Resmi</span>
        <span class="text-base font-semibold text-[var(--color-ink)]">{{ $brandTitle }}</span>
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
    <div class="hidden lg:ml-16 xl:ml-24 2xl:ml-28 lg:block">
      <div class="nav-pill-group">
        @foreach ($navItems as $item)
          @php $active = $isActive($item); @endphp
          <a
            href="{{ \Illuminate\Support\Facades\Route::has($item['route']) ? route($item['route']) : '#' }}"
            class="nav-pill {{ $active ? 'nav-pill--active' : '' }}"
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
  <div
    id="primary-navigation"
    data-nav-menu
    class="container-app hidden pb-4 lg:hidden"
    aria-hidden="true"
  >
    <div class="mt-2 grid gap-2 rounded-2xl bg-white p-3 ring-subtle">
      @foreach ($navItems as $item)
        @php $active = $isActive($item); @endphp
        <a
          href="{{ \Illuminate\Support\Facades\Route::has($item['route']) ? route($item['route']) : '#' }}"
          class="block rounded-xl px-3 py-2 text-sm {{ $active ? 'bg-[var(--color-primary)] text-white' : 'text-[var(--color-ink)] hover:bg-slate-100' }}"
          {{ $active ? 'aria-current=page' : '' }}
          data-close-on-click
        >
          {{ $item['label'] }}
        </a>
      @endforeach
      <a href="{{ route('qris') }}" class="btn btn-primary">Unduh Poster QRIS</a>
    </div>
  </div>
</header>

@push('scripts')
<script>
(() => {
  const header = document.querySelector('[data-header]');
  const btn    = document.querySelector('[data-nav-toggle]');
  const menu   = document.querySelector('[data-nav-menu]');
  if (!header || !btn || !menu) return;

  // Update CSS var tinggi header → offset anchor
  const setHeaderVar = () => document.documentElement.style.setProperty('--header-h', header.offsetHeight + 'px');
  setHeaderVar();
  if (window.ResizeObserver) new ResizeObserver(setHeaderVar).observe(header);
  addEventListener('resize', setHeaderVar, { passive: true });

  const open = () => {
    menu.classList.remove('hidden');
    menu.setAttribute('aria-hidden', 'false');
    btn.setAttribute('aria-expanded', 'true');
    const firstLink = menu.querySelector('a'); firstLink && firstLink.focus();
    document.addEventListener('keydown', onKeyDown);
    document.addEventListener('click', onClickOutside, true);
  };
  const close = () => {
    menu.setAttribute('aria-hidden', 'true');
    btn.setAttribute('aria-expanded', 'false');
    menu.classList.add('hidden');
    document.removeEventListener('keydown', onKeyDown);
    document.removeEventListener('click', onClickOutside, true);
  };
  const onKeyDown = (e) => { if (e.key === 'Escape') { close(); btn.focus(); } };
  const onClickOutside = (e) => { if (!menu.contains(e.target) && !btn.contains(e.target)) close(); };

  btn.addEventListener('click', () => (btn.getAttribute('aria-expanded') === 'true' ? close() : open()));

  // Tutup saat klik item (hanya mobile)
  menu.querySelectorAll('[data-close-on-click]').forEach(a => {
    a.addEventListener('click', () => {
      if (matchMedia('(max-width: 1023px)').matches) close();
    });
  });

  // Shadow on scroll
  const onScroll = () => header.classList.toggle('shadow-sm', scrollY > 4);
  onScroll(); document.addEventListener('scroll', onScroll, { passive: true });
})();
</script>
@endpush

@push('styles')
<style>
  /* Offset aman anchor/skip-link */
  :root { --header-h: 64px; }
  #main-content { scroll-margin-top: var(--header-h); }
</style>
@endpush
