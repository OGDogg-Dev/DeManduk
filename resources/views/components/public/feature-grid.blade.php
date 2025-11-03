@props(['features' => []])

<x-section id="service" title="Fasilitas yang tersedia" subtitle="Pelayanan lengkap untuk mendukung kenyamanan dan keamanan wisata.">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($features as $feature)
            <div class="glass-card rounded-3xl p-6 transition hover:-translate-y-1 hover:shadow-2xl">
                <h3 class="text-lg font-semibold text-white">{{ $feature['title'] }}</h3>
                <p class="mt-3 text-sm text-slate-200">{{ $feature['description'] }}</p>
            </div>
        @endforeach
    </div>
</x-section>
