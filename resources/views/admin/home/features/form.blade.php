@props(['feature' => null, 'action' => '#'])

<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if($feature)
        @method('PUT')
    @endif

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Judul <span class="text-rose-600">*</span></label>
            <input type="text" name="title" value="{{ old('title', $feature->title ?? '') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Urutan</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $feature->sort_order ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Deskripsi</label>
        <textarea name="description" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('description', $feature->description ?? '') }}</textarea>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.home.features.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-800">Batal</a>
        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">Simpan</button>
    </div>
</form>
