@php
    $post = $post ?? null;
    $method = $method ?? 'POST';
    $tagsValue = old('tags');
    if ($tagsValue === null) {
        $tagsValue = collect($post?->tags ?? [])->implode(', ');
    }
    $isPublished = old('published_toggle', $post?->published_at ? 1 : 0);
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Judul <span class="text-rose-600">*</span></label>
            <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            @error('title')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="opsional, gunakan huruf tanpa spasi">
            @error('slug')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Penulis</label>
            <input type="text" name="author" value="{{ old('author', $post->author ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            @error('author')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Kategori</label>
            <input type="text" name="category" value="{{ old('category', $post->category ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Contoh: Pengembangan, UMKM">
            @error('category')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Durasi baca (menit)</label>
            <input type="number" name="read_time_minutes" value="{{ old('read_time_minutes', $post->read_time_minutes ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" min="1" max="240">
            @error('read_time_minutes')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
            <div>
                <p class="text-sm font-semibold text-slate-800">Terbitkan sekarang</p>
                <p class="text-xs text-slate-500">Jika tidak dicentang, berita disimpan sebagai draft.</p>
            </div>
            <label class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600">
                <input type="checkbox" name="published_toggle" value="1" {{ $isPublished ? 'checked' : '' }}>
                Terbit
            </label>
        </div>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Ringkasan singkat</label>
        <textarea name="excerpt" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Tulis ringkasan maksimal 500 karakter">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        @error('excerpt')
            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Isi lengkap</label>
        <textarea name="body" rows="10" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Gunakan enter ganda untuk membuat paragraf baru">{{ old('body', $post->body ?? '') }}</textarea>
        @error('body')
            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Tag (pisahkan dengan koma)</label>
        <input type="text" name="tags" value="{{ $tagsValue }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Contoh: Fasilitas, UMKM, Komunitas">
        @error('tags')
            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label class="block text-sm font-semibold text-slate-700">Gambar sampul</label>
        <input type="file" name="cover_image" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        @error('cover_image')
            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
        @enderror
        @if ($post?->cover_image)
            <div class="space-y-2 rounded-xl border border-slate-200 bg-slate-50 p-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pratinjau saat ini</p>
                <img src="{{ \App\Support\Media::url($post->cover_image) }}" alt="{{ $post->title }}" class="h-40 w-full rounded-lg object-cover">
                <label class="inline-flex items-center gap-2 text-xs text-rose-600">
                    <input type="checkbox" name="remove_cover_image" value="1" {{ old('remove_cover_image') ? 'checked' : '' }}>
                    Hapus gambar
                </label>
            </div>
        @endif
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-800">
            Batal
        </a>
        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
            Simpan
        </button>
    </div>
</form>

