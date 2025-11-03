@props([
    'action' => '#',
    'placeholder' => 'Cari artikel atau topik...',
    'value' => null,
])

<form action="{{ $action }}" method="GET" class="relative">
    <label for="blog-search" class="sr-only">Pencarian blog</label>
    <input
        id="blog-search"
        name="q"
        type="search"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        class="w-full rounded-xl border border-white/15 bg-[#041f45] px-4 py-3 text-sm text-slate-100 shadow-sm transition placeholder:text-slate-400 focus:border-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#020f24]"
    >
    <button
        type="submit"
        class="absolute inset-y-1 right-1 inline-flex items-center justify-center rounded-lg bg-amber-400 px-3 text-sm font-semibold uppercase tracking-[0.2em] text-[#021024] transition hover:bg-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-200 focus-visible:ring-offset-2 focus-visible:ring-offset-[#020f24]"
    >
        Cari
    </button>
</form>
