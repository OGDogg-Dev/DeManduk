@props([
    'action' => '#',
    'placeholder' => 'Cari artikel atau topik...',
])

<form action="{{ $action }}" method="GET" class="relative">
    <label for="blog-search" class="sr-only">Pencarian blog</label>
    <input
        id="blog-search"
        name="q"
        type="search"
        placeholder="{{ $placeholder }}"
        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
    >
    <button
        type="submit"
        class="absolute inset-y-1 right-1 inline-flex items-center justify-center rounded-lg bg-blue-600 px-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
    >
        Cari
    </button>
</form>
