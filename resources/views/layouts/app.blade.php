<!DOCTYPE html>
<html lang="id" data-theme="light" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials._seo', [
        'title'       => $title ?? null,
        'description' => $description ?? null,
        'image'       => $image ?? null,
    ])

    {{-- Fonts (preconnect) --}}
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="{{ asset('tmplt/css/font-awesome.min.css') }}">

    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-[var(--color-bg)] text-[var(--color-ink)] antialiased flex flex-col">

    {{-- Skip link (aksesibilitas) --}}
    <a href="#main-content"
       class="sr-only focus:not-sr-only focus:absolute focus:inset-x-4 focus:top-4
              focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:ring-2 focus:ring-blue-300">
        Lewati ke konten
    </a>

    {{-- Navbar (pastikan <x-navbar> memakai header[data-header] + position:fixed) --}}
    <x-navbar />

    <main id="main-content" role="main" class="flex-1 container-app pt-28">
        @hasSection('hero')
            {{-- Hero full-bleed mengikuti Figma; komponen hero sudah mengatur -mx di dalamnya --}}
            <section aria-labelledby="hero-title">
                @yield('hero')
            </section>
        @endif

        @if (trim($__env->yieldContent('content')))
            <div class="pt-10 pb-24">
                @yield('content')
            </div>
        @else
            {{ $slot ?? '' }}
        @endif
    </main>

    <x-footer class="mt-16" />

    {{-- Shadow header saat scroll (butuh attribute data-header di <header> navbar) --}}
    <script>
      const headerEl = document.querySelector('[data-header]');
      const onScroll = () => headerEl?.classList.toggle('shadow-sm', window.scrollY > 4);
      document.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    </script>

    @stack('scripts')
</body>
</html>
