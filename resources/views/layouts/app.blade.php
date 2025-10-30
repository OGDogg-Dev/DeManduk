<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials._seo', [
        'title' => $title ?? null,
        'description' => $description ?? null,
        'image' => $image ?? null,
    ])
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased flex flex-col">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 inline-flex items-center gap-2 rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition focus:outline-none focus:ring-2 focus:ring-blue-500">
        Lewati ke konten utama
    </a>
    <x-navbar />
    <main id="main-content" class="flex-1">
        @hasSection('hero')
            <section aria-labelledby="hero-title">
                @yield('hero')
            </section>
        @endif

        @if (trim($__env->yieldContent('content')))
            <div class="pb-24">
                @yield('content')
            </div>
        @else
            {{ $slot ?? '' }}
        @endif
    </main>
    <x-footer />
    @stack('scripts')
</body>
</html>
