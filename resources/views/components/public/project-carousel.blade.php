@props(['projects' => []])

<x-section id="project" variant="muted" title="Agenda yang sedang berlangsung" subtitle="Event terbaru yang menambah keseruan kunjungan Anda.">
    <div class="flex gap-6 overflow-x-auto pb-4 [scroll-snap-type:x_mandatory]">
        @foreach ($projects as $project)
            <div class="w-80 flex-shrink-0 snap-center">
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img
                        src="{{ $project['image'] }}"
                        alt="{{ $project['title'] }}"
                        class="h-48 w-full object-cover"
                        loading="lazy"
                    >
                    <div class="space-y-3 p-6">
                        <h3 class="text-lg font-semibold text-slate-900">{{ $project['title'] }}</h3>
                        <p class="text-sm text-slate-600">{{ $project['description'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-section>
