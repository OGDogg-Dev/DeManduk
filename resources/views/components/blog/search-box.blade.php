@props([
    'action'      => '#',
    'placeholder' => 'Cari artikel atau topik...',
    'value'       => null,
    'name'        => 'q',     // nama query param
    'autosubmit'  => true,    // klik "hapus" otomatis submit utk reset hasil
])

@php
  $inputId = 'blog-search';
@endphp

<form action="{{ $action }}" method="GET" role="search" class="relative" data-searchbox data-autosubmit="{{ $autosubmit ? 'true' : 'false' }}">
  {{-- Pertahankan query lain (kecuali nama param dan pagination) --}}
  @foreach(request()->except($name, 'page') as $k => $v)
    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
  @endforeach

  <label for="{{ $inputId }}" class="sr-only">Pencarian blog</label>

  {{-- Icon search (kiri) --}}
  <span class="pointer-events-none absolute inset-y-0 left-3 grid place-content-center">
    <svg class="h-4 w-4 text-[var(--color-muted)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <circle cx="11" cy="11" r="7"/><path d="M21 21l-3.4-3.4"/>
    </svg>
  </span>

  <input
    id="{{ $inputId }}"
    name="{{ $name }}"
    type="search"
    placeholder="{{ $placeholder }}"
    value="{{ $value }}"
    inputmode="search"
    class="w-full rounded-xl border border-[var(--color-border)] bg-white pl-10 pr-28 py-3 text-sm text-[var(--color-ink)] shadow-sm transition placeholder:text-slate-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
  >

  {{-- Tombol clear (muncul saat ada nilai) --}}
  <button
    type="button"
    class="absolute inset-y-1 right-24 hidden items-center justify-center rounded-lg border border-[var(--color-border)] bg-white px-2 text-xs text-[var(--color-ink)] hover:bg-slate-100"
    data-clear
    aria-label="Hapus pencarian"
    title="Hapus"
  >
    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <path d="M18 6L6 18M6 6l12 12"/>
    </svg>
  </button>

  {{-- Submit --}}
  <button
    type="submit"
    class="absolute inset-y-1 right-1 inline-flex items-center justify-center rounded-lg bg-[var(--color-primary)] px-3.5 text-sm font-semibold text-white transition hover:bg-[var(--color-primary-600)] focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
  >
    Cari
  </button>
</form>

@once
@push('scripts')
<script>
(() => {
  const form = document.querySelector('[data-searchbox]');
  if (!form) return;

  const input = form.querySelector('input[type="search"]');
  const clearBtn = form.querySelector('[data-clear]');
  const autosubmit = form.getAttribute('data-autosubmit') === 'true';

  const toggleClear = () => {
    const hasVal = (input.value || '').trim().length > 0;
    clearBtn.classList.toggle('hidden', !hasVal);
  };

  input.addEventListener('input', toggleClear);
  toggleClear();

  clearBtn.addEventListener('click', () => {
    input.value = '';
    toggleClear();
    input.focus();
    if (autosubmit) form.submit();
  });
})();
</script>
@endpush
@endonce
