@props([
    'steps' => [],
])

<ol class="grid gap-6 md:grid-cols-2">
    @foreach ($steps as $index => $step)
        <li class="flex gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 text-sm font-semibold text-blue-700">
                {{ $index + 1 }}
            </div>
            <div class="space-y-2">
                <h3 class="text-base font-semibold text-slate-900">
                    {{ $step['title'] ?? 'Langkah' }}
                </h3>
                <p class="text-sm leading-relaxed text-slate-600">
                    {{ $step['description'] ?? '' }}
                </p>
            </div>
        </li>
    @endforeach
</ol>
