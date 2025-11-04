@extends('layouts.app', [
    'title' => 'QRIS — Waduk Manduk',
    'description' => "Informasi QRIS resmi Waduk Manduk: langkah pemindaian, catatan transaksi, unduhan poster QR, dan FAQ.",
])

@section('content')
    @php
        // Normalisasi data agar aman saat null/empty
        $stepsArr = collect($steps ?? [])->map(fn($s) => [
            'title' => data_get($s, 'title'),
            'description' => data_get($s, 'description'),
        ])->filter(fn($s) => filled($s['title']) || filled($s['description']))->values()->all();

        $notesCol = collect($notes ?? []);
        $faqsCol  = collect($faqs ?? []);

        $posterArr = is_array($poster ?? null) ? $poster : [];
        $posterUrl = data_get($posterArr, 'download'); // absolut/relative URL ke gambar/PDF poster
        $posterFmt = data_get($posterArr, 'format', 'Unduh');
        $posterFmts = data_get($posterArr, 'formats', null);
    @endphp

    <x-section class="py-12">
        <div class="text-center mb-12 animate-fade-in">
            <div class="inline-flex items-center justify-center gap-3 mb-4">
                <div class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-[var(--color-ink)] mb-4">Pembayaran Digital QRIS</h1>
            <p class="text-xl text-[var(--color-muted)] max-w-3xl mx-auto">
                {{ $subtitle ?? 'Nikmati transaksi non-tunai yang cepat, aman, dan praktis di seluruh area Waduk Manduk menggunakan kode QRIS resmi.' }}
            </p>
        </div>

        <div class="grid gap-8 lg:grid-cols-1 lg:lg:grid-cols-[1.4fr_0.6fr]">
            <div class="space-y-8">
                {{-- Alert utama (opsional) --}}
                @if (data_get($primaryAlert ?? [], 'title'))
                    <div class="bg-[var(--color-surface)] rounded-2xl border-l-4 border-[var(--color-primary)] p-5 shadow-sm animate-slide-up">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[var(--color-ink)]">{{ data_get($primaryAlert, 'title') }}</h3>
                                <div class="mt-2 text-sm text-[var(--color-muted)]">{!! data_get($primaryAlert, 'body') !!}</div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-[var(--color-surface)] rounded-2xl border-l-4 border-blue-500 p-5 shadow-sm animate-slide-up">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[var(--color-ink)]">Pembayaran dilakukan di lokasi</h3>
                                <p class="mt-2 text-sm text-[var(--color-muted)]">
                                    Website ini <strong>tidak memproses transaksi</strong>. Silakan pindai <strong>QRIS resmi pengelola</strong> pada loket/booth di area Waduk Manduk.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Langkah-langkah pemakaian QRIS --}}
                @if (!empty($stepsArr))
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-[var(--color-ink)] mb-6 flex items-center gap-3">
                            <svg class="w-8 h-8 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Cara Pembayaran dengan QRIS
                        </h2>
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach ($stepsArr as $index => $step)
                                <div class="group bg-[var(--color-surface)] rounded-xl p-5 shadow-sm border border-[var(--color-border)] transition-all duration-300 hover:shadow-md hover:border-[var(--color-primary)]/30">
                                    <div class="flex flex-col h-full">
                                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mb-4 group-hover:bg-[var(--color-primary)] group-hover:text-white transition-colors duration-300">
                                            <span class="text-xl font-bold text-indigo-600 group-hover:text-white">{{ $index + 1 }}</span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-[var(--color-ink)] mb-2">{{ $step['title'] }}</h3>
                                        <p class="text-sm text-[var(--color-muted)] flex-grow">{{ $step['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-[var(--color-surface)] rounded-2xl border border-[var(--color-border)] p-6 shadow-sm">
                        <h3 class="text-xl font-semibold text-[var(--color-ink)] mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Cara bayar dengan QRIS di lokasi
                        </h3>
                        <ol class="mt-4 space-y-4">
                            <li class="flex items-start gap-4 p-4 rounded-lg bg-[var(--color-elev)]/50 hover:bg-[var(--color-elev)] transition-colors">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center font-semibold text-indigo-600">1</span>
                                <div>
                                    <h4 class="font-semibold text-[var(--color-ink)]">Buka aplikasi pembayaran</h4>
                                    <p class="text-sm text-[var(--color-muted)]">Gunakan aplikasi yang mendukung fitur QRIS seperti DANA, OVO, GoPay, dll.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4 p-4 rounded-lg bg-[var(--color-elev)]/50 hover:bg-[var(--color-elev)] transition-colors">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center font-semibold text-indigo-600">2</span>
                                <div>
                                    <h4 class="font-semibold text-[var(--color-ink)]">Pindai kode QR</h4>
                                    <p class="text-sm text-[var(--color-muted)]">Temukan kode QRIS resmi Waduk Manduk pada loket atau booth pembayaran.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4 p-4 rounded-lg bg-[var(--color-elev)]/50 hover:bg-[var(--color-elev)] transition-colors">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center font-semibold text-indigo-600">3</span>
                                <div>
                                    <h4 class="font-semibold text-[var(--color-ink)]">Masukkan jumlah pembayaran</h4>
                                    <p class="text-sm text-[var(--color-muted)]">Pastikan jumlah pembayaran sesuai dengan harga fasilitas yang Anda pilih.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4 p-4 rounded-lg bg-[var(--color-elev)]/50 hover:bg-[var(--color-elev)] transition-colors">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center font-semibold text-indigo-600">4</span>
                                <div>
                                    <h4 class="font-semibold text-[var(--color-ink)]">Tunjukkan bukti pembayaran</h4>
                                    <p class="text-sm text-[var(--color-muted)]">Perlihatkan bukti pembayaran digital ke petugas untuk verifikasi.</p>
                                </div>
                            </li>
                        </ol>
                    </div>
                @endif

                {{-- Catatan transaksi (opsional) --}}
                @if ($notesCol->isNotEmpty())
                    <div class="bg-[var(--color-surface)] rounded-2xl border border-[var(--color-border)] p-6 shadow-sm">
                        <h3 class="text-xl font-semibold text-[var(--color-ink)] mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Catatan Penting Transaksi
                        </h3>
                        <ul class="space-y-3">
                            @foreach ($notesCol as $note)
                                <li class="flex items-start gap-3 p-3 rounded-lg bg-[var(--color-elev)]/30 hover:bg-[var(--color-elev)]/50 transition-colors">
                                    <svg class="w-5 h-5 text-[var(--color-primary)] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-[var(--color-ink)]">{{ data_get($note, 'content') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- Sisi kanan: Poster / unduhan --}}
            <div class="space-y-8">
                @if ($posterUrl)
                    <div class="bg-[var(--color-surface)] rounded-2xl border border-[var(--color-border)] overflow-hidden shadow-sm">
                        <div class="aspect-[4/5] bg-gradient-to-br from-[var(--color-primary-100)] to-[var(--color-surface)] flex items-center justify-center">
                            @if (Str::endsWith($posterUrl, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <img
                                    src="{{ $posterUrl }}"
                                    alt="Poster QRIS Waduk Manduk"
                                    class="h-full w-full object-contain max-h-[400px]"
                                    loading="lazy"
                                >
                            @else
                                <div class="text-center p-8">
                                    <svg class="w-16 h-16 text-[var(--color-muted)] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-[var(--color-ink)]">Poster QRIS</h3>
                                    <p class="text-sm text-[var(--color-muted)] mt-2">Klik tombol di bawah untuk mengunduh</p>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-base font-semibold text-[var(--color-ink)]">Poster Panduan QRIS</h3>
                                    <p class="text-xs text-[var(--color-muted)] uppercase tracking-wide mt-1">{{ $posterFmts ?? 'File tersedia' }}</p>
                                </div>
                                <a
                                    href="{{ $posterUrl }}"
                                    download
                                    class="inline-flex items-center gap-2 rounded-lg bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[var(--color-primary-600)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]/30"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-[var(--color-surface)] rounded-2xl border border-dashed border-[var(--color-border)] p-8 text-center">
                        <svg class="w-12 h-12 text-[var(--color-muted)] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-[var(--color-ink)]">Poster Tidak Tersedia</h3>
                        <p class="text-sm text-[var(--color-muted)] mt-2">
                            Poster QRIS belum tersedia untuk diunduh. Silakan periksa kembali nanti.
                        </p>
                    </div>
                @endif

                {{-- Tips keamanan --}}
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-[var(--color-border)] p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-[var(--color-ink)] mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Tips Keamanan Pembayaran
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm text-[var(--color-ink)]">Pastikan QR menampilkan nama penerima resmi <strong>Waduk Manduk</strong></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm text-[var(--color-ink)]">Jangan membagikan kode OTP/PIN kepada siapa pun</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm text-[var(--color-ink)]">Perhatikan pengumuman di loket jika terjadi kendala jaringan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </x-section>

    {{-- FAQ --}}
    @if ($faqsCol->isNotEmpty())
        <x-section variant="muted" class="py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[var(--color-ink)] mb-4">Pertanyaan Umum (FAQ)</h2>
                <p class="text-lg text-[var(--color-muted)] max-w-2xl mx-auto">
                    Temukan jawaban atas pertanyaan-pertanyaan umum seputar pembayaran QRIS di Waduk Manduk.
                </p>
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($faqsCol as $faq)
                    <div class="bg-white rounded-xl border border-[var(--color-border)] p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                @if (data_get($faq, 'icon'))
                                    <i class="{{ data_get($faq, 'icon', 'fa fa-question-circle') }} text-[var(--color-primary)] text-xl"></i>
                                @else
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0-3h7.5a2.25 2.25 0 012.25 2.25M4.318 3.622a.75.75 0 01.729.54l.009.03c.132.423.468.72.89.72.507 0 .962-.366 1.083-.88.07-.28.256-.527.5-.714a1.127 1.127 0 011.524 0c.244.187.43.434.5.714.121.514.576.88 1.083.88.422 0 .758-.297.89-.72l.009-.03c.07-.224.187-.417.34-.545a1.127 1.127 0 011.726 1.23c-.28.16-.592.27-.925.31-.048.03-.097.06-.147.09-.083.05-.169.1-.255.147a1.127 1.127 0 01-1.524 0c-.086-.047-.172-.097-.255-.147-.05-.03-.099-.06-.147-.09-.333-.04-.645-.15-.925-.31a1.127 1.127 0 01-.34-.545z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[var(--color-ink)] mb-2">{{ data_get($faq, 'title') }}</h3>
                                <p class="text-sm text-[var(--color-muted)]">{{ data_get($faq, 'body') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-section>

        @push('head')
            @php
                // Schema.org FAQPage
                $faqJson = [
                    '@context' => 'https://schema.org',
                    '@type'    => 'FAQPage',
                    'mainEntity' => $faqsCol->map(function ($f) {
                        return [
                            '@type' => 'Question',
                            'name'  => (string) data_get($f, 'title', ''),
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => (string) data_get($f, 'body', ''),
                            ],
                        ];
                    })->values()->all(),
                ];
            @endphp
            <script type="application/ld+json">{!! json_encode($faqJson, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
        @endpush
    @endif

    {{-- Alert bawah (opsional) --}}
    @if (data_get($bottomAlert ?? [], 'title'))
        <x-section class="py-12">
            <div class="max-w-3xl mx-auto">
                <div class="bg-[var(--color-surface)] rounded-2xl border-l-4 {{ data_get($bottomAlert, 'variant') === 'success' ? 'border-emerald-500' : (data_get($bottomAlert, 'variant') === 'warning' ? 'border-amber-500' : 'border-rose-500') }} p-6 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            @if (data_get($bottomAlert, 'variant') === 'success')
                                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @elseif (data_get($bottomAlert, 'variant') === 'warning')
                                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.33 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-[var(--color-ink)]">{{ data_get($bottomAlert, 'title') }}</h3>
                            <div class="mt-2 text-sm text-[var(--color-muted)]">{!! data_get($bottomAlert, 'body') !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </x-section>
    @endif
@endsection
