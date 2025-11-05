@php
    $brandTitle    = $siteTitle ?? "D'Manduk";
    $brandLogo     = \App\Support\Media::url($siteLogoPath ?? null);
    $brandInitials = strtoupper(mb_substr($brandTitle, 0, 2));

    $contactAddress = \App\Models\SiteSetting::getValue('contact.address');
    $contactPhone   = \App\Models\SiteSetting::getValue('contact.phone');
    $contactEmail   = \App\Models\SiteSetting::getValue('contact.email');

    $contactSupports = \App\Models\ContactSupport::query()
        ->orderBy('sort_order')
        ->orderBy('id')
        ->limit(5)
        ->get();

    // Get social media links from settings (default to placeholders if not set)
    $socialFacebook = \App\Models\SiteSetting::getValue('social.facebook', '#');
    $socialInstagram = \App\Models\SiteSetting::getValue('social.instagram', '#');
    $socialTwitter = \App\Models\SiteSetting::getValue('social.twitter', '#');
    $socialYoutube = \App\Models\SiteSetting::getValue('social.youtube', '#');

    $footerSections = [
        ['#about',       'Tentang'],
        ['#project',     'Agenda'],
        ['#service',     'Fasilitas'],
        ['#pricing',     'Harga'],
        ['#hours',       'Jam'],
        ['#map',         'Peta'],
        ['#sop-overview','SOP'],
        ['#sop-detail',  'Panduan'],
    ];

    $homeUrl = route('home');
@endphp

<footer aria-labelledby="footer-heading" class="border-t border-[var(--color-border)] bg-[var(--color-bg)]">
  <div class="container-app py-14">
    <div class="grid gap-12 md:grid-cols-4">
      {{-- Brand + intro --}}
      <div class="md:col-span-2">
        <div class="flex items-center gap-3">
          @if ($brandLogo)
            <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}"
                 class="h-12 w-12 rounded-xl object-cover ring-subtle" />
          @else
            <span class="grid h-12 w-12 place-content-center rounded-xl bg-slate-200 text-slate-800 ring-subtle font-semibold">
              {{ $brandInitials }}
            </span>
          @endif
          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">Portal Resmi</p>
            <p class="text-xl font-semibold text-[var(--color-ink)]">{{ $brandTitle }}</p>
            
            {{-- Social media links --}}
            <div class="flex items-center gap-4 mt-3">
              <a href="{{ $socialFacebook }}" 
                 aria-label="Facebook"
                 class="text-[var(--color-ink)] hover:text-[var(--color-primary)] transition-colors">
                <i class="fa fa-facebook"></i>
              </a>
              <a href="{{ $socialInstagram }}" 
                 aria-label="Instagram"
                 class="text-[var(--color-ink)] hover:text-[var(--color-primary)] transition-colors">
                <i class="fa fa-instagram"></i>
              </a>
              <a href="{{ $socialTwitter }}" 
                 aria-label="Twitter"
                 class="text-[var(--color-ink)] hover:text-[var(--color-primary)] transition-colors">
                <i class="fa fa-twitter"></i>
              </a>
              <a href="{{ $socialYoutube }}" 
                 aria-label="YouTube"
                 class="text-[var(--color-ink)] hover:text-[var(--color-primary)] transition-colors">
                <i class="fa fa-youtube"></i>
              </a>
            </div>
          </div>
        </div>
        <p class="mt-4 max-w-xl text-[15px] leading-7 text-[var(--color-muted)]">
          Destinasi wisata air yang menyuguhkan panorama waduk, ruang komunitas, serta ekosistem UMKM desa.
          Situs ini menyajikan informasi terbaru mengenai agenda, layanan, dan fasilitas D’Manduk.
        </p>
      </div>
      {{-- Kontak --}}
      <div>
        <h3 class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]" id="footer-heading">Kontak</h3>
        <ul class="mt-3 space-y-2 text-sm">
          <li class="text-[var(--color-ink)]">
            <span class="font-semibold">Alamat:</span>
            <span class="text-[var(--color-muted)]">{{ $contactAddress ?: 'Alamat akan diperbarui.' }}</span>
          </li>
          <li class="text-[var(--color-ink)]">
            <span class="font-semibold">Telepon:</span>
            @if ($contactPhone)
              <a href="tel:{{ $contactPhone }}" class="text-[var(--color-primary)] hover:underline">{{ $contactPhone }}</a>
            @else
              <span class="text-[var(--color-muted)]">Nomor telepon belum tersedia.</span>
            @endif
          </li>
          <li class="text-[var(--color-ink)]">
            <span class="font-semibold">Email:</span>
            @if ($contactEmail)
              <a href="mailto:{{ $contactEmail }}" class="text-[var(--color-primary)] hover:underline">{{ $contactEmail }}</a>
            @else
              <span class="text-[var(--color-muted)]">Email belum tersedia.</span>
            @endif
          </li>
        </ul>
      </div>
      
      {{-- Instansi Pendukung --}}
      <div>
        <h4 class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">Instansi Pendukung</h4>
        <ul class="mt-3 space-y-3 text-sm">
          @forelse ($contactSupports as $support)
            <li class="text-[var(--color-ink)]">
              <div class="font-medium">{{ $support->title }}</div>
              @if ($support->phone)
                <div class="text-[var(--color-primary)] text-xs mt-1">
                  <a href="tel:{{ $support->phone }}" class="hover:underline">{{ $support->phone }}</a>
                </div>
              @endif
              @if ($support->description)
                <div class="text-[var(--color-muted)] text-xs mt-1">{{ $support->description }}</div>
              @endif
            </li>
          @empty
            <li class="text-[var(--color-muted)]">Daftar instansi akan segera tersedia.</li>
          @endforelse
        </ul>
      </div>
    </div>

    <div class="divider my-8"></div>

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <p class="text-xs text-[var(--color-muted)]">
        &copy; {{ now()->year }} PKM-PMM Polinus. Semua hak cipta dilindungi.
      </p>
      <div class="flex flex-wrap items-center gap-4 text-xs">
        <a href="{{ route('sop') }}" class="text-[var(--color-ink)] hover:text-[var(--color-primary)]">SOP</a>
        <a href="{{ route('kontak') }}" class="text-[var(--color-ink)] hover:text-[var(--color-primary)]">Hubungi Kami</a>
        <a href="{{ route('qris') }}" class="text-[var(--color-ink)] hover:text-[var(--color-primary)]">Kebijakan Pembayaran</a>
      </div>
    </div>
  </div>
</footer>
