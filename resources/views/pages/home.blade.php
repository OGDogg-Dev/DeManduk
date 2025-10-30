@extends('layouts.app')

@php
    $slides = [
        [
            'title' => 'New Adventure',
            'eyebrow' => 'Discover the Colorful World',
            'description' => 'Expedisi seru mengelilingi waduk dengan perahu wisata, lengkap dengan panorama sunrise dan udara sejuk.',
            'image' => Vite::asset('resources/images/gallery/1.JPG'),
            'cta' => [
                'label' => 'Jelajahi Sekarang',
                'href' => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
            ],
        ],
        [
            'title' => 'New Trip',
            'eyebrow' => 'Discover the Colorful World',
            'description' => 'Rencanakan perjalanan keluarga dengan fasilitas lengkap: kuliner, wahana air, dan ruang bermain anak.',
            'image' => Vite::asset('resources/images/gallery/3.JPG'),
            'cta' => [
                'label' => 'Rencanakan Rute',
                'href' => route('peta'),
            ],
        ],
        [
            'title' => 'New Experience',
            'eyebrow' => 'Discover the Colorful World',
            'description' => 'Nikmati pengalaman malam dengan lampion night market, live music, dan kuliner khas Manduk.',
            'image' => Vite::asset('resources/images/gallery/6.JPG'),
            'cta' => [
                'label' => 'Lihat Agenda',
                'href' => route('event.index'),
            ],
        ],
    ];

    $features = [
        ['title' => 'Panorama & Wahana Air', 'description' => 'Perahu wisata, kano, dan paddle board dengan pelampung keselamatan.'],
        ['title' => 'Kuliner & UMKM', 'description' => 'Kopi Manduk, olahan ikan, dan cendera mata khas pesisir.'],
        ['title' => 'Teknisi Berpengalaman', 'description' => 'Tim teknis menjaga setiap wahana dalam kondisi prima.'],
        ['title' => 'Pelayanan Profesional', 'description' => 'Petugas informasi siap membantu itinerary dan rekomendasi aktivitas.'],
        ['title' => 'Highly Recommended', 'description' => 'Pengunjung memberikan nilai tinggi untuk kenyamanan dan kebersihan.'],
        ['title' => 'Positive Reviews', 'description' => 'Review positif dari wisatawan lokal maupun luar kota.'],
    ];

    $projects = [
        [
            'title' => 'Festival Kuliner Manduk',
            'description' => 'Eksplorasi rasa kuliner lokal di tepi waduk dengan live cooking.',
            'image' => Vite::asset('resources/images/gallery/gallery-2.svg'),
        ],
        [
            'title' => 'Manduk Fun Paddle',
            'description' => 'Komunitas olahraga air bersatu menjaga kebersihan waduk.',
            'image' => Vite::asset('resources/images/gallery/gallery-4.svg'),
        ],
        [
            'title' => 'Lampion Night Market',
            'description' => 'Suasana malam yang magis ditemani musik akustik dan bazar UMKM.',
            'image' => Vite::asset('resources/images/gallery/gallery-3.svg'),
        ],
    ];

    $gallery = [
        ['alt' => 'Panorama senja Waduk Manduk', 'src' => Vite::asset('resources/images/gallery/gallery-1.svg')],
        ['alt' => 'Dermaga kayu', 'src' => Vite::asset('resources/images/gallery/gallery-2.svg')],
        ['alt' => 'Lampion night market', 'src' => Vite::asset('resources/images/gallery/gallery-3.svg')],
        ['alt' => 'Komunitas fun paddle', 'src' => Vite::asset('resources/images/gallery/gallery-4.svg')],
        ['alt' => 'Zona kuliner', 'src' => Vite::asset('resources/images/gallery/gallery-5.svg')],
        ['alt' => 'Sky deck wisata', 'src' => Vite::asset('resources/images/gallery/gallery-6.svg')],
    ];

    $stats = [
        ['label' => 'Total wisatawan', 'value' => '5.962'],
        ['label' => 'Rata-rata bulanan', 'value' => '2.394'],
        ['label' => 'UMKM aktif', 'value' => '1.439'],
        ['label' => 'Inisiatif sosial', 'value' => '933'],
    ];

    $faqs = [
        [
            'question' => 'Apakah waduk ini ramai dikunjungi?',
            'answer' => 'Waduk Manduk menjadi destinasi pilihan wisata keluarga dengan ribuan pengunjung setiap tahunnya.',
        ],
        [
            'question' => 'Bagaimana tren kunjungan wisata?',
            'answer' => 'Peningkatan stabil terutama saat akhir pekan dan musim liburan. Pastikan reservasi lebih awal untuk rombongan.',
        ],
        [
            'question' => 'Apa saja kegiatan ekonomi yang tumbuh?',
            'answer' => 'Lebih dari seribu UMKM kuliner, kerajinan, dan jasa wisata berkembang di sekitar kawasan.',
        ],
    ];

    $ticketRows = [
        ['Tiket masuk dewasa', 'Rp12.000', 'Sudah termasuk akses area publik dan spot foto.'],
        ['Tiket masuk anak (3-12 tahun)', 'Rp8.000', 'Gratis untuk balita dengan pendamping.'],
        ['Paket keluarga (maksimal 5 orang)', 'Rp40.000', 'Diskon 20% untuk KTP Desa Manduk.'],
        ['Parkir motor / mobil', 'Rp3.000 / Rp5.000', 'Area parkir 24 jam dengan CCTV.'],
    ];

    $facilityRows = [
        ['Perahu wisata (20 menit)', 'Rp25.000 / orang', 'Pelampung disediakan. Anak di bawah 5 tahun wajib didampingi.'],
        ['Kano dan paddle board', 'Rp35.000 / 30 menit', 'Syarat utama: bisa berenang dan gunakan rompi keselamatan.'],
        ['Sewa gazebo keluarga', 'Rp50.000 / 2 jam', 'Termasuk colokan listrik dan layanan kebersihan.'],
        ['Amphitheater mini', 'Rp250.000 / 4 jam', 'Untuk komunitas, event sekolah, prewedding. Booking minimal H-7.'],
        ['Studio podcast UMKM', 'Rp75.000 / jam', 'Termasuk operator dasar dan koneksi internet 20 Mbps.'],
    ];

    $openingRows = [
        ['Senin', '06.00 - 17.00 WIB', 'Jalur jogging dan taman dibuka lebih awal mulai pukul 05.30.'],
        ['Selasa', '06.00 - 17.00 WIB', 'Perawatan dermaga dilakukan setelah jam 17.30.'],
        ['Rabu', '06.00 - 17.00 WIB', 'Diskon 10% untuk pengunjung rombongan pelajar.'],
        ['Kamis', '06.00 - 17.00 WIB', 'Sesi senam pagi komunitas pukul 07.00.'],
        ['Jumat', '06.00 - 17.30 WIB', 'Istirahat salat Jumat pukul 11.00 - 13.00 (wahana ditutup sementara).'],
        ['Sabtu', '05.30 - 18.30 WIB', 'Live music sore dan lampion night market mulai pukul 16.30.'],
        ['Minggu', '05.30 - 18.30 WIB', 'Puncak kunjungan, parkir tambahan disiapkan di sisi timur.'],
    ];

    $serviceRows = [
        ['Pusat informasi wisata', '07.00 - 17.00 WIB', 'Layanan pemesanan wahana dan pemandu.'],
        ['Resto apung dan food court', '07.00 - 22.00 WIB', 'Live cooking tersedia Jumat sampai Minggu.'],
        ['Amphitheater dan aula serbaguna', '08.00 - 21.00 WIB', 'Booking minimal H-3 untuk event.'],
        ['Studio podcast dan media center', '09.00 - 17.00 WIB', 'Reservasi online segera tersedia.'],
    ];
@endphp

@section('hero')
  <div class="relative overflow-hidden bg-black text-white">
    <!-- Full-bleed container -->
    <div class="relative max-w-none px-0">
      <section class="py-0" role="region" aria-label="Sorotan Waduk Manduk">
        <div class="group relative" data-carousel data-autoplay="true" data-interval="3000">
          <!-- viewport scrollable (snap per slide) -->
          <div
            class="relative overflow-x-auto scroll-smooth [scroll-snap-type:x_mandatory] [-ms-overflow-style:none] [scrollbar-width:none]"
            data-viewport aria-roledescription="carousel" aria-label="Daftar slide"
          >
            <style>.group [data-viewport]::-webkit-scrollbar{display:none}</style>

            <!-- track -->
            <div class="flex gap-0" data-slides>
              @foreach ($slides as $i => $slide)
                <article
                  class="relative flex w-full min-w-full snap-center flex-col justify-end
                         md:min-h-[28rem] lg:min-h-[34rem] xl:min-h-[40rem]"
                  data-slide aria-roledescription="slide"
                  aria-label="Slide {{ $i+1 }} dari {{ count($slides) }}"
                  {{ $i === 0 ? 'aria-current=true' : '' }}
                >
                  <!-- Gambar full TANPA overlay -->
                  <div class="absolute inset-0">
                    <img
                      src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}"
                      class="h-full w-full object-cover"
                      loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                      decoding="async"
                      fetchpriority="{{ $i === 0 ? 'high' : 'low' }}"
                    >
                  </div>

                  <!-- Konten teks sederhana -->
                  <div class="relative space-y-3 p-6 sm:p-10">
                    @if(!empty($slide['eyebrow']))
                      <p class="text-xs uppercase tracking-[0.35em] text-white/90">
                        {{ $slide['eyebrow'] }}
                      </p>
                    @endif

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold uppercase text-white tracking-wide">
                      {{ $slide['title'] }}
                    </h1>

                    @if(!empty($slide['description']))
                      <p class="max-w-xl text-sm sm:text-base text-white/90">
                        {{ $slide['description'] }}
                      </p>
                    @endif

                    @if (!empty($slide['cta']))
                      <div>
                        <a href="{{ $slide['cta']['href'] ?? '#' }}"
                           class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3
                                  text-sm font-semibold uppercase tracking-wider text-slate-900
                                  transition hover:bg-slate-100 focus:outline-none
                                  focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-white/50">
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

  <!-- Auto-advance: tampil 3 detik, lalu geser 1 slide (loop) -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('[data-carousel]').forEach((carousel) => {
        const viewport = carousel.querySelector('[data-viewport]');
        const track = carousel.querySelector('[data-slides]');
        const slides = Array.from(track.querySelectorAll('[data-slide]'));
        if (!viewport || !track || slides.length === 0) return;

        let index = slides.findIndex(s => s.getAttribute('aria-current') === 'true');
        if (index < 0) index = 0;

        const intervalMs = Number(carousel.getAttribute('data-interval')) || 3000;
        const autoplay = carousel.getAttribute('data-autoplay') !== 'false';

        const setAria = (i) => {
          slides.forEach((s, k) => k === i ? s.setAttribute('aria-current', 'true') : s.removeAttribute('aria-current'));
        };

        const getLeft = (i) => slides[i].offsetLeft - track.offsetLeft;

        const goTo = (i) => {
          const next = (i + slides.length) % slides.length;

          // Saat pindah dari slide terakhir ke pertama, lakukan jump instan agar tidak "scroll balik" panjang
          const behavior = (index === slides.length - 1 && next === 0) ? 'auto' : 'smooth';

          index = next;
          viewport.scrollTo({ left: getLeft(index), behavior });
          setAria(index);
        };

        // Sinkronkan index jika user geser manual
        let syncTimer;
        viewport.addEventListener('scroll', () => {
          clearTimeout(syncTimer);
          syncTimer = setTimeout(() => {
            const { scrollLeft } = viewport;
            let nearest = 0, nearestDist = Infinity;
            slides.forEach((s, k) => {
              const d = Math.abs((s.offsetLeft - track.offsetLeft) - scrollLeft);
              if (d < nearestDist) { nearest = k; nearestDist = d; }
            });
            index = nearest;
            setAria(index);
          }, 120);
        }, { passive: true });

        // Mulai auto-advance
        if (autoplay) {
          setInterval(() => goTo(index + 1), intervalMs);
        }
      });
    });
  </script>
@endsection





@section('content')
  {{-- QUICK NAV (sticky) --}}
  <nav aria-label="Navigasi bagian halaman"
       class="sticky top-14 md:top-16 z-30 border-b border-slate-200/70 bg-white/85 backdrop-blur supports-[backdrop-filter]:bg-white/70">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
      <ul class="-mx-2 flex gap-1 overflow-x-auto py-2 text-sm font-semibold text-slate-600 [scrollbar-width:none]" data-scrollspy>
        @php
          $sections = [
            ['#about','Tentang'], ['#project','Agenda'], ['#service','Fasilitas'],
            ['#pricing','Harga'], ['#hours','Jam'], ['#map','Peta'],
            ['#faq','Stat'], ['#faq-full','FAQ']
          ];
        @endphp
        @foreach($sections as [$href,$label])
          <li>
            <a href="{{ $href }}"
               class="inline-flex items-center gap-2 rounded-lg px-3 py-2 transition hover:bg-slate-100 data-[active=true]:bg-blue-600 data-[active=true]:text-white"
               data-spy-link="{{ $href }}">{{ $label }}</a>
          </li>
        @endforeach
      </ul>
    </div>
  </nav>

  <x-section id="about" title="Mengapa harus ke Waduk Manduk" subtitle="Wisata alam yang memadukan ketenangan waduk, kuliner lokal, serta ruang aktivitas komunal.">
    <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
      <div class="space-y-5 text-slate-700">
        <p>
          Waduk Manduk dikenal sebagai destinasi wisata air yang bersih dan ramah keluarga. Pengunjung dapat menikmati
          panorama senja, berperahu santai, hingga mengikuti agenda komunitas yang rutin digelar di amphitheater.
        </p>
        <p>
          Berbagai wahana edukasi dan kuliner hadir menemani, mulai dari studio kreatif, area playground, hingga sentra UMKM
          dengan sertifikasi halal. Semua diatur rapi sehingga mudah diakses oleh semua kalangan.
        </p>
        <a href="{{ route('profile') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 transition hover:text-blue-700">
          Baca sejarah lengkap ->
        </a>
      </div>
      <div class="relative">
        <div class="aspect-square overflow-hidden rounded-3xl border border-slate-200 shadow-xl">
          <img src="{{ Vite::asset('resources/images/gallery/gallery-6.svg') }}" alt="Panorama Waduk Manduk" class="h-full w-full object-cover" loading="lazy">
        </div>
      </div>
    </div>
  </x-section>

  <x-section id="project" variant="muted" title="Agenda yang sedang berlangsung" subtitle="Event terbaru yang menambah keseruan kunjungan Anda.">
    <div class="flex gap-6 overflow-x-auto pb-4 [scroll-snap-type:x_mandatory]">
      @foreach ($projects as $project)
        <div class="w-80 flex-shrink-0 snap-center">
          <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
            <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="h-48 w-full object-cover" loading="lazy">
            <div class="space-y-3 p-6">
              <h3 class="text-lg font-semibold text-slate-900">{{ $project['title'] }}</h3>
              <p class="text-sm text-slate-600">{{ $project['description'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </x-section>

  <x-section id="service" title="Fasilitas yang tersedia" subtitle="Pelayanan lengkap untuk mendukung kenyamanan dan keamanan wisata.">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($features as $feature)
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          <h3 class="text-lg font-semibold text-slate-900">{{ $feature['title'] }}</h3>
          <p class="mt-3 text-sm text-slate-600">{{ $feature['description'] }}</p>
        </div>
      @endforeach
    </div>
  </x-section>

  <x-section id="pricing" title="Fasilitas & Harga" subtitle="Harga tiket dan fasilitas Waduk Manduk. Semua tarif mengikuti Perdes No. 04/2024 dan dapat berubah sesuai kebijakan pengelola.">
    <x-table :headers="['Jenis', 'Tarif', 'Keterangan']" :rows="$ticketRows" caption="Daftar tarif tiket dan layanan dasar." />
    <x-table :headers="['Fasilitas', 'Tarif', 'Detail layanan']" :rows="$facilityRows" caption="Tarif fasilitas tambahan dan penyewaan ruang." />
    <x-alert variant="info" title="Pemesanan rombongan">
      Rombongan 30 orang ke atas dapat menghubungi <a href="mailto:event@wadukmanduk.id" class="font-semibold text-blue-600">event@wadukmanduk.id</a>
      untuk mendapatkan jadwal khusus, pemandu wisata, serta paket konsumsi.
    </x-alert>
  </x-section>

  <x-section id="hours" variant="muted" title="Jam Operasional" subtitle="Rencanakan kunjungan Anda sesuai jadwal terbaru. Informasi ini akan diperbarui secara berkala.">
    <x-table :headers="['Hari', 'Jam buka', 'Catatan']" :rows="$openingRows" />
    <x-alert variant="warning" title="Penyesuaian musiman">
      Saat debit air meningkat di musim hujan, jam operasional dapat dipersingkat. Pantau pengumuman melalui media sosial resmi kami.
    </x-alert>
  </x-section>

  <x-section id="map" title="Peta Interaktif" subtitle="Gunakan peta di bawah untuk menemukan titik parkir, loket tiket, area kuliner, dan jalur pejalan kaki.">
    @include('partials._map')
  </x-section>

  <x-section id="faq" variant="muted" title="Skala aktivitas wisata" subtitle="Data singkat perkembangan kunjungan dan kegiatan ekonomi.">
    <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
      <div class="grid gap-6 sm:grid-cols-2">
        @foreach ($stats as $stat)
          <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
            <p class="text-3xl font-bold text-blue-600" data-counter data-counter-to="{{ preg_replace('/\\D/','',$stat['value']) }}" aria-label="{{ $stat['value'] }}">0</p>
            <p class="mt-2 text-sm text-slate-600">{{ $stat['label'] }}</p>
          </div>
        @endforeach
      </div>
      <div class="space-y-4">
        @foreach ($faqs as $faq)
          <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
            <h3 class="text-base font-semibold text-slate-900">{{ $faq['question'] }}</h3>
            <p class="mt-2 text-sm text-slate-600">{{ $faq['answer'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </x-section>

  <x-section id="faq-full" title="Pertanyaan yang sering diajukan" subtitle="Temukan jawaban seputar tiket, fasilitas, kebijakan kunjungan, hingga informasi pembayaran digital.">
    <div class="grid gap-6 md:grid-cols-2">
        <div class="space-y-4">
            <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Tiket & Kunjungan</h3>
            <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <summary class="cursor-pointer text-base font-semibold text-slate-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                    Apakah tiket bisa dibeli online?
                </summary>
                <p class="mt-3 text-sm text-slate-600">
                    Untuk saat ini tiket tersedia di loket utama. Sistem pembelian online akan diintegrasikan pada fase backend portal ini.
                </p>
            </details>
            <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <summary class="cursor-pointer text-base font-semibold text-slate-800">
                    Apakah ada diskon untuk warga lokal?
                </summary>
                <p class="mt-3 text-sm text-slate-600">
                    Ya, pemegang KTP Desa Manduk mendapatkan diskon 20% untuk tiket masuk dan sewa gazebo.
                </p>
            </details>
            <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <summary class="cursor-pointer text-base font-semibold text-slate-800">
                    Apakah diperbolehkan membawa makanan dari luar?
                </summary>
                <p class="mt-3 text-sm text-slate-600">
                    Boleh, selama menjaga kebersihan area. Dilarang membawa kompor gas portabel dan alkohol.
                </p>
            </details>
        </div>
        <div class="space-y-4">
            <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Fasilitas & Layanan</h3>
            <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <summary class="cursor-pointer text-base font-semibold text-slate-800">
                    Apakah tersedia kursi roda atau stroller?
                </summary>
                <p class="mt-3 text-sm text-slate-600">
                    Kursi roda dapat dipinjam gratis di pusat informasi dengan meninggalkan identitas. Stroller pribadi diperbolehkan.
                </p>
            </details>
            <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <summary class="cursor-pointer text-base font-semibold text-slate-800">
                    Bagaimana jika hujan deras?
                </summary>
                <p class="mt-3 text-sm text-slate-600">
                    Petugas akan mengumumkan penutupan sementara wahana air. Pengembalian dana dilakukan di loket dengan menunjukkan tiket.
                </p>
            </details>
            <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <summary class="cursor-pointer text-base font-semibold text-slate-800">
                    Apakah ada area bermain anak?
                </summary>
                <p class="mt-3 text-sm text-slate-600">
                    Tersedia playground outdoor, taman sensorik, dan kursus mini memancing anak dengan pendampingan petugas.
                </p>
            </details>
        </div>
    </div>
  </x-section>

  <x-section variant="muted">
    <div class="flex flex-col gap-4 text-center sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h3 class="text-xl font-semibold text-slate-900">Siap berkunjung ke Waduk Manduk?</h3>
        <p class="text-sm text-slate-600">Lihat rute, jam operasional, dan daftar fasilitas lengkap sebelum berangkat.</p>
      </div>
      <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
        <a href="#map" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
          Buka Peta Interaktif
        </a>
        <a href="#pricing" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-blue-400 hover:text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
          Lihat Fasilitas & Harga
        </a>
      </div>
    </div>
  </x-section>

  <!-- Back to top -->
  <button type="button" data-backtotop
    class="fixed bottom-5 right-5 z-40 hidden rounded-full border border-slate-200 bg-white/90 p-3 text-slate-700 shadow-md backdrop-blur transition hover:bg-white focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
    aria-label="Kembali ke atas">↑</button>
@endsection

@push('scripts')
<script>
(() => {
  const prefersReduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const clamp = (n, min, max) => Math.max(min, Math.min(max, n));

  // ===== Carousel =====
  const c = document.querySelector('[data-carousel]');
  if (c) {
    const vp = c.querySelector('[data-slides]');
    const slides = [...c.querySelectorAll('[data-slide]')];
    const dots = [...c.querySelectorAll('[data-slide-to]')];
    const prev = c.querySelector('[data-slide-prev]');
    const next = c.querySelector('[data-slide-next]');
    let i = 0, t = null, interval = parseInt(c.dataset.interval || '6000', 10);

    const go = (to, smooth = true) => {
      i = clamp(to, 0, slides.length - 1);
      vp.scrollTo({ left: slides[i].offsetLeft - vp.offsetLeft, behavior: smooth && !prefersReduced ? 'smooth' : 'auto' });
      upd();
    };
    const upd = () => {
      dots.forEach((d, k) => { d.dataset.active = (k===i)+''; d.setAttribute('aria-current', k===i ? 'true' : 'false'); });
      slides.forEach((s, k) => s.setAttribute('aria-current', k===i ? 'true' : 'false'));
    };
    const snapIndex = () => {
      const center = vp.scrollLeft + vp.clientWidth/2;
      let near = 0, dist = Infinity;
      slides.forEach((s, k) => {
        const mid = s.offsetLeft + s.clientWidth/2;
        const d = Math.abs(mid - center);
        if (d < dist) { dist = d; near = k; }
      });
      if (near !== i) { i = near; upd(); }
    };
    const start = () => {
      if (c.dataset.autoplay !== 'true' || prefersReduced) return;
      stop(); t = setInterval(() => go(i+1), interval);
    };
    const stop = () => { if (t) clearInterval(t); t = null; };

    prev?.addEventListener('click', () => go(i-1));
    next?.addEventListener('click', () => go(i+1));
    dots.forEach((d) => d.addEventListener('click', () => go(parseInt(d.dataset.slideTo,10))));
    vp.addEventListener('scroll', () => requestAnimationFrame(snapIndex));
    c.addEventListener('mouseenter', stop); c.addEventListener('mouseleave', start);
    c.addEventListener('focusin', stop);    c.addEventListener('focusout', start);
    document.addEventListener('keydown', e => {
      if (!c.contains(document.activeElement)) return;
      if (e.key==='ArrowLeft') go(i-1);
      if (e.key==='ArrowRight') go(i+1);
    });
    upd(); start(); addEventListener('resize', () => go(i, false));
  }

  // ===== Scroll-spy Quick Nav =====
  const spyLinks = [...document.querySelectorAll('[data-spy-link]')];
  if (spyLinks.length) {
    const header = document.querySelector('header');
    const headerH = () => (header?.offsetHeight || 72) + 8;
    spyLinks.forEach(a => {
      a.addEventListener('click', e => {
        e.preventDefault();
        const target = document.querySelector(a.getAttribute('href'));
        if (!target) return;
        const top = target.getBoundingClientRect().top + scrollY - headerH() - 40; // offset tambahan untuk quick-nav
        scrollTo({ top, behavior: prefersReduced ? 'auto' : 'smooth' });
      });
    });
    if ('IntersectionObserver' in window) {
      const io = new IntersectionObserver(entries => {
        entries.forEach(({ target, isIntersecting }) => {
          const link = spyLinks.find(a => a.getAttribute('href') === '#' + target.id);
          if (link) link.dataset.active = isIntersecting ? 'true' : 'false';
        });
      }, { rootMargin: `-${headerH()+56}px 0px -60% 0px`, threshold: 0.1 });
      const ids = spyLinks.map(a => a.getAttribute('href')).filter(Boolean);
      ids.forEach(id => { const sec = document.querySelector(id); sec && io.observe(sec); });
    }
  }

  // ===== Animated Counters =====
  const counters = document.querySelectorAll('[data-counter]');
  const anim = el => {
    const goal = parseInt(el.dataset.counterTo || '0',10);
    const dur = prefersReduced ? 0 : 1200;
    if (!dur) { el.textContent = new Intl.NumberFormat('id-ID').format(goal); return; }
    const t0 = performance.now();
    const step = (t) => {
      const p = Math.min(1, (t - t0) / dur);
      const val = Math.floor(goal * (p < .5 ? 2*p*p : -1 + (4 - 2*p)*p)); // easeInOutQuad
      el.textContent = new Intl.NumberFormat('id-ID').format(val);
      if (p < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  };
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(es => es.forEach(({target,isIntersecting}) => {
      if (isIntersecting && !target.dataset.done) { anim(target); target.dataset.done='1'; io.unobserve(target); }
    }), { threshold: .5 });
    counters.forEach(el => io.observe(el));
  } else counters.forEach(anim);

  // ===== Back to top =====
  const topBtn = document.querySelector('[data-backtotop]');
  if (topBtn) {
    const onScroll = () => { topBtn.style.display = (scrollY > 600) ? 'inline-flex' : 'none'; };
    addEventListener('scroll', onScroll, { passive:true }); onScroll();
    topBtn.addEventListener('click', () => scrollTo({ top: 0, behavior: prefersReduced ? 'auto' : 'smooth' }));
  }
})();
</script>
@endpush
