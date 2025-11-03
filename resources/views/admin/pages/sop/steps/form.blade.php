@props(['step' => null, 'action' => '#'])

@php
    $itemsValue = old('items');
    if ($itemsValue === null) {
        $itemsValue = collect($step->items ?? [])->implode("\n");
    }
@endphp

<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if ($step)
        @method('PUT')
    @endif

    <div class="space-y-2">
        <label class="block text-sm font-semibold text-slate-700">Judul langkah <span class="text-rose-600">*</span></label>
        <input type="text" name="title" value="{{ old('title', $step->title ?? '') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        @error('title')
            <p class="text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label class="block text-sm font-semibold text-slate-700">Langkah detail</label>
        <textarea name="items" rows="6" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Pisahkan tiap butir dengan baris baru">{{ $itemsValue }}</textarea>
        @error('items')
            <p class="text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label class="block text-sm font-semibold text-slate-700">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $step->sort_order ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        @error('sort_order')
            <p class="text-xs text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.pages.sop.steps.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-800">Batal</a>
        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">Simpan</button>
    </div>
</form>
