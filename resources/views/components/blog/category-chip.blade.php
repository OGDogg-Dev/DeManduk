@props([
    'label',
    'href' => '#',
    'active' => false,
])

<a
    href="{{ $href }}"
    @class([
        'inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2',
        'bg-blue-100 text-blue-700' => $active,
        'bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-600' => ! $active,
    ])
>
    {{ $label }}
</a>
