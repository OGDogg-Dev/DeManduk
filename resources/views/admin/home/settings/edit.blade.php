@extends('layouts.admin', ['title' => 'Pengaturan Beranda'])

@section('content')
    @php
        $aboutList = is_string($aboutParagraphs) ? json_decode($aboutParagraphs, true) : (array) $aboutParagraphs;
        if (! is_array($aboutList)) {
            $aboutList = [];
        }
        $aboutText = old('about_paragraphs', collect($aboutList)->implode("\n"));
        $seoPreviewTitle = old('seo_meta_title', $seoMetaTitle ?? 'Waduk - JDIH Kemenko Maritim & Investasi');
        $seoPreviewDescription = old('seo_meta_description', $seoMetaDescription ?? 'Waduk adalah wadah buatan yang terbentuk sebagai akibat dibangunnya bendungan. Referensi resmi: Peraturan Presiden Nomor 64 Tahun 2022.');
        $seoPreviewReferenceLabel = old('seo_reference_label', $seoReferenceLabel ?? 'Kemenko Bidang Kemaritiman dan Investasi');
        $seoPreviewReferenceUrl = old('seo_reference_url', $seoReferenceUrl ?? 'https://jdih.maritim.go.id/waduk');
        $seoPreviewReferenceSnippet = old('seo_reference_snippet', $seoReferenceSnippet ?? 'Waduk. Waduk adalah wadah buatan yang terbentuk sebagai akibat dibangunnya bendungan. Referensi. Peraturan Presiden Nomor 64 Tahun 2022 ...');
        $seoPreviewHost = $seoPreviewReferenceUrl ? parse_url($seoPreviewReferenceUrl, PHP_URL_HOST) : null;
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
                    <div class="space-y-2">
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Ikon Situs (Favicon)</label>
                        <input type="file" name="site_favicon" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @error('site_favicon')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-slate-500">Gunakan gambar kotak (mis. 64×64 PNG) agar ikon tampil tajam.</p>
                        @if ($faviconPath)
                            <div class="flex items-center gap-3">
                                <img src="{{ \App\Support\Media::url($faviconPath) }}" alt="Favicon" class="h-10 w-10 rounded border border-slate-200 object-cover">
                                <label class="inline-flex items-center gap-2 text-xs text-rose-600">
                                    <input type="checkbox" name="remove_favicon" value="1" {{ old('remove_favicon') ? 'checked' : '' }}> Hapus favicon
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
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">Metadata SEO & Referensi</h2>
                    <span class="text-xs font-medium uppercase tracking-[0.25em] text-slate-400">Google snippet preview</span>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Judul SEO (Meta Title)</label>
                        <input
                            type="text"
                            name="seo_meta_title"
                            value="{{ $seoPreviewTitle }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Waduk - JDIH Kemenko Maritim & Investasi"
                        >
                        @error('seo_meta_title')
                            <p class="text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-slate-500">Gunakan maksimal ±60 karakter agar tidak terpotong.</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Deskripsi SEO (Meta Description)</label>
                        <textarea
                            name="seo_meta_description"
                            rows="3"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Waduk adalah wadah buatan..."
                        >{{ $seoPreviewDescription }}</textarea>
                        @error('seo_meta_description')
                            <p class="text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Label Referensi</label>
                        <input
                            type="text"
                            name="seo_reference_label"
                            value="{{ $seoPreviewReferenceLabel }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Kemenko Bidang Kemaritiman dan Investasi"
                        >
                        @error('seo_reference_label')
                            <p class="text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">URL Referensi</label>
                        <input
                            type="url"
                            name="seo_reference_url"
                            value="{{ $seoPreviewReferenceUrl }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="https://jdih.maritim.go.id/waduk"
                        >
                        @error('seo_reference_url')
                            <p class="text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Kutipan Referensi</label>
                    <textarea
                        name="seo_reference_snippet"
                        rows="3"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Waduk. Waduk adalah wadah buatan..."
                    >{{ $seoPreviewReferenceSnippet }}</textarea>
                    @error('seo_reference_snippet')
                        <p class="text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-slate-500">Tampilkan dasar hukum atau ringkasan resmi yang ingin ditonjolkan.</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 shadow-inner">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Preview</p>
                    <div class="mt-2 space-y-1">
                        <div class="text-xs text-slate-500">{{ $seoPreviewHost ?? 'jdih.maritim.go.id' }}</div>
                        <div class="text-lg font-semibold text-blue-700">{{ $seoPreviewTitle }}</div>
                        <div class="text-sm text-slate-600">
                            <span class="font-semibold">{{ $seoPreviewReferenceLabel }}</span> —
                            {{ $seoPreviewReferenceSnippet }}
                        </div>
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
