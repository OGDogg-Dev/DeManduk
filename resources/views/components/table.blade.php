@props([
    'headers' => [],
    'rows'    => [],
    'caption' => null,
])

<div class="card p-0 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-xs sm:text-sm md:hidden">
      <caption class="px-3 sm:px-4 md:hidden py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-[var(--color-muted)]">
        {{ $caption }}
      </caption>
      <tbody class="divide-y divide-[var(--color-border)]">
        @if (! empty($rows))
          @foreach ($rows as $row)
            <tr class="hover:bg-slate-50/70 transition">
              <td class="p-0" colspan="100%">
                <div class="p-4 space-y-2">
                  @foreach ($row as $index => $cell)
                    @if (isset($headers[$index]))
                      <div class="flex justify-between items-start gap-2">
                        <span class="text-xs font-semibold text-[var(--color-muted)] uppercase tracking-wide">{{ $headers[$index] }}:</span>
                        <span class="text-sm text-[var(--color-ink)] flex-1 text-right">{!! $cell !!}</span>
                      </div>
                    @endif
                  @endforeach
                </div>
              </td>
            </tr>
          @endforeach
        @else
          <tr><td class="p-4 text-center text-[var(--color-muted)]">{{ $slot->isEmpty() ? 'Belum ada data' : $slot }}</td></tr>
        @endif
      </tbody>
    </table>
    
    <!-- Desktop Table Version -->
    <table class="w-full text-xs sm:text-sm hidden md:table">
      @if ($caption)
        <caption class="px-3 sm:px-4 md:px-5 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-[var(--color-muted)]">
          {{ $caption }}
        </caption>
      @endif

      @if (! empty($headers))
        <thead class="bg-slate-50 text-[var(--color-muted)]">
          <tr class="text-left">
            @foreach ($headers as $header)
              <th scope="col" class="px-3 sm:px-4 md:px-5 py-2 sm:py-3 text-[10px] sm:text-xs font-semibold uppercase tracking-wide">
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
                <td class="px-3 sm:px-4 md:px-5 py-2 sm:py-3 align-top text-[var(--color-ink)] text-xs sm:text-sm">
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
