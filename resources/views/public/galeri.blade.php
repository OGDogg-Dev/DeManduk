@extends('layouts.app', [
    'title' => 'Galeri Waduk Manduk',
    'description' => 'Sekilas visual suasana waduk, event komunitas, dan fasilitas terbaru. Foto resolusi tinggi tersedia untuk media atas permintaan.',
])

@section('content')
  <x-section
      title="Galeri Waduk Manduk"
      subtitle="Sekilas visual suasana waduk, event komunitas, dan fasilitas terbaru. Foto resolusi tinggi tersedia untuk media atas permintaan."
  >
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
      @forelse ($galleryItems as $image)
        @php
          $src     = $image['image'] ?? asset('images/gallery/gallery-6.svg');
          $title   = $image['title'] ?? 'Waduk Manduk';
          $caption = $image['caption'] ?? null;
        @endphp
        <figure class="card ring-subtle overflow-hidden rounded-3xl">
          <a
            href="{{ $src }}"
            class="group block"
            data-open
            data-index="{{ $loop->index }}"
            data-src="{{ $src }}"
            data-title="{{ e($title) }}"
            data-caption="{{ e($caption ?? '') }}"
          >
            <div class="aspect-[4/3] overflow-hidden bg-slate-100">
              <img
                src="{{ $src }}"
                alt="{{ $title }}"
                loading="lazy"
                decoding="async"
                sizes="(min-width:1024px) 33vw, (min-width:640px) 50vw, 100vw"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]"
              >
            </div>
          </a>
          <figcaption class="px-4 py-3 text-sm">
            <span class="font-semibold text-[var(--color-ink)]">{{ $title }}</span>
            @if ($caption)
              <span class="block text-xs text-[var(--color-muted)]">{{ $caption }}</span>
            @endif
          </figcaption>
        </figure>
      @empty
        <div class="card ring-subtle rounded-3xl border-dashed p-6 text-center text-sm text-[var(--color-muted)] sm:col-span-2 lg:col-span-3">
          Belum ada foto yang dipublikasikan. Silakan kembali lagi setelah pengelola menambahkan konten.
        </div>
      @endforelse
    </div>

    {{-- LIGHTBOX --}}
    @if (!empty($galleryItems))
    <dialog data-lightbox class="backdrop:bg-black/60 rounded-2xl p-0 w-[min(92vw,1100px)]">
      <div class="relative">
        <button type="button" data-close class="absolute right-3 top-3 z-10 rounded-lg bg-white/90 px-2 py-1 text-sm font-medium text-[var(--color-ink)] hover:bg-white">
          Tutup
        </button>
        <button type="button" data-prev class="absolute left-2 top-1/2 z-10 -translate-y-1/2 rounded-full bg-white/90 p-2 hover:bg-white" aria-label="Sebelumnya">
          <svg class="h-5 w-5 text-[var(--color-ink)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M15 18 9 12l6-6"/>
          </svg>
          <span class="sr-only">Sebelumnya</span>
        </button>
        <button type="button" data-next class="absolute right-2 top-1/2 z-10 -translate-y-1/2 rounded-full bg-white/90 p-2 hover:bg-white" aria-label="Berikutnya">
          <svg class="h-5 w-5 text-[var(--color-ink)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m9 18 6-6-6-6"/>
          </svg>
          <span class="sr-only">Berikutnya</span>
        </button>

        <img data-view class="mx-auto block max-h-[70vh] w-full object-contain bg-black/5" alt="">
        <div class="border-t border-[var(--color-border)] p-4">
          <h4 data-title class="text-base font-semibold text-[var(--color-ink)]"></h4>
          <p data-caption class="mt-1 text-sm text-[var(--color-muted)]"></p>
        </div>
      </div>
    </dialog>
    @endif
  </x-section>

  <x-section
      variant="muted"
      title="Video singkat Waduk Manduk"
      subtitle="Jelajahi waduk secara virtual melalui video highlight komunitas."
  >
    <div class="card ring-subtle overflow-hidden rounded-3xl">
      <div class="aspect-video bg-slate-100">
        <iframe
          src="https://www.youtube-nocookie.com/embed/CJ62_3lAKDE"
          title="Video wisata Waduk Manduk"
          loading="lazy"
          class="h-full w-full border-0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen
        ></iframe>
      </div>
      <div class="px-6 py-4 text-sm text-[var(--color-muted)]">
        Video lengkap akan tersedia setelah peluncuran kanal resmi YouTube Waduk Manduk.
      </div>
    </div>
  </x-section>

  <x-section title="Ketentuan penggunaan media">
    <x-alert variant="info" title="Lisensi penggunaan">
      Seluruh materi visual memiliki lisensi Creative Commons Attribution-NonCommercial. Hubungi
      <a href="mailto:media@wadukmanduk.id" class="font-semibold text-[var(--color-primary)] hover:underline">media@wadukmanduk.id</a>
      untuk permintaan file asli atau penggunaan komersial.
    </x-alert>
  </x-section>
@endsection

@once
@push('scripts')
<script>
(() => {
  const d = document.querySelector('[data-lightbox]');
  if (!d) return;

  const triggers = Array.from(document.querySelectorAll('[data-open]'));
  const img = d.querySelector('[data-view]');
  const titleEl = d.querySelector('[data-title]');
  const capEl = d.querySelector('[data-caption]');
  const btnPrev = d.querySelector('[data-prev]');
  const btnNext = d.querySelector('[data-next]');
  const btnClose = d.querySelector('[data-close]');
  let idx = 0;

  const load = (i) => {
    const t = triggers[i];
    if (!t) return;
    idx = i;
    img.src = t.dataset.src;
    img.alt = t.dataset.title || 'Gambar galeri';
    titleEl.textContent = t.dataset.title || '';
    capEl.textContent = t.dataset.caption || '';
  };

  const open = (i) => { load(i); d.showModal(); };
  const close = () => d.close();

  triggers.forEach((t, i) => {
    t.addEventListener('click', (e) => { e.preventDefault(); open(i); });
  });

  btnPrev.addEventListener('click', () => load((idx - 1 + triggers.length) % triggers.length));
  btnNext.addEventListener('click', () => load((idx + 1) % triggers.length));
  btnClose.addEventListener('click', close);

  d.addEventListener('click', (e) => { if (e.target === d) close(); });
  d.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowLeft') btnPrev.click();
    if (e.key === 'ArrowRight') btnNext.click();
  });
})();
</script>
@endpush
@endonce

