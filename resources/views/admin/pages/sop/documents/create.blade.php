@extends('layouts.admin')

@php
    $totalDocuments = \App\Models\SopDocument::count();
    $latestUploaded = \App\Models\SopDocument::query()->orderByDesc('uploaded_at')->first();
@endphp

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Dokumen SOP</h1>
        <p class="mt-2 text-sm text-slate-600">Unggah dokumen PDF untuk Standar Operasional Prosedur.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Form Dokumen Baru</h2>
            <p class="text-sm text-slate-600 mt-1">Isi informasi dokumen dan unggah file PDF</p>
        </div>

        <form method="POST" action="{{ route('admin.pages.sop.documents.store') }}" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="grid gap-8 xl:grid-cols-[minmax(0,1.2fr)_minmax(0,0.8fr)]">
                <div class="space-y-6">
                    <!-- Judul Dokumen -->
                    <div class="space-y-3">
                        <label for="sop-title" class="block text-sm font-semibold text-slate-700">
                            Judul Dokumen <span class="text-rose-600">*</span>
                        </label>
                        <div class="relative">
                            <input
                                id="sop-title"
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                required
                                maxlength="255"
                                placeholder="Contoh: SOP Pelayanan Wisata Waduk Manduk"
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition"
                            >
                        </div>
                        <p class="text-xs text-slate-500">
                            Gunakan judul yang mudah dipahami dan mencerminkan isi dokumen.
                        </p>
                        @error('title')
                            <p class="mt-1 text-xs text-rose-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Upload File -->
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-700">
                            File PDF <span class="text-rose-600">*</span>
                        </label>

                        <div
                            data-file-dropzone
                            class="relative flex flex-col items-center justify-center gap-3 rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50/70 px-6 py-8 text-center transition hover:border-blue-400 hover:bg-blue-50/40"
                        >
                            <input
                                data-file-input
                                type="file"
                                name="file"
                                accept="application/pdf,.pdf"
                                required
                                class="absolute inset-0 z-[1] h-full w-full cursor-pointer opacity-0"
                            >

                            <div class="relative z-[0]">
                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6H16a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v10" />
                                    </svg>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <p class="text-sm font-semibold text-slate-800">
                                    Seret & lepaskan file PDF atau klik untuk memilih
                                </p>
                                <p class="text-xs text-slate-500">
                                    Format PDF saja &bull; Maksimal 10 MB
                                </p>
                                <p data-file-placeholder class="text-xs text-slate-500">
                                    Belum ada file yang dipilih
                                </p>
                            </div>

                            <dl
                                data-file-meta
                                class="hidden w-full max-w-md rounded-xl border border-blue-100 bg-white/90 p-4 text-left text-xs text-slate-600 shadow-sm"
                            >
                                <div class="grid grid-cols-[auto_1fr] items-center gap-x-3 gap-y-2">
                                    <dt class="font-semibold text-slate-700">Nama</dt>
                                    <dd data-file-name class="truncate font-medium text-slate-800">-</dd>

                                    <dt class="font-semibold text-slate-700">Ukuran</dt>
                                    <dd data-file-size>-</dd>

                                    <dt class="font-semibold text-slate-700">Tipe</dt>
                                    <dd data-file-type>-</dd>
                                </div>
                                <p class="mt-3 flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-[11px] font-medium text-blue-700">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    File siap diunggah
                                </p>
                            </dl>
                        </div>

                        @error('file')
                            <p class="mt-1 text-xs text-rose-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <aside class="space-y-5 rounded-2xl border border-slate-200 bg-slate-50/70 p-5">
                    <section class="space-y-3">
                        <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            Panduan singkat
                        </h3>
                        <ul class="space-y-2 pl-4 text-xs text-slate-600 list-disc">
                            <li>Pastikan setiap halaman dokumen terbaca dengan jelas.</li>
                            <li>Gunakan penamaan judul yang konsisten untuk memudahkan pencarian.</li>
                            <li>Perbarui dokumen lama dengan versi terbaru bila diperlukan.</li>
                        </ul>
                    </section>

                    <section class="rounded-2xl border border-slate-200 bg-white/80 p-4 text-xs text-slate-600">
                        <h4 class="text-sm font-semibold text-slate-800 mb-3">Status arsip SOP</h4>
                        <dl class="space-y-3">
                            <div class="flex items-center justify-between">
                                <dt>Total dokumen</dt>
                                <dd class="font-semibold text-slate-900">{{ number_format($totalDocuments) }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Rilis terakhir</dt>
                                <dd class="text-right">
                                    @if ($latestUploaded)
                                        <span class="block font-semibold text-slate-900">
                                            {{ $latestUploaded->uploaded_at->timezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                        </span>
                                        <span class="block text-[11px] text-slate-500">
                                            {{ $latestUploaded->uploaded_at->diffForHumans() }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">Belum ada data</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </section>

                    <section class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4 text-xs text-blue-800">
                        <h4 class="text-sm font-semibold text-blue-900 mb-2 flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 7h18M3 12h18M3 17h18" />
                            </svg>
                            Tips kualitas file
                        </h4>
                        <ul class="list-disc space-y-1 pl-4">
                            <li>Gunakan resolusi minimal 150 dpi agar teks tetap tajam.</li>
                            <li>Gabungkan file terkait ke dalam satu PDF sebelum mengunggah.</li>
                            <li>Jika ukuran file terlalu besar, kompres terlebih dahulu.</li>
                        </ul>
                    </section>
                </aside>
            </div>

            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.pages.sop.documents.index') }}" 
                   class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-100 hover:text-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Simpan Dokumen
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
  if (!window.__sopUploaderInit) {
    window.__sopUploaderInit = true;
    document.addEventListener('DOMContentLoaded', () => {
      const formatBytes = (bytes) => {
        if (!Number.isFinite(bytes)) return '-';
        const units = ['B', 'KB', 'MB', 'GB'];
        let size = bytes;
        let unitIndex = 0;
        while (size >= 1024 && unitIndex < units.length - 1) {
          size /= 1024;
          unitIndex++;
        }
        return `${size.toFixed(unitIndex === 0 ? 0 : 1)} ${units[unitIndex]}`;
      };

      const dropzones = document.querySelectorAll('[data-file-dropzone]');
      if (!dropzones.length) return;

      dropzones.forEach((dropzone) => {
        const input = dropzone.querySelector('[data-file-input]');
        const placeholder = dropzone.querySelector('[data-file-placeholder]');
        const meta = dropzone.querySelector('[data-file-meta]');
        const nameEl = dropzone.querySelector('[data-file-name]');
        const sizeEl = dropzone.querySelector('[data-file-size]');
        const typeEl = dropzone.querySelector('[data-file-type]');

        const toggleMeta = (visible) => {
          if (!meta || !placeholder) return;
          meta.classList.toggle('hidden', !visible);
          placeholder.classList.toggle('hidden', visible);
        };

        const renderFile = (file) => {
          if (!file) {
            toggleMeta(false);
            if (nameEl) nameEl.textContent = '-';
            if (sizeEl) sizeEl.textContent = '-';
            if (typeEl) typeEl.textContent = '-';
            return;
          }

          toggleMeta(true);
          if (nameEl) nameEl.textContent = file.name;
          if (sizeEl) sizeEl.textContent = formatBytes(file.size);
          if (typeEl) typeEl.textContent = file.type || 'application/pdf';
        };

        const applyHighlight = (state) => {
          dropzone.classList.toggle('ring-2', state);
          dropzone.classList.toggle('ring-blue-200', state);
          dropzone.classList.toggle('bg-blue-50/40', state);
        };

        input?.addEventListener('change', (event) => {
          const file = event.target.files && event.target.files[0] ? event.target.files[0] : null;
          renderFile(file);
        });

        ['dragenter', 'dragover'].forEach((eventName) => {
          dropzone.addEventListener(eventName, (event) => {
            event.preventDefault();
            event.stopPropagation();
            applyHighlight(true);
          });
        });

        ['dragleave', 'dragend', 'drop'].forEach((eventName) => {
          dropzone.addEventListener(eventName, (event) => {
            event.preventDefault();
            event.stopPropagation();
            if (eventName !== 'drop') {
              applyHighlight(false);
            }
          });
        });

        dropzone.addEventListener('drop', (event) => {
          const file = event.dataTransfer && event.dataTransfer.files ? event.dataTransfer.files[0] : null;
          if (!file) return;

          const dataTransfer = new DataTransfer();
          dataTransfer.items.add(file);
          if (input) {
            input.files = dataTransfer.files;
            input.dispatchEvent(new Event('change', { bubbles: true }));
          }
          applyHighlight(false);
        });
      });
    });
  }
</script>
@endpush
