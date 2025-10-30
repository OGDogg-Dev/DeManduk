@props([
    'label',
    'href' => '#',
])

<a
    href="{{ $href }}"
    class="inline-flex items-center gap-1 rounded-full border border-slate-200 px-2.5 py-1 text-xs font-medium text-slate-500 transition hover:border-blue-400 hover:text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
>
    <span aria-hidden="true">#</span>
    {{ $label }}
</a>
