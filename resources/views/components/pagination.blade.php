@props([
    'links' => [],
    'prev' => null,
    'next' => null,
])

@if ($links)
    <nav class="flex items-center justify-between gap-4 text-slate-200" aria-label="Pagination">
        <div class="flex-1">
            @if ($prev)
                <a
                    href="{{ $prev['href'] ?? '#' }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-white/20 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:border-amber-300 hover:text-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#020f24]"
                >
                    <span aria-hidden="true"><-</span>
                    {{ $prev['label'] ?? 'Sebelumnya' }}
                </a>
            @endif
        </div>
        <ul class="flex items-center gap-1 text-sm font-semibold text-slate-200">
            @foreach ($links as $link)
                <li>
                    @if (! empty($link['href']))
                        <a
                            href="{{ $link['href'] }}"
                            @class([
                                'inline-flex h-10 w-10 items-center justify-center rounded-lg transition border border-transparent',
                                'bg-amber-400 text-[#021024] shadow-sm' => $link['active'] ?? false,
                                'border-white/15 hover:bg-white/10' => ! ($link['active'] ?? false),
                            ])
                        >
                            {{ $link['label'] ?? '' }}
                        </a>
                    @else
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-500">
                            ...
                        </span>
                    @endif
                </li>
            @endforeach
        </ul>
        <div class="flex-1 text-right">
            @if ($next)
                <a
                    href="{{ $next['href'] ?? '#' }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-white/20 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:border-amber-300 hover:text-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#020f24]"
                >
                    {{ $next['label'] ?? 'Berikutnya' }}
                    <span aria-hidden="true">-></span>
                </a>
            @endif
        </div>
    </nav>
@endif
