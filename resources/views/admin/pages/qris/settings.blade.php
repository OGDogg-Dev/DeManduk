@extends('layouts.admin', ['title' => 'Pengaturan Halaman QRIS'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Pengaturan QRIS</h1>
        <p class="mt-2 text-sm text-slate-600">Atur informasi utama, poster QRIS, dan pesan penting pada halaman QRIS.</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    @php
        $variants = [
            'info' => 'Info',
            'success' => 'Sukses',
            'warning' => 'Peringatan',
            'danger' => 'Bahaya',
        ];
    @endphp

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.pages.qris.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Subjudul</label>
                <textarea name="subtitle" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('subtitle', $subtitle) }}</textarea>
                @error('subtitle')
                    <p class="text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Variasi alert utama</label>
                    <select name="primary_alert_variant" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @foreach ($variants as $value => $label)
                            <option value="{{ $value }}" @selected(old('primary_alert_variant', $primaryAlert['variant']) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('primary_alert_variant')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Judul alert utama</label>
                    <input type="text" name="primary_alert_title" value="{{ old('primary_alert_title', $primaryAlert['title']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    @error('primary_alert_title')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Isi alert utama</label>
                <textarea name="primary_alert_body" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('primary_alert_body', $primaryAlert['body']) }}</textarea>
                @error('primary_alert_body')
                    <p class="text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Poster resmi</label>
                    <input type="file" name="poster" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    @error('poster')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                    @if ($posterPath)
                        <div class="space-y-2 rounded-xl border border-slate-200 bg-slate-50 p-3">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Poster saat ini</p>
                            <img src="{{ \App\Support\Media::url($posterPath) }}" alt="Poster QRIS" class="h-40 w-full rounded-lg object-cover">
                            <label class="inline-flex items-center gap-2 text-xs text-rose-600">
                                <input type="checkbox" name="remove_poster" value="1" {{ old('remove_poster') ? 'checked' : '' }}>
                                Hapus poster
                            </label>
                        </div>
                    @endif
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Format file tersedia</label>
                    <input type="text" name="poster_formats" value="{{ old('poster_formats', $posterFormats) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Contoh: SVG, PNG, PDF">
                    @error('poster_formats')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Variasi alert footer</label>
                    <select name="bottom_alert_variant" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @foreach ($variants as $value => $label)
                            <option value="{{ $value }}" @selected(old('bottom_alert_variant', $bottomAlert['variant']) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('bottom_alert_variant')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Judul alert footer</label>
                    <input type="text" name="bottom_alert_title" value="{{ old('bottom_alert_title', $bottomAlert['title']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    @error('bottom_alert_title')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Isi alert footer</label>
                <textarea name="bottom_alert_body" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('bottom_alert_body', $bottomAlert['body']) }}</textarea>
                @error('bottom_alert_body')
                    <p class="text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8">
        <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Kelola komponen QRIS</h2>
        <div class="mt-3 grid gap-4 md:grid-cols-3">
            <a href="{{ route('admin.pages.qris.steps.index') }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Langkah Pembayaran</h3>
                    <p class="mt-2 text-sm text-slate-600">Ubah urutan langkah yang memandu pengunjung saat menggunakan QRIS.</p>
                </div>
                <span class="mt-4 text-sm font-semibold text-blue-600">Kelola langkah -></span>
            </a>
            <a href="{{ route('admin.pages.qris.notes.index') }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Catatan Transaksi</h3>
                    <p class="mt-2 text-sm text-slate-600">Kelola poin penting terkait pembayaran dan validasi transaksi.</p>
                </div>
                <span class="mt-4 text-sm font-semibold text-blue-600">Kelola catatan -></span>
            </a>
            <a href="{{ route('admin.pages.qris.faqs.index') }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">FAQ QRIS</h3>
                    <p class="mt-2 text-sm text-slate-600">Tambahkan pertanyaan umum agar pengunjung mudah menemukan solusi.</p>
                </div>
                <span class="mt-4 text-sm font-semibold text-blue-600">Kelola FAQ -></span>
            </a>
        </div>
    </div>
@endsection
