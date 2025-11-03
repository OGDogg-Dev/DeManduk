@php
    $brandTitle = $siteTitle ?? "D'Manduk";
    $brandLogo = \App\Support\Media::url($siteLogoPath ?? null);
    $brandInitials = strtoupper(mb_substr($brandTitle, 0, 2));

    $contactAddress = \App\Models\SiteSetting::getValue('contact.address');
    $contactPhone = \App\Models\SiteSetting::getValue('contact.phone');
    $contactEmail = \App\Models\SiteSetting::getValue('contact.email');

    $contactSupports = \App\Models\ContactSupport::query()
        ->orderBy('sort_order')
        ->orderBy('id')
        ->limit(5)
        ->get();

    $footerSections = [
        ['#about', 'Tentang'],
        ['#project', 'Agenda'],
        ['#service', 'Fasilitas'],
        ['#pricing', 'Harga'],
        ['#hours', 'Jam'],
        ['#map', 'Peta'],
        ['#sop-overview', 'SOP'],
        ['#sop-detail', 'Panduan'],
    ];
    $homeUrl = route('home');
@endphp

<footer class="border-t border-white/10 bg-[#010d22]">
    <div class="mx-auto flex max-w-6xl flex-col gap-16 px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 md:grid-cols-4">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3">
                    @if ($brandLogo)
                        <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}" class="h-12 w-12 rounded-full bg-white/10 object-cover ring-1 ring-white/15">
                    @else
                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-[#0f2c53] font-semibold text-white ring-1 ring-white/20">
                            {{ $brandInitials }}
                        </span>
                    @endif
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.4em] text-white/50">Portal Resmi</p>
                        <p class="text-xl font-bold text-white">{{ $brandTitle }}</p>
                    </div>
                </div>
                <p class="mt-6 max-w-xl text-sm text-slate-300">
                    Destinasi wisata air yang menyuguhkan panorama waduk, ruang komunitas, serta ekosistem UMKM desa. Situs ini menyajikan informasi terbaru mengenai agenda, layanan, dan fasilitas D'Manduk.
                </p>
            </div>
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-[0.35em] text-amber-300">Kontak Darurat</h3>
                    <ul class="mt-4 space-y-3 text-sm text-slate-200">
                        <li>
                            <span class="font-semibold text-white">Alamat:</span>
                            <span>{{ $contactAddress ?: 'Alamat akan diperbarui.' }}</span>
                        </li>
                        <li>
                            <span class="font-semibold text-white">Telepon:</span>
                            @if ($contactPhone)
                                <a href="tel:{{ $contactPhone }}" class="font-semibold text-amber-300 hover:text-amber-200">{{ $contactPhone }}</a>
                            @else
                                <span>Nomor telepon belum tersedia.</span>
                            @endif
                        </li>
                        <li>
                            <span class="font-semibold text-white">Email:</span>
                            @if ($contactEmail)
                                <a href="mailto:{{ $contactEmail }}" class="font-semibold text-amber-300 hover:text-amber-200">{{ $contactEmail }}</a>
                            @else
                                <span>Email belum tersedia.</span>
                            @endif
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">Instansi Pendukung</h4>
                    <ul class="mt-3 space-y-2 text-sm text-slate-300">
                        @forelse ($contactSupports as $support)
                            <li>
                                <span class="font-semibold text-white">{{ $support->title }}</span>
                                @if ($support->description)
                                    <span class="text-slate-400"> &mdash; {{ $support->description }}</span>
                                @endif
                            </li>
                        @empty
                            <li>Daftar instansi akan segera tersedia.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-[0.35em] text-amber-300">Navigasi</h3>
                <ul class="mt-4 space-y-2 text-sm text-slate-200">
                    @foreach ($footerSections as [$fragment, $label])
                        <li>
                            <a href="{{ $homeUrl . $fragment }}" class="hover:text-amber-300">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="navy-divider"></div>
        <div class="flex flex-col gap-4 pt-6 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-slate-400">
                &copy; {{ now()->year }} Pemerintah Desa Manduk. Semua hak cipta dilindungi.
            </p>
            <div class="flex items-center gap-4 text-xs font-semibold text-slate-300">
                <a href="{{ route('sop') }}" class="hover:text-amber-300">SOP</a>
                <a href="{{ route('kontak') }}" class="hover:text-amber-300">Hubungi Kami</a>
                <a href="{{ route('qris') }}" class="hover:text-amber-300">Kebijakan Pembayaran</a>
            </div>
        </div>
    </div>
</footer>
