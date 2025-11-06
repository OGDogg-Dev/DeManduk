@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Dokumen SOP</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui informasi dan file dokumen SOP.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Form Edit Dokumen</h2>
            <p class="text-sm text-slate-600 mt-1">Ubah informasi dokumen atau ganti file PDF</p>
        </div>

        <form method="POST" action="{{ route('admin.pages.sop.documents.update', $document) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

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
                                value="{{ old('title', $document->title) }}"
                                required
                                maxlength="255"
                                placeholder="Contoh: SOP Pelayanan Wisata Waduk Manduk"
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition"
                            >
                        </div>
                        <p class="text-xs text-slate-500">
                            Perbarui judul dokumen agar sesuai dengan isi file terbaru.
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
                            Ganti File PDF (Opsional)
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
                                    Seret & lepaskan file PDF baru atau klik untuk memilih
                                </p>
                                <p class="text-xs text-slate-500">
                                    Format PDF saja &bull; Maksimal 10 MB
                                </p>
                                <p data-file-placeholder class="text-xs text-slate-500">
                                    Tidak ada file baru yang dipilih
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
                                    File pengganti siap diunggah
                                </p>
                            </dl>
                        </div>

                        <p class="text-xs text-slate-500">
                            Biarkan kosong bila tidak ingin mengganti file. File lama tetap digunakan.
                        </p>

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
                    @if ($document?->file_path)
                        <section class="rounded-2xl border border-blue-200 bg-blue-50/80 p-4 text-xs text-slate-700">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <h3 class="text-sm font-semibold text-slate-900">File saat ini</h3>
                                    <p class="mt-1 max-w-[240px] truncate text-sm font-medium text-slate-800" title="{{ $document->original_name }}">
                                        {{ $document->original_name }}
                                    </p>
                                    <dl class="mt-3 space-y-2 text-[11px] text-slate-600">
                                        <div class="flex items-center justify-between gap-4">
                                            <dt>Ukuran</dt>
                                            <dd class="font-semibold text-slate-900">{{ number_format($document->file_size / 1024, 1) }} KB</dd>
                                        </div>
                                        <div class="flex items-center justify-between gap-4">
                                            <dt>Diunggah</dt>
                                            <dd class="text-right">
                                                <span class="block font-semibold text-slate-900">
                                                    {{ $document->uploaded_at->timezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                                </span>
                                                <span class="block text-slate-500">
                                                    {{ $document->uploaded_at->diffForHumans() }}
                                                </span>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            <a href="{{ route('sop.pdf.viewer', $document) }}"
                               target="_blank"
                               class="mt-4 inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-[11px] font-semibold text-blue-700 hover:bg-blue-200">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S3.732 16.057 2.458 12z" />
                                </svg>
                                Pratinjau dokumen
                            </a>
                        </section>
                    @endif

                    <section class="space-y-3">
                        <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            Petunjuk pembaruan
                        </h3>
                        <ul class="space-y-2 pl-4 text-xs text-slate-600 list-disc">
                            <li>Judul dapat diperbarui tanpa mengganti file PDF.</li>
                            <li>Jika mengganti file, pastikan versi terbaru sudah ditandai di dalam dokumen.</li>
                            <li>File lama akan dihapus setelah Anda menyimpan perubahan.</li>
                        </ul>
                    </section>

                    <section class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4 text-xs text-blue-800">
                        <h4 class="text-sm font-semibold text-blue-900 mb-2 flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4 7h16M4 12h16M4 17h16" />
                            </svg>
                            Catatan kualitas file
                        </h4>
                        <ul class="list-disc space-y-1 pl-4">
                            <li>Gunakan fitur kompresi jika ukuran file mendekati 10 MB.</li>
                            <li>Periksa kembali isi file sebelum menyimpan perubahan.</li>
                            <li>Dokumen baru akan langsung menggantikan versi lama di halaman publik.</li>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Perbarui Dokumen
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
