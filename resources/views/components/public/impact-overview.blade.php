@props([
    'stats' => [],
    'procedures' => [],
    'title' => 'Ringkasan SOP Layanan',
    'subtitle' => 'Data kunjungan terbaru dan poin utama standar operasional Waduk Manduk.',
])

<x-section id="sop-overview" variant="muted" :title="$title" :subtitle="$subtitle">
    <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
        <div class="grid gap-6 sm:grid-cols-2">
            @foreach ($stats as $stat)
                <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <p
                        class="text-3xl font-bold text-blue-600"
                        data-counter
                        data-counter-to="{{ preg_replace('/\\D/', '', $stat['value'] ?? '') }}"
                        aria-label="{{ $stat['value'] ?? '' }}"
                    >
                        0
                    </p>
                    <p class="mt-2 text-sm text-slate-600">{{ $stat['label'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
        <div class="space-y-4">
            @foreach ($procedures as $item)
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <h3 class="text-base font-semibold text-slate-900">{{ $item['title'] ?? '' }}</h3>
                    <p class="mt-2 text-sm text-slate-600">{{ $item['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-section>
