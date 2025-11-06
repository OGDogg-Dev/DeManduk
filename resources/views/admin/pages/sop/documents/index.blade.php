@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Dokumen SOP</h1>
        <p class="mt-2 text-sm text-slate-600">Kelola dokumen PDF SOP yang tersedia untuk pengunjung.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <!-- Header Section -->
        <div class="p-6 border-b border-slate-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Daftar Dokumen</h2>
                    <p class="text-sm text-slate-600 mt-1">
                        @if($documents->count() > 0)
                            Menampilkan {{ $documents->count() }} dokumen SOP
                        @else
                            Tidak ada dokumen SOP yang tersedia
                        @endif
                    </p>
                </div>
                <a href="{{ route('admin.pages.sop.documents.create') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Dokumen Baru
                </a>
            </div>
        </div>

        @if($documents->count() > 0)
            @php
                $oldestDoc = $documents->sortBy('uploaded_at')->first();
                $newestDoc = $documents->sortByDesc('uploaded_at')->first();
                $totalSize = $documents->sum('file_size');
            @endphp

            <div class="grid gap-4 border-b border-slate-200 bg-slate-50/80 px-6 py-5 sm:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white/80 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Total</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900">{{ number_format($documents->count()) }}</p>
                    <p class="text-xs text-slate-500 mt-1">Dokumen tersimpan di arsip</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white/80 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Dokumen Paling Lama</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900">
                        {{ optional($oldestDoc)->uploaded_at?->timezone('Asia/Jakarta')->translatedFormat('d M Y') ?? 'Belum ada data' }}
                    </p>
                    @if($oldestDoc)
                        <p class="text-xs text-slate-500 mt-1 truncate" title="{{ $oldestDoc->title }}">{{ $oldestDoc->title }}</p>
                    @endif
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white/80 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Pembaruan Terakhir</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900">
                        {{ optional($newestDoc)->uploaded_at?->timezone('Asia/Jakarta')->translatedFormat('d M Y H:i') ?? 'Belum ada data' }}
                    </p>
                    @if($totalSize)
                        <p class="text-xs text-slate-500 mt-1">
                            Total ukuran arsip {{ number_format($totalSize / 1024 / 1024, 2) }} MB
                        </p>
                    @endif
                </div>
            </div>

            <div class="overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-fixed divide-y divide-slate-200">
                        <thead class="bg-white">
                            <tr class="text-left text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">
                                <th class="px-6 py-4">Dokumen</th>
                                <th class="px-6 py-4">Detail File</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach($documents as $document)
                                <tr class="transition hover:bg-blue-50/30">
                                    <td class="px-6 py-4 align-top">
                                        <div class="flex items-start gap-3">
                                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-semibold text-slate-900">{{ $document->title }}</p>
                                                <p class="mt-1 max-w-[240px] truncate text-xs text-slate-500" title="{{ $document->original_name }}">{{ $document->original_name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-top">
                                        <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 font-medium text-slate-700">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 15v4m-7 0h14m-4-7l-3 3-3-3" />
                                                </svg>
                                                {{ number_format($document->file_size / 1024, 1) }} KB
                                            </span>
                                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 font-medium text-slate-600">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4 7h16M4 12h16M4 17h16" />
                                                </svg>
                                                {{ $document->mime_type }}
                                            </span>
                                        </div>
                                        <div class="mt-3 flex flex-wrap items-center gap-3 text-xs font-medium">
                                            <a href="{{ route('sop.pdf.viewer', $document) }}"
                                               target="_blank"
                                               class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-blue-700 transition hover:bg-blue-200">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S3.732 16.057 2.458 12z" />
                                                </svg>
                                                Pratinjau
                                            </a>
                                            <a href="{{ route('sop.download', $document) }}"
                                               class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-slate-700 transition hover:bg-slate-200">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586c.265 0 .52.105.707.293L18.414 8.9a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Unduh
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-top">
                                        @php
                                            $uploadedAt = optional($document->uploaded_at)->timezone('Asia/Jakarta');
                                        @endphp
                                        <p class="text-sm font-semibold text-slate-900">
                                            {{ $uploadedAt?->translatedFormat('d M Y') ?? '—' }}
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            {{ $uploadedAt?->translatedFormat('H:i') ?? '' }}
                                        </p>
                                        @if($uploadedAt)
                                            <p class="mt-1 text-[11px] uppercase tracking-[0.2em] text-slate-400">
                                                {{ $uploadedAt->diffForHumans() }}
                                            </p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right align-top">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.pages.sop.documents.edit', $document) }}"
                                               class="inline-flex items-center justify-center rounded-lg border border-slate-200 p-2 text-slate-600 transition hover:border-blue-200 hover:text-blue-600"
                                               title="Edit dokumen">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.pages.sop.documents.destroy', $document) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen &quot;{{ addslashes($document->title) }}&quot;?\n\nFile PDF juga akan dihapus secara permanen.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center rounded-lg border border-slate-200 p-2 text-slate-600 transition hover:border-rose-200 hover:text-rose-600"
                                                        title="Hapus dokumen">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($documents->count() > 5)
                <div class="border-t border-slate-200 bg-slate-50/80 px-6 py-4 text-sm text-slate-500">
                    Menampilkan {{ $documents->count() }} dokumen (urut terlama ke terbaru)
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="p-12 text-center">
                <div class="mx-auto w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-slate-900 mb-2">Belum ada dokumen SOP</h3>
                <p class="text-slate-600 mb-6">Mulai dengan menambahkan dokumen SOP pertama Anda.</p>
                <a href="{{ route('admin.pages.sop.documents.create') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Dokumen Pertama
                </a>
            </div>
        @endif
    </div>
@endsection
