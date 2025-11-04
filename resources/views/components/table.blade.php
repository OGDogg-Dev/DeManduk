@props([
    'headers' => [],
    'rows'    => [],
    'caption' => null,
])

<div class="card p-0 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      @if ($caption)
        <caption class="px-5 py-3 text-left text-sm font-medium text-[var(--color-muted)]">
          {{ $caption }}
        </caption>
      @endif

      @if (! empty($headers))
        <thead class="bg-slate-50 text-[var(--color-muted)]">
          <tr class="text-left">
            @foreach ($headers as $header)
              <th scope="col" class="px-5 py-3 text-xs font-semibold uppercase tracking-wide">
                {{ $header }}
              </th>
            @endforeach
          </tr>
        </thead>
      @endif

      <tbody class="divide-y divide-[var(--color-border)]">
        @if (! empty($rows))
          @foreach ($rows as $row)
            <tr class="hover:bg-slate-50/70 transition">
              @foreach ($row as $cell)
                <td class="px-5 py-3 align-top text-[var(--color-ink)]">
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
