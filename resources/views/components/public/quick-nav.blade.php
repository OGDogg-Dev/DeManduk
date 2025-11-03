@props(['sections' => []])

<nav
    aria-label="Navigasi bagian halaman"
    class="sticky top-16 z-30 border-y border-white/10 bg-[#041734]/90 backdrop-blur supports-[backdrop-filter]:bg-[#041734]/75 md:top-20"
>
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <ul
            class="-mx-2 flex gap-2 overflow-x-auto py-3 text-xs font-semibold uppercase tracking-[0.35em] text-white/60 [scrollbar-width:none]"
            data-scrollspy
        >
            @foreach ($sections as $section)
                @php
                    [$href, $label] = $section;
                @endphp
                <li>
                    <a
                        href="{{ $href }}"
                        class="inline-flex items-center gap-2 rounded-full px-4 py-2 transition hover:bg-white/10 data-[active=true]:bg-amber-400 data-[active=true]:text-slate-900"
                        data-spy-link="{{ $href }}"
                    >
                        {{ mb_strtoupper($label) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
