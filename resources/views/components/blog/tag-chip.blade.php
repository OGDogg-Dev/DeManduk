@props([
    'label',
    'href' => '#',
])

<a
    href="{{ $href }}"
    class="inline-flex items-center gap-1 rounded-full border border-white/20 px-2.5 py-1 text-xs font-medium text-slate-300 transition hover:border-amber-300 hover:text-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
>
    <span aria-hidden="true">#</span>
    {{ $label }}
</a>
