@props([
    'title' => 'Bagikan artikel ini',
    'url' => null,
])

@php
    $shareUrl = $url ?? url()->current();
@endphp

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">{{ $title }}</h3>
    <div class="mt-4 flex flex-wrap gap-3">
        <a
            href="https://wa.me/?text={{ urlencode($shareUrl) }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-xl bg-emerald-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2"
        >
            WhatsApp
        </a>
        <a
            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
        >
            Facebook
        </a>
        <a
            href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-black focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2"
        >
            X (Twitter)
        </a>
    </div>
</div>
