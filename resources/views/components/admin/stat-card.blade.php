@props([
    'label',
    'value',
    'description' => null,
    'trend' => null,
    'trendLabel' => null,
    'icon' => 'chart-bar',
])

<article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">{{ $label }}</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $value }}</p>
        </div>
        <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
            <x-admin.icon :name="$icon" class="h-6 w-6" />
        </span>
    </div>
    @if ($description)
        <p class="mt-3 text-sm text-slate-600">{{ $description }}</p>
    @endif
    @if ($trend)
        <p class="mt-3 inline-flex items-center gap-2 text-xs font-semibold {{ $trend > 0 ? 'text-emerald-600' : 'text-amber-600' }}">
            <span class="inline-flex items-center">
                {{ $trend > 0 ? '+' : '' }}{{ number_format($trend, 1) }}%
            </span>
            <span class="font-medium text-slate-500">{{ $trendLabel ?? 'Perubahan minggu ini' }}</span>
        </p>
    @endif
</article>
