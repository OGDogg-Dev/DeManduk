@props([
    'headers' => [],
    'rows' => [],
    'caption' => null,
])

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse">
            @if ($caption)
                <caption class="bg-slate-100 px-4 py-3 text-left text-sm font-semibold text-slate-600">
                    {{ $caption }}
                </caption>
            @endif
            @if (! empty($headers))
                <thead class="bg-slate-100 text-left text-sm font-semibold uppercase tracking-widest text-slate-600">
                    <tr>
                        @foreach ($headers as $header)
                            <th scope="col" class="px-4 py-3">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif
            <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                @if (! empty($rows))
                    @foreach ($rows as $row)
                        <tr class="hover:bg-slate-50 transition">
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
