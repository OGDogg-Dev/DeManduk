@props([
    'label',
    'href' => '#',
    'active' => false,
])

<a
    href="{{ $href }}"
    @class([
        'inline-flex items-center gap-2 rounded-full px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.25em] transition focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]',
        'bg-amber-400 text-[#021024]' => $active,
        'bg-white/10 text-slate-200 hover:bg-amber-400 hover:text-[#021024]' => ! $active,
    ])
>
    {{ $label }}
</a>
