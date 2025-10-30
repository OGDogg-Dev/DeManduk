@props([
    'links' => [],
    'prev' => null,
    'next' => null,
])

@if ($links)
    <nav class="flex items-center justify-between gap-4" aria-label="Pagination">
        <div class="flex-1">
            @if ($prev)
                <a
                    href="{{ $prev['href'] ?? '#' }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-blue-400 hover:text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    <span aria-hidden="true"><-</span>
                    {{ $prev['label'] ?? 'Sebelumnya' }}
                </a>
            @endif
        </div>
        <ul class="flex items-center gap-1 text-sm font-semibold text-slate-600">
            @foreach ($links as $link)
                <li>
                    @if (! empty($link['href']))
                        <a
                            href="{{ $link['href'] }}"
                            @class([
                                'inline-flex h-10 w-10 items-center justify-center rounded-lg transition',
                                'bg-blue-600 text-white shadow-sm' => $link['active'] ?? false,
                                'hover:bg-slate-100' => ! ($link['active'] ?? false),
                            ])
                        >
                            {{ $link['label'] ?? '' }}
                        </a>
                    @else
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-400">
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
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-blue-400 hover:text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    {{ $next['label'] ?? 'Berikutnya' }}
                    <span aria-hidden="true">-></span>
                </a>
            @endif
        </div>
    </nav>
@endif
