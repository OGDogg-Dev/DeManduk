@props([
    'image' => Vite::asset('resources/images/qris/waduk-manduk-qris.svg'),
    'download' => '#',
    'format' => 'PNG',
    'formats' => 'PNG & PDF',
])

<div class="flex flex-col gap-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm md:flex-row md:items-center">
    <div class="mx-auto flex h-48 w-48 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
        <img src="{{ $image }}" alt="Poster QRIS Waduk Manduk" class="h-full w-full object-contain" loading="lazy">
    </div>
    <div class="flex-1 space-y-3">
        <h3 class="text-lg font-semibold text-slate-900">Unduh Poster QRIS</h3>
        <p class="text-sm leading-relaxed text-slate-600">
            Cetak poster ini dan tampilkan di loket atau area pembayaran untuk memudahkan pengunjung melakukan transaksi non-tunai.
        </p>
        <div class="flex flex-wrap items-center gap-3">
            <a
                href="{{ $download }}"
                download
                class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
                Unduh {{ $format }}
            </a>
            <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                Format tersedia: {{ $formats }}
            </span>
        </div>
    </div>
</div>
