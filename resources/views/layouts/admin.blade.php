<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Dashboard' }} &middot; {{ $siteTitle ?? "D'Manduk" }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="admin-surface bg-slate-100 text-slate-900 antialiased">
@php
    $brandTitle = $siteTitle ?? "D'Manduk";
    $brandLogo = \App\Support\Media::url($siteLogoPath ?? null);
    $brandInitials = strtoupper(mb_substr($brandTitle, 0, 2));
    $menu = [
        ['route' => 'admin.dashboard', 'label' => 'Dasbor', 'icon' => 'chart-bar', 'active' => ['admin.dashboard']],
        ['route' => 'admin.home.index', 'label' => 'Konten Beranda', 'icon' => 'newspaper', 'active' => ['admin.home.*']],
        ['route' => 'admin.gallery.index', 'label' => 'Galeri', 'icon' => 'photo', 'active' => ['admin.gallery.*']],
        ['route' => 'admin.news.index', 'label' => 'Berita', 'icon' => 'newspaper', 'active' => ['admin.news.*']],
        ['route' => 'admin.pages.contact.settings.edit', 'label' => 'Halaman Kontak', 'icon' => 'envelope-open', 'active' => ['admin.pages.contact.*']],
        ['route' => 'admin.pages.qris.settings.edit', 'label' => 'Halaman QRIS', 'icon' => 'credit-card', 'active' => ['admin.pages.qris.*']],
        ['route' => 'admin.pages.sop.settings.edit', 'label' => 'Halaman SOP', 'icon' => 'document-text', 'active' => ['admin.pages.sop.*']],
        ['route' => 'admin.events.index', 'label' => 'Event', 'icon' => 'calendar', 'active' => ['admin.events.*']],
        ['route' => 'admin.home.settings.edit', 'label' => 'Pengaturan Umum', 'icon' => 'adjustments-horizontal', 'active' => ['admin.home.settings.edit']],
        ['route' => 'admin.styleguide', 'label' => 'Styleguide', 'icon' => 'sparkles', 'active' => ['admin.styleguide']],
    ];
@endphp

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="admin-sidebar" class="fixed inset-y-0 z-40 hidden w-72 flex-col bg-slate-900 text-slate-100 shadow-xl transition lg:static lg:flex">
            <div class="flex h-16 items-center gap-3 border-b border-slate-800 px-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 font-semibold tracking-tight">
                    @if ($brandLogo)
                        <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}" class="h-10 w-10 rounded-full border border-white/10 object-cover">
                    @else
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-indigo-500 text-sm font-semibold text-white">
                            {{ $brandInitials }}
                        </span>
                    @endif
                    <span class="text-lg text-black">{{ $brandTitle }}</span>
                </a>
            </div>
            <div class="flex-1 overflow-y-auto px-5 py-6">
                <nav class="space-y-1 text-sm font-medium">
                    @foreach ($menu as $item)
                        @php
                            $patterns = $item['active'] ?? [$item['route']];
                            $isActive = collect($patterns)->contains(fn ($pattern) => request()->routeIs($pattern));
                        @endphp
                        <a
                            href="{{ route($item['route']) }}"
                            class="{{ $isActive ? 'bg-indigo-500 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }} flex items-center gap-3 rounded-xl px-3 py-2 transition"
                        >
                            <x-admin.icon :name="$item['icon']" class="h-5 w-5" />
                            <span class="text-black">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
            <div class="border-t border-slate-800 px-6 py-5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-slate-700">
                        <x-admin.icon name="arrow-left-on-rectangle" class="h-5 w-5" />
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex flex-1 flex-col overflow-hidden lg:ml-0">
            <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-4 shadow-sm backdrop-blur sm:px-6">
                <div class="flex items-center gap-2 lg:hidden">
                    <button type="button" data-admin-toggle="sidebar" class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:bg-slate-100">
                        <x-admin.icon name="bars-3" class="h-5 w-5" />
                        <span class="sr-only">Toggle sidebar</span>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-end gap-3">
                    <div class="hidden items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm sm:flex">
                        <x-admin.icon name="magnifying-glass" class="h-4 w-4 text-slate-400" />
                        <input type="search" placeholder="Cari data..." class="w-48 border-0 bg-transparent text-sm text-slate-600 focus:outline-none" />
                    </div>
                    <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:border-indigo-400 hover:text-indigo-500">
                        <x-admin.icon name="bell" class="h-5 w-5" />
                        <span class="sr-only">Notifikasi</span>
                    </button>
                    <div class="hidden items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-sm font-semibold text-slate-700 shadow-sm sm:flex">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500 text-white">AD</span>
                        <span>Admin Desa</span>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    @if(trim($__env->yieldContent('content')))
                        @yield('content')
                    @else
                        {{ $slot ?? '' }}
                    @endif
                </div>
            </main>
        </div>
    </div>

    <x-admin.scripts />
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('admin-sidebar');
            const toggleBtn = document.querySelector('[data-admin-toggle="sidebar"]');
            if (!sidebar || !toggleBtn) return;

            const toggleSidebar = () => {
                const isOpen = sidebar.classList.contains('flex');
                if (isOpen) {
                    sidebar.classList.replace('flex', 'hidden');
                } else {
                    sidebar.classList.replace('hidden', 'flex');
                }
            };

            toggleBtn.addEventListener('click', toggleSidebar);
            document.addEventListener('click', (event) => {
                if (window.innerWidth >= 1024) return;
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.replace('flex', 'hidden');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
