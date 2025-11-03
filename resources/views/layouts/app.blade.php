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
<body class="min-h-screen flex flex-col text-slate-100">
    
    <x-navbar />
    <main id="main-content" class="flex-1">
        @hasSection('hero')
            <section aria-labelledby="hero-title">
                @yield('hero')
            </section>
        @endif

        @if (trim($__env->yieldContent('content')))
            <div class="pt-8 pb-24">
                
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
