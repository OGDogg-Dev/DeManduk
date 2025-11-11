@props(['slides' => []])

@if (count($slides))
<section class="-mx-4 sm:-mx-6 lg:-mx-8" role="region" aria-label="Sorotan Waduk Manduk">
  <div class="relative bg-[var(--color-bg)] text-white" data-carousel data-autoplay="true" data-interval="4000">
    {{-- Viewport --}}
    <div
      class="relative overflow-x-auto scroll-smooth [scroll-snap-type:x_mandatory] [-ms-overflow-style:none] [scrollbar-width:none]"
      data-viewport aria-roledescription="carousel" aria-label="Daftar slide"
    >
      <style>.group [data-viewport]::-webkit-scrollbar{display:none}</style>

      <div class="flex gap-0" data-slides>
        @foreach ($slides as $i => $slide)
          @php($image = $slide['image'] ?? asset('images/gallery/1.JPG'))
          <article
            class="relative flex w-full min-w-full snap-center flex-col justify-end md:min-h-[28rem] lg:min-h-[34rem] xl:min-h-[40rem]"
            data-slide data-index="{{ $i }}" aria-roledescription="slide"
            aria-label="Slide {{ $i + 1 }} dari {{ count($slides) }}"
            {{ $i === 0 ? 'aria-current=true' : '' }}
          >
            <img
              src="{{ $image }}"
              alt="{{ $slide['title'] ?? 'Panorama Waduk Manduk' }}"
              class="absolute inset-0 h-full w-full object-cover"
              loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
              decoding="async"
              fetchpriority="{{ $i === 0 ? 'high' : 'low' }}"
            />
            {{-- Gradient untuk keterbacaan teks --}}
            <span class="absolute inset-0 bg-gradient-to-t from-[rgba(2,6,23,.75)] via-[rgba(2,6,23,.35)] to-transparent"></span>

            <div class="relative px-4 pb-8 pt-10 sm:px-6 lg:px-8">
              <div class="mx-auto max-w-6xl space-y-4">
                @if (!empty($slide['eyebrow']))
                  <p class="text-xs uppercase tracking-[0.35em] text-[var(--color-primary-100)]">
                    {{ $slide['eyebrow'] }}
                  </p>
                @endif

                <h1 class="font-serif text-3xl font-semibold tracking-tight sm:text-5xl lg:text-6xl text-[var(--color-bg)]">
                  {{ $slide['title'] ?? '' }}
                </h1>

                @if (!empty($slide['description']))
                  <p class="max-w-2xl text-sm text-[var(--color-bg)]/80 sm:text-lg">
                    {{ $slide['description'] }}
                  </p>
                @endif

                @if (!empty($slide['cta']))
                  <div class="pt-1">
                    <a href="{{ $slide['cta']['href'] ?? '#' }}" class="btn-primary rounded-full px-6 py-3">
                      {{ $slide['cta']['label'] ?? 'Jelajahi' }}
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </article>
        @endforeach
      </div>
    </div>

    {{-- Controls --}}
    <div class="pointer-events-none absolute inset-0 flex items-center justify-between px-2 sm:px-4">
      <button
        type="button"
        class="pointer-events-auto inline-flex size-10 items-center justify-center rounded-full bg-white/90 text-slate-800 shadow hover:bg-white focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300"
        data-prev aria-label="Sebelumnya"
      >
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/></svg>
      </button>
      <button
        type="button"
        class="pointer-events-auto inline-flex size-10 items-center justify-center rounded-full bg-white/90 text-slate-800 shadow hover:bg-white focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300"
        data-next aria-label="Berikutnya"
      >
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>

    {{-- Indicators --}}
    <div class="absolute inset-x-0 bottom-3 sm:bottom-5">
      <ol class="mx-auto flex max-w-6xl items-center gap-2 px-4 sm:px-6 lg:px-8" data-indicators>
        @for ($i = 0; $i < count($slides); $i++)
          <li>
            <button
              type="button"
              class="h-1.5 w-6 rounded-full bg-white/40 transition data-[active=true]:w-8 data-[active=true]:bg-white"
              data-goto="{{ $i }}"
              aria-label="Ke slide {{ $i + 1 }}"
            ></button>
          </li>
        @endfor
      </ol>
    </div>
  </div>
</section>

@once
@push('scripts')
<script>
  (() => {
    const carousels = Array.from(document.querySelectorAll('[data-carousel]'));
    if (!carousels.length) {
      return;
    }

    const supportsIO = 'IntersectionObserver' in window;

    carousels.forEach((root) => {
      const viewport = root.querySelector('[data-viewport]');
      const slides = Array.from(root.querySelectorAll('[data-slide]'));
      if (!viewport || slides.length <= 1) {
        // Nothing to animate, but still ensure ARIA state is correct
        slides.forEach((slide, index) => slide.setAttribute('aria-current', String(index === 0)));
        return;
      }

      const dots = Array.from(root.querySelectorAll('[data-goto]'));
      const prevBtn = root.querySelector('[data-prev]');
      const nextBtn = root.querySelector('[data-next]');
      const autoplay = root.getAttribute('data-autoplay') !== 'false';
      const interval = Number(root.getAttribute('data-interval') || 4000);

      let current = 0;
      let timer = null;

      const updateIndicators = () => {
        slides.forEach((slide, index) => slide.setAttribute('aria-current', String(index === current)));
        dots.forEach((dot, index) => dot.setAttribute('data-active', String(index === current)));
      };

      const goTo = (index, behaviour = 'smooth') => {
        if (!slides.length) return;
        current = (index + slides.length) % slides.length;
        const target = slides[current];
        if (target) {
          viewport.scrollTo({
            left: target.offsetLeft,
            behavior: behaviour,
          });
        }
        updateIndicators();
      };

      const next = () => goTo(current + 1);
      const prev = () => goTo(current - 1);

      let observer = null;
      if (supportsIO) {
        observer = new IntersectionObserver((entries) => {
          const viewportRect = root.getBoundingClientRect();
          const inViewport = viewportRect.top < window.innerHeight && viewportRect.bottom > 0;
          if (!inViewport) {
            return;
          }

          entries.forEach((entry) => {
            if (entry.isIntersecting && entry.intersectionRatio > 0.6) {
              const index = Number(entry.target.getAttribute('data-index') || 0);
              if (!Number.isNaN(index) && index !== current) {
                current = index;
                updateIndicators();
              }
            }
          });
        }, { root: viewport, threshold: [0.6] });
        slides.forEach((slide) => observer.observe(slide));
      }

      const stopAutoplay = () => {
        if (timer) {
          clearInterval(timer);
          timer = null;
        }
      };

      const startAutoplay = () => {
        if (!autoplay || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
          return;
        }
        stopAutoplay();
        timer = setInterval(next, Math.max(interval, 2500));
      };

      prevBtn?.addEventListener('click', prev);
      nextBtn?.addEventListener('click', next);
      dots.forEach((dot) => {
        dot.addEventListener('click', () => {
          const targetIndex = Number(dot.getAttribute('data-goto'));
          if (!Number.isNaN(targetIndex)) {
            goTo(targetIndex);
          }
        });
      });

      root.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowRight') next();
        if (event.key === 'ArrowLeft') prev();
      });

      root.addEventListener('mouseenter', stopAutoplay);
      root.addEventListener('mouseleave', startAutoplay);
      root.addEventListener('focusin', stopAutoplay);
      root.addEventListener('focusout', startAutoplay);

      viewport.addEventListener('scroll', () => {
        if (!supportsIO) {
          const midpoint = viewport.scrollLeft + viewport.clientWidth / 2;
          const closest = slides.reduce((closest, slide, index) => {
            const distance = Math.abs(slide.offsetLeft + slide.clientWidth / 2 - midpoint);
            if (distance < closest.distance) {
              return { distance, index };
            }
            return closest;
          }, { distance: Number.POSITIVE_INFINITY, index: current });
          if (closest.index !== current) {
            current = closest.index;
            updateIndicators();
          }
        }
      }, { passive: true });

      updateIndicators();
      startAutoplay();
    });
  })();
  </script>
@endpush
@endonce
@endif
