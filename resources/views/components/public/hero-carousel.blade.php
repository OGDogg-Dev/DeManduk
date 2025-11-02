@props(['slides' => []])

@if (count($slides))
<div class="relative overflow-hidden bg-black text-white">
    <div class="relative max-w-none px-0">
        <section class="py-0" role="region" aria-label="Sorotan Waduk Manduk">
            <div class="group relative" data-carousel data-autoplay="true" data-interval="3000">
                <div
                    class="relative overflow-x-auto scroll-smooth [scroll-snap-type:x_mandatory] [-ms-overflow-style:none] [scrollbar-width:none]"
                    data-viewport aria-roledescription="carousel" aria-label="Daftar slide"
                >
                    <style>.group [data-viewport]::-webkit-scrollbar{display:none}</style>

                    <div class="flex gap-0" data-slides>
                        @foreach ($slides as $i => $slide)
                            @php($image = $slide['image'] ?? null)
                            @if (! $image)
                                @php($image = Vite::asset('resources/images/gallery/1.JPG'))
                            @endif

                            <article
                                class="relative flex w-full min-w-full snap-center flex-col justify-end md:min-h-[28rem] lg:min-h-[34rem] xl:min-h-[40rem]"
                                data-slide aria-roledescription="slide"
                                aria-label="Slide {{ $i + 1 }} dari {{ count($slides) }}"
                                {{ $i === 0 ? 'aria-current=true' : '' }}
                            >
                                <div class="absolute inset-0">
                                    <img
                                        src="{{ $image }}"
                                        alt="{{ $slide['title'] }}"
                                        class="h-full w-full object-cover"
                                        loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                                        decoding="async"
                                        fetchpriority="{{ $i === 0 ? 'high' : 'low' }}"
                                    >
                                </div>

                                <div class="relative space-y-3 p-6 sm:p-10">
                                    @if (!empty($slide['eyebrow']))
                                        <p class="text-xs uppercase tracking-[0.35em] text-white/90">
                                            {{ $slide['eyebrow'] }}
                                        </p>
                                    @endif

                                    <h1 class="text-3xl font-bold uppercase tracking-wide text-white sm:text-5xl lg:text-6xl">
                                        {{ $slide['title'] }}
                                    </h1>

                                    @if (!empty($slide['description']))
                                        <p class="max-w-xl text-sm text-white/90 sm:text-base">
                                            {{ $slide['description'] }}
                                        </p>
                                    @endif

                                    @if (!empty($slide['cta']))
                                        <div>
                                            <a
                                                href="{{ $slide['cta']['href'] ?? '#' }}"
                                                class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold uppercase tracking-wider text-slate-900 transition hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/50 focus-visible:ring-offset-2"
                                            >
                                                {{ $slide['cta']['label'] ?? 'Jelajahi' }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endif
