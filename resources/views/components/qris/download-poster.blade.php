@props([
    'image' => Vite::asset('resources/images/qris/waduk-manduk-qris.svg'),
    'download' => '#',
    'format' => 'PNG',
    'formats' => 'PNG & PDF',
])

<div class="flex flex-col gap-6 rounded-3xl border border-white/15 bg-[#031838]/80 p-6 shadow-[0_26px_60px_-28px_rgba(5,23,63,0.8)] backdrop-blur md:flex-row md:items-center">
    <div class="mx-auto flex h-48 w-48 items-center justify-center overflow-hidden rounded-2xl border border-white/15 bg-[#041f45]">
        <img src="{{ $image }}" alt="Poster QRIS Waduk Manduk" class="h-full w-full object-contain" loading="lazy">
    </div>
    <div class="flex-1 space-y-3">
        <h3 class="text-lg font-semibold text-white">Unduh Poster QRIS</h3>
        <p class="text-sm leading-relaxed text-slate-200">
            Cetak poster ini dan tampilkan di loket atau area pembayaran untuk memudahkan pengunjung melakukan transaksi non-tunai.
        </p>
        <div class="flex flex-wrap items-center gap-3">
            <a
                href="{{ $download }}"
                download
                class="inline-flex items-center gap-2 rounded-full bg-amber-400 px-5 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-[#021024] shadow-sm transition hover:bg-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-200 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
            >
                Unduh {{ $format }}
            </a>
            <span class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-300">
                Format tersedia: {{ $formats }}
            </span>
        </div>
    </div>
</div>
