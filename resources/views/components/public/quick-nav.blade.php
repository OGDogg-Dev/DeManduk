@props(['sections' => []])

<nav
    aria-label="Navigasi bagian halaman"
    class="sticky top-14 z-30 border-b border-slate-200/70 bg-white/85 backdrop-blur supports-[backdrop-filter]:bg-white/70 md:top-16"
>
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <ul
            class="-mx-2 flex gap-1 overflow-x-auto py-2 text-sm font-semibold text-slate-600 [scrollbar-width:none]"
            data-scrollspy
        >
            @foreach ($sections as $section)
                @php
                    [$href, $label] = $section;
                @endphp
                <li>
                    <a
                        href="{{ $href }}"
                        class="inline-flex items-center gap-2 rounded-lg px-3 py-2 transition hover:bg-slate-100 data-[active=true]:bg-blue-600 data-[active=true]:text-white"
                        data-spy-link="{{ $href }}"
                    >
                        {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
