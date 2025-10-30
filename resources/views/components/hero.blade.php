@props([
    'title' => 'Jelajahi Waduk Manduk',
    'subtitle' => 'Destinasi wisata alam yang memadukan panorama waduk, kuliner tradisional, dan fasilitas keluarga.',
    'eyebrow' => 'Destinasi Wisata Unggulan',
    'ctaPrimary' => null,
    'ctaSecondary' => null,
    'image' => Vite::asset('resources/images/hero-illustration.svg'),
    'stats' => [],
])

<div class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-slate-100">
    <!-- Ilustrasi/Foto sisi kanan -->
    <div class="pointer-events-none absolute inset-y-0 right-0 w-full max-w-xl opacity-40 sm:opacity-100 lg:max-w-2xl">
        <img src="{{ $image }}" alt="Panorama Waduk Manduk" class="h-full w-full object-cover" loading="lazy">
    </div>

    <div class="relative mx-auto flex max-w-6xl flex-col gap-10 px-4 py-20 sm:px-6 lg:flex-row lg:items-center lg:gap-16 lg:px-8 lg:py-24">
        <div class="max-w-2xl space-y-6">
            @if ($eyebrow)
                <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-blue-700">
                    {{ $eyebrow }}
                </span>
            @endif

            <!-- TITLE dengan glassmorphism -->
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                <span
                    class="inline-block max-w-fit rounded-2xl bg-white/10 px-4 py-2
                           ring-1 ring-white/30 backdrop-blur-md shadow-lg
                           dark:bg-slate-900/30 dark:ring-white/20"
                >
                    {{ $title }}
                </span>
            </h1>

            @if ($subtitle)
                <p class="text-lg leading-relaxed text-slate-600 sm:text-xl">
                    {{ $subtitle }}
                </p>
            @endif

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:gap-4">
                @if ($ctaPrimary)
                    <a
                        href="{{ $ctaPrimary['href'] ?? '#' }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    >
                        {{ $ctaPrimary['label'] ?? 'Kunjungi Sekarang' }}
                    </a>
                @endif

                @if ($ctaSecondary)
                    <a
                        href="{{ $ctaSecondary['href'] ?? '#' }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-blue-500 hover:text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    >
                        {{ $ctaSecondary['label'] ?? 'Pelajari Lebih Lanjut' }}
                    </a>
                @endif
            </div>

            @if ($stats)
                <dl class="mt-8 grid gap-6 sm:grid-cols-3">
                    @foreach ($stats as $stat)
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                                {{ $stat['label'] ?? '' }}
                            </dt>
                            <dd class="mt-1 text-2xl font-bold text-slate-900">
                                {{ $stat['value'] ?? '' }}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            @endif
        </div>

        <!-- Spacer kolom kanan untuk layout dua kolom di layar besar -->
        <div class="hidden lg:block lg:w-full"></div>
    </div>
</div>
