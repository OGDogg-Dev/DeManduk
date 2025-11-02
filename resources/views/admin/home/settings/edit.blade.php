@extends('layouts.admin', ['title' => 'Pengaturan Beranda'])

@section('content')
    @php
        $aboutList = is_string($aboutParagraphs) ? json_decode($aboutParagraphs, true) : (array) $aboutParagraphs;
        if (! is_array($aboutList)) {
            $aboutList = [];
        }
        $aboutText = old('about_paragraphs', collect($aboutList)->implode("\n"));

        $institutionList = is_string($institutions) ? json_decode($institutions, true) : (array) $institutions;
        if (! is_array($institutionList)) {
            $institutionList = [];
        }
        $institutionsText = old('institutions_text', collect($institutionList)->map(function ($item) {
            $title = $item['title'] ?? '';
            $desc = $item['description'] ?? '';
            return trim($title . '|' . $desc);
        })->implode("\n"));
    @endphp

    <h1 class="text-2xl font-semibold text-slate-900">Pengaturan Konten Beranda</h1>
    <p class="mt-2 text-sm text-slate-600">Sesuaikan informasi umum, paragraf, serta referensi peta dan instansi pendukung.</p>

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
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Judul Situs</label>
                        <input type="text" name="site_title" value="{{ old('site_title', $siteTitle) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                    <div class="space-y-2">
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Logo</label>
                        <input type="file" name="site_logo" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @if ($logoPath)
                            <div class="flex items-center gap-3">
                                <img src="{{ \App\Support\Media::url($logoPath) }}" alt="Logo" class="h-12 w-12 rounded-full border border-slate-200 object-cover">
                                <label class="inline-flex items-center gap-2 text-xs text-rose-600">
                                    <input type="checkbox" name="remove_logo" value="1"> Hapus logo
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section class="space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Paragraf Tentang</h2>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Paragraf</label>
                    <textarea name="about_paragraphs" rows="6" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Pisahkan paragraf menggunakan baris baru">{{ $aboutText }}</textarea>
                    <p class="mt-2 text-xs text-slate-500">Setiap baris akan ditampilkan sebagai paragraf di section Tentang.</p>
                </div>
            </section>

            <section class="space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Pengaturan Peta</h2>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">URL Embed Peta</label>
                        <input type="text" name="map_embed_url" value="{{ old('map_embed_url', $mapEmbedUrl) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Label Tombol</label>
                        <input type="text" name="map_link_label" value="{{ old('map_link_label', $mapLinkLabel) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">URL Arah</label>
                    <input type="text" name="map_directions_url" value="{{ old('map_directions_url', $mapDirectionsUrl) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="https://maps.app.goo.gl/...">
                </div>
            </section>

            <section class="space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Instansi Pendukung</h2>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Daftar instansi</label>
                    <textarea name="institutions_text" rows="6" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Format: Nama Instansi|Deskripsi">{{ $institutionsText }}</textarea>
                    <p class="mt-2 text-xs text-slate-500">Gunakan format <code>Nama Instansi|Deskripsi</code> untuk setiap baris.</p>
                </div>
            </section>

            <div class="flex justify-end gap-3">
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
@endsection
