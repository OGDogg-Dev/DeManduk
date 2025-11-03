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
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
@php
    $brandTitle = $siteTitle ?? "D'Manduk";
    $brandLogo = \App\Support\Media::url($siteLogoPath ?? null);
    $brandInitials = strtoupper(mb_substr($brandTitle, 0, 2));
@endphp

    <div class="flex min-h-screen">
        <aside id="admin-sidebar" class="hidden w-64 flex-shrink-0 border-r border-slate-200 bg-white lg:flex lg:flex-col">
            <div class="px-6 py-5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-lg font-bold text-slate-900">
                    @if ($brandLogo)
                        <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}" class="h-9 w-9 rounded-full border border-blue-200 object-cover">
                    @else
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white">
                            {{ $brandInitials }}
                        </span>
                    @endif
                    <span>{{ $brandTitle }}</span>
                </a>
            </div>
                        <nav class="flex-1 space-y-1 px-4 pb-6">
                @php
                    $menu = [
                        ['route' => 'admin.dashboard', 'label' => 'Dasbor', 'icon' => 'chart-bar', 'active' => ['admin.dashboard']],
                        ['route' => 'admin.home.index', 'label' => 'Konten Beranda', 'icon' => 'newspaper', 'active' => ['admin.home.*']],
                        ['route' => 'admin.gallery.index', 'label' => 'Galeri', 'icon' => 'photo', 'active' => ['admin.gallery.*']],
                        ['route' => 'admin.news.index', 'label' => 'Berita', 'icon' => 'newspaper', 'active' => ['admin.news.*']],
                        ['route' => 'admin.pages.contact.settings.edit', 'label' => 'Halaman Kontak', 'icon' => 'newspaper', 'active' => ['admin.pages.contact.*']],
                        ['route' => 'admin.pages.qris.settings.edit', 'label' => 'Halaman QRIS', 'icon' => 'newspaper', 'active' => ['admin.pages.qris.*']],
                        ['route' => 'admin.pages.sop.settings.edit', 'label' => 'Halaman SOP', 'icon' => 'newspaper', 'active' => ['admin.pages.sop.*']],
                        ['route' => 'admin.events.index', 'label' => 'Event', 'icon' => 'calendar', 'active' => ['admin.events.*']],
                        ['route' => 'admin.home.settings.edit', 'label' => 'Pengaturan Umum', 'icon' => 'cog-6-tooth', 'active' => ['admin.home.settings.edit']],
                    ];
                @endphp

                @foreach ($menu as $item)
                    @php
                        $patterns = $item['active'] ?? [$item['route']];
                        $isActive = false;
                        foreach ($patterns as $pattern) {
                            if (request()->routeIs($pattern)) {
                                $isActive = true;
                                break;
                            }
                        }
                    @endphp
                    <a
                        href="{{ route($item['route']) }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition {{ $isActive ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
                        aria-controls="admin-sidebar"
                        aria-expanded="false"
                    >
                        <x-admin.icon :name="$item['icon']" class="h-5 w-5" />
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
            <div class="px-4 pb-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-red-300 hover:text-red-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    >
                        <x-admin.icon name="arrow-left-on-rectangle" class="h-5 w-5" />
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex min-h-screen flex-1 flex-col">
            <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/90 backdrop-blur">
                <div class="flex items-center justify-between px-6 py-4">
                    <button
                        type="button"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-blue-300 hover:text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 lg:hidden"
                        data-admin-toggle="sidebar"
                    >
                        <x-admin.icon name="bars-3" class="h-5 w-5" />
                        Menu
                    </button>

                    <div class="flex flex-1 items-center justify-end gap-3">
                        <div class="relative hidden sm:block">
                            <input
                                type="search"
                                placeholder="Cari data..."
                                class="w-56 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-600 shadow-sm transition focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            >
                        </div>
                        <button
                            type="button"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white p-2 text-slate-600 shadow-sm transition hover:border-blue-300 hover:text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        >
                            <x-admin.icon name="bell" class="h-5 w-5" />
                        </button>
                        <div class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-2 py-1 text-sm font-medium text-slate-700 shadow-sm">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-white">AD</span>
                            <span class="hidden md:inline">Admin Desa</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 px-6 py-8">
                @if(trim($__env->yieldContent('content')))
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </main>
        </div>
    </div>

    <x-admin.scripts />
    @stack('scripts')
</body>
</html>


