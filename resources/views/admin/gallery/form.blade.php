@php
    use App\Models\GalleryItem;

    $item = $galleryItem ?? null;
    $statuses = [
        GalleryItem::STATUS_DRAFT => 'Draft (tidak tampil)',
        GalleryItem::STATUS_SUBMITTED => 'Menunggu persetujuan',
        GalleryItem::STATUS_PUBLISHED => 'Publik',
    ];
    $statusValue = old('status', $item->status ?? GalleryItem::STATUS_PUBLISHED);
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if (($method ?? 'POST') !== 'POST')
        @method($method)
    @endif

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Judul <span class="text-rose-600">*</span></label>
            <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            @error('title')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Urutan tampilan</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" min="0">
            @error('sort_order')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Caption</label>
        <textarea name="caption" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Tuliskan deskripsi singkat atau kredit fotografer">{{ old('caption', $item->caption ?? '') }}</textarea>
        @error('caption')
            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Status</label>
            <select name="status" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected($statusValue === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('status')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="space-y-2">
            <label class="mb-1 block text-sm font-semibold text-slate-700">Gambar <span class="text-rose-600">*</span></label>
            <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            @error('image')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror

            @if ($item?->image_path)
                <div class="space-y-2 rounded-xl border border-slate-200 bg-slate-50 p-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pratinjau saat ini</p>
                    <img src="{{ \App\Support\Media::url($item->image_path) }}" alt="{{ $item->title }}" class="h-32 w-full rounded-lg object-cover">
                    <label class="inline-flex items-center gap-2 text-xs text-rose-600">
                        <input type="checkbox" name="remove_image" value="1" {{ old('remove_image') ? 'checked' : '' }}>
                        Hapus gambar
                    </label>
                </div>
            @endif
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-800">
            Batal
        </a>
        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
            Simpan
        </button>
    </div>
</form>

