@props([
    'title' => 'Bagikan artikel ini',
    'url'   => null,          // default: url()::current()
    'text'  => null,          // optional: kalimat singkat untuk ikut dibagikan
])

@php
    $shareUrl  = $url ?: url()->current();
    $shareText = $text ?: $title;

    // Tautan platform
    $waHref  = 'https://wa.me/?text=' . urlencode(trim(($shareText ? $shareText.' ' : '').$shareUrl));
    $fbHref  = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($shareUrl);
    $xHref   = 'https://twitter.com/intent/tweet?url=' . urlencode($shareUrl) . ($shareText ? '&text=' . urlencode($shareText) : '');
@endphp

<div class="card p-6" data-sharebox>
  <h3 class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">
    {{ $title }}
  </h3>

  <div class="mt-4 flex flex-wrap gap-3">
    {{-- Web Share API --}}
    <button
      type="button"
      class="inline-flex items-center gap-2 rounded-xl bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[var(--color-primary-600)] focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
      data-share
      aria-label="Bagikan lewat aplikasi yang tersedia"
    >
      {{-- icon share --}}
      <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12v7a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-7"/><path d="M16 6l-4-4-4 4"/><path d="M12 2v14"/></svg>
      Bagikan
    </button>

    {{-- WhatsApp --}}
    <a
      href="{{ $waHref }}"
      target="_blank" rel="noopener noreferrer"
      class="inline-flex items-center gap-2 rounded-xl bg-[#25D366] px-4 py-2 text-sm font-semibold text-white transition hover:brightness-95 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
      aria-label="Bagikan ke WhatsApp"
    >
      {{-- icon wa --}}
      <svg class="h-4 w-4" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true"><path d="M19.1 17.6c-.3-.1-1-.5-1.1-.6s-.3-.1-.5.1-.6.6-.7.7-.3.1-.5 0a7.9 7.9 0 0 1-2.4-1.5 9.1 9.1 0 0 1-1.7-2.2c-.2-.3 0-.4.1-.5l.3-.3c.1-.1.1-.2.2-.3s.1-.2.2-.3 0-.2 0-.3 0-.3-.1-.4-.5-1.2-.7-1.6-.3-.4-.5-.4h-.4a.9.9 0 0 0-.6.3 2.5 2.5 0 0 0-.8 1.8 4.2 4.2 0 0 0 .9 2.2 12.2 12.2 0 0 0 4.8 4.6 10.8 10.8 0 0 0 2.1.8 5 5 0 0 0 2.3.1 2 2 0 0 0 1.3-.9 1.6 1.6 0 0 0 .1-.9c-.1-.1-.3-.2-.6-.3z"/><path d="M26.7 5.3A13 13 0 0 0 5.3 26.7l-1.7 6 6.1-1.6A13 13 0 0 0 26.7 5.3zm-3 18.4a10 10 0 0 1-9.2 2.8 9.9 9.9 0 0 1-3.2-1.2l-.6-.4-3.6 1 1-3.5-.4-.6A10 10 0 1 1 23.7 23.7z"/></svg>
      WhatsApp
    </a>

    {{-- Facebook --}}
    <a
      href="{{ $fbHref }}"
      target="_blank" rel="noopener noreferrer"
      class="inline-flex items-center gap-2 rounded-xl bg-[#1877F2] px-4 py-2 text-sm font-semibold text-white transition hover:brightness-95 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
      aria-label="Bagikan ke Facebook"
    >
      {{-- icon fb --}}
      <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7h-2.2V12h2.2V9.8c0-2.2 1.3-3.4 3.3-3.4.9 0 1.8.1 2.6.2v2.3h-1.5c-1.2 0-1.6.7-1.6 1.5V12h2.7l-.4 2.9h-2.3v7A10 10 0 0 0 22 12"/></svg>
      Facebook
    </a>

    {{-- X (Twitter) --}}
    <a
      href="{{ $xHref }}"
      target="_blank" rel="noopener noreferrer"
      class="inline-flex items-center gap-2 rounded-xl bg-black px-4 py-2 text-sm font-semibold text-white transition hover:brightness-95 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
      aria-label="Bagikan ke X (Twitter)"
    >
      {{-- icon X --}}
      <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.6 10.7 21.5 2h-1.9l-6.6 7.4L7.7 2H2l8.3 12.1L2 22h1.9l7-7.8 5.6 7.8H22l-8.4-11.3z"/></svg>
      X
    </a>

    {{-- Copy link --}}
    <button
      type="button"
      data-copy="{{ $shareUrl }}"
      class="inline-flex items-center gap-2 rounded-xl border border-[var(--color-border)] bg-white px-4 py-2 text-sm font-semibold text-[var(--color-ink)] transition hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
    >
      {{-- icon copy --}}
      <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
      Salin tautan
      <span class="sr-only">Salin tautan artikel</span>
    </button>

    {{-- Feedback kecil saat tersalin --}}
    <span data-copied-feedback class="hidden select-none text-sm text-[var(--color-muted)]">Tautan disalin ✔</span>
  </div>
</div>

@once
@push('scripts')
<script>
(() => {
  document.querySelectorAll('[data-sharebox]').forEach(box => {
    const shareBtn   = box.querySelector('[data-share]');
    const copyBtn    = box.querySelector('[data-copy]');
    const feedbackEl = box.querySelector('[data-copied-feedback]');
    const url        = copyBtn?.getAttribute('data-copy') || window.location.href;
    const title      = @json($title);
    const text       = @json($shareText);

    const showFeedback = () => {
      if (!feedbackEl) return;
      feedbackEl.classList.remove('hidden');
      clearTimeout(feedbackEl._t);
      feedbackEl._t = setTimeout(() => feedbackEl.classList.add('hidden'), 1600);
    };

    shareBtn?.addEventListener('click', async () => {
      try {
        if (navigator.share) {
          await navigator.share({ url, title, text });
        } else {
          // fallback ke salin
          await navigator.clipboard.writeText(url);
          showFeedback();
        }
      } catch (e) {
        // user cancel → tidak perlu apa-apa
      }
    });

    copyBtn?.addEventListener('click', async () => {
      try {
        await navigator.clipboard.writeText(url);
        showFeedback();
      } catch (e) {
        // Fallback lama bila clipboard API diblok
        const ta = document.createElement('textarea');
        ta.value = url; document.body.appendChild(ta);
        ta.select(); document.execCommand('copy'); document.body.removeChild(ta);
        showFeedback();
      }
    });
  });
})();
</script>
@endpush
@endonce
