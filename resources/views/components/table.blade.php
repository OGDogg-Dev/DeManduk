@props([
    'headers' => [],
    'rows' => [],
    'caption' => null,
])

<div class="glass-card overflow-hidden rounded-2xl">
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse">
            @if ($caption)
                <caption class="bg-white/5 px-4 py-3 text-left text-sm font-semibold uppercase tracking-[0.2em] text-amber-300">
                    {{ $caption }}
                </caption>
            @endif
            @if (! empty($headers))
                <thead class="bg-white/10 text-left text-xs font-semibold uppercase tracking-[0.3em] text-slate-200">
                    <tr>
                        @foreach ($headers as $header)
                            <th scope="col" class="px-4 py-4">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif
            <tbody class="divide-y divide-white/10 text-sm text-slate-200">
                @if (! empty($rows))
                    @foreach ($rows as $row)
                        <tr class="transition hover:bg-white/5">
                            @foreach ($row as $cell)
                                <td class="px-4 py-3 align-top">
                                    {!! $cell !!}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @else
                    {{ $slot }}
                @endif
            </tbody>
        </table>
    </div>
</div>
