@extends('layouts.admin', ['title' => 'Pengaturan Beranda'])

@section('content')
    @php
        $aboutList = is_string($aboutParagraphs) ? json_decode($aboutParagraphs, true) : (array) $aboutParagraphs;
        if (! is_array($aboutList)) {
            $aboutList = [];
        }
        $aboutText = old('about_paragraphs', collect($aboutList)->implode("\n"));
    @endphp

    <h1 class="text-2xl font-semibold text-slate-900">Pengaturan Konten Beranda</h1>
    <p class="mt-2 text-sm text-slate-600">Sesuaikan identitas situs, paragraf tentang, peta, serta instansi pendukung yang tampil di halaman publik.</p>

    @if (session('status'))
        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.home.settings.update') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <section class="space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Identitas Situs</h2>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Judul Situs <span class="text-rose-600">*</span></label>
                        <input type="text" name="site_title" value="{{ old('site_title', $siteTitle) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @error('site_title')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Logo</label>
                        <input type="file" name="site_logo" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @error('site_logo')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                        @if ($logoPath)
                            <div class="flex items-center gap-3">
                                <img src="{{ \App\Support\Media::url($logoPath) }}" alt="Logo" class="h-12 w-12 rounded-full border border-slate-200 object-cover">
                                <label class="inline-flex items-center gap-2 text-xs text-rose-600">
                                    <input type="checkbox" name="remove_logo" value="1" {{ old('remove_logo') ? 'checked' : '' }}> Hapus logo
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section class="space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Section Tentang</h2>
                <div class="grid gap-4 md:grid-cols-[1.1fr_0.9fr]">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Paragraf</label>
                        <textarea name="about_paragraphs" rows="6" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Pisahkan paragraf menggunakan baris baru">{{ $aboutText }}</textarea>
                        @error('about_paragraphs')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-slate-500">Setiap baris akan ditampilkan sebagai paragraf di section Tentang.</p>
                    </div>
                    <div class="space-y-2">
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Gambar pendukung</label>
                        <input type="file" name="about_image" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @error('about_image')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                        @if ($aboutImagePath)
                            <div class="space-y-2">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pratinjau saat ini</p>
                                <img src="{{ \App\Support\Media::url($aboutImagePath) }}" alt="Gambar tentang" class="h-32 w-auto rounded-xl border border-slate-200 object-cover">
                                <label class="inline-flex items-center gap-2 text-xs text-rose-600">
                                    <input type="checkbox" name="remove_about_image" value="1" {{ old('remove_about_image') ? 'checked' : '' }}> Hapus gambar
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section class="space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Pengaturan Peta</h2>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">URL Embed Peta</label>
                        <input type="text" name="map_embed_url" value="{{ old('map_embed_url', $mapEmbedUrl) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @error('map_embed_url')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Label Tombol</label>
                        <input type="text" name="map_link_label" value="{{ old('map_link_label', $mapLinkLabel) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @error('map_link_label')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">URL Arah</label>
                    <input type="text" name="map_directions_url" value="{{ old('map_directions_url', $mapDirectionsUrl) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="https://maps.app.goo.gl/...">
                    @error('map_directions_url')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </section>



            <div class="flex justify-end gap-3">
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
@endsection
