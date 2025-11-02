@props(['features' => []])

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
