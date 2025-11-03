@props([
    'steps' => [],
])

<ol class="grid gap-6 md:grid-cols-2">
    @foreach ($steps as $index => $step)
        <li class="flex gap-4 rounded-2xl border border-white/15 bg-[#031838]/80 p-5 shadow-[0_24px_60px_-28px_rgba(5,23,63,0.8)] backdrop-blur">
            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-amber-400/20 text-sm font-semibold text-amber-300">
                {{ $index + 1 }}
            </div>
            <div class="space-y-2">
                <h3 class="text-base font-semibold text-white">
                    {{ $step['title'] ?? 'Langkah' }}
                </h3>
                <p class="text-sm leading-relaxed text-slate-200">
                    {{ $step['description'] ?? '' }}
                </p>
            </div>
        </li>
    @endforeach
</ol>
