@props(['slide' => null, 'action' => '#'])

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if($slide)
        @method('PUT')
    @endif

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Eyebrow</label>
            <input type="text" name="eyebrow" value="{{ old('eyebrow', $slide->eyebrow ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Urutan</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $slide->sort_order ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Judul <span class="text-rose-600">*</span></label>
        <input type="text" name="title" value="{{ old('title', $slide->title ?? '') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Deskripsi</label>
        <textarea name="description" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('description', $slide->description ?? '') }}</textarea>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Label CTA</label>
            <input type="text" name="cta_label" value="{{ old('cta_label', $slide->cta_label ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">URL CTA</label>
            <input type="text" name="cta_url" value="{{ old('cta_url', $slide->cta_url ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="https:// atau /path">
        </div>
    </div>

    <div class="space-y-2">
        <label class="block text-sm font-semibold text-slate-700">Gambar <span class="text-rose-600">*</span></label>
        <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" {{ $slide ? '' : 'required' }}>
        @error('image')
            <p class="text-xs text-rose-600">{{ $message }}</p>
        @enderror
        @if ($slide && $slide->image_path)
            <div class="space-y-2 rounded-xl border border-slate-200 bg-slate-50 p-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pratinjau saat ini</p>
                <img src="{{ \App\Support\Media::url($slide->image_path) }}" alt="{{ $slide->title }}" class="h-32 w-full rounded-lg object-cover">
                <label class="inline-flex items-center gap-2 text-xs text-rose-600">
                    <input type="checkbox" name="remove_image" value="1" {{ old('remove_image') ? 'checked' : '' }}>
                    Hapus gambar
                </label>
            </div>
        @endif
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.home.slides.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-800">Batal</a>
        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
            Simpan
        </button>
    </div>
</form>
