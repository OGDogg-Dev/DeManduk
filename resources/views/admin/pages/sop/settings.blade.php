@extends('layouts.admin', ['title' => 'Pengaturan Halaman SOP'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Pengaturan SOP</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui teks pengantar dan pesan penting pada halaman SOP publik.</p>
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

        $introList = collect(json_decode($introParagraphs, true) ?? []);
        $introText = old('intro_paragraphs', $introList->implode("\n"));
    @endphp

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.pages.sop.settings.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Subjudul</label>
                <textarea name="subtitle" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('subtitle', $subtitle) }}</textarea>
                @error('subtitle')
                    <p class="text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Paragraf pengantar</label>
                <textarea name="intro_paragraphs" rows="5" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Pisahkan paragraf dengan baris baru">{{ $introText }}</textarea>
                @error('intro_paragraphs')
                    <p class="text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Variasi alert informasi</label>
                    <select name="info_alert_variant" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @foreach ($variants as $value => $label)
                            <option value="{{ $value }}" @selected(old('info_alert_variant', $infoAlert['variant']) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('info_alert_variant')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Judul alert informasi</label>
                    <input type="text" name="info_alert_title" value="{{ old('info_alert_title', $infoAlert['title']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    @error('info_alert_title')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Isi alert informasi</label>
                <textarea name="info_alert_body" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('info_alert_body', $infoAlert['body']) }}</textarea>
                @error('info_alert_body')
                    <p class="text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Variasi alert penutup</label>
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
                    <label class="block text-sm font-semibold text-slate-700">Judul alert penutup</label>
                    <input type="text" name="bottom_alert_title" value="{{ old('bottom_alert_title', $bottomAlert['title']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    @error('bottom_alert_title')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Isi alert penutup</label>
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
        <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Kelola komponen SOP</h2>
        <div class="mt-3 grid gap-4 md:grid-cols-3">
            <a href="{{ route('admin.pages.sop.steps.index') }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Langkah Pelayanan</h3>
                    <p class="mt-2 text-sm text-slate-600">Kelola alur utama SOP mulai dari pra-kunjungan hingga penutupan kegiatan.</p>
                </div>
                <span class="mt-4 text-sm font-semibold text-blue-600">Kelola langkah -></span>
            </a>
            <a href="{{ route('admin.pages.sop.objectives.index') }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Tujuan SOP</h3>
                    <p class="mt-2 text-sm text-slate-600">Ubah poin tujuan agar selalu relevan dengan evaluasi terbaru.</p>
                </div>
                <span class="mt-4 text-sm font-semibold text-blue-600">Kelola tujuan -></span>
            </a>
            <a href="{{ route('admin.pages.sop.partners.index') }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Instansi Pendukung</h3>
                    <p class="mt-2 text-sm text-slate-600">Atur daftar instansi yang berkolaborasi dalam penerapan SOP.</p>
                </div>
                <span class="mt-4 text-sm font-semibold text-blue-600">Kelola instansi -></span>
            </a>
        </div>
    </div>
@endsection
