@props(['event' => null, 'action' => '#'])

@php
    $eventDate = old('event_date', optional($event?->event_date)->format('Y-m-d'));
    $startTime = old('start_time', optional($event?->start_time)->format('H:i'));
    $endTime = old('end_time', optional($event?->end_time)->format('H:i'));
    $isPublished = old('published_toggle', $event?->published_at ? 1 : 0);
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if($event)
        @method('PUT')
    @endif

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Judul <span class="text-rose-600">*</span></label>
            <input type="text" name="title" value="{{ old('title', $event->title ?? '') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $event->slug ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="opsional, gunakan huruf tanpa spasi">
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Tanggal acara</label>
            <input type="date" name="event_date" value="{{ $eventDate }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Jam mulai</label>
            <input type="time" name="start_time" value="{{ $startTime }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Jam selesai</label>
            <input type="time" name="end_time" value="{{ $endTime }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Kategori</label>
            <input type="text" name="category" value="{{ old('category', $event->category ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Contoh: Festival, Komunitas">
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold text-slate-700">Lokasi</label>
            <input type="text" name="location" value="{{ old('location', $event->location ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Ringkasan singkat</label>
        <input type="text" name="excerpt" value="{{ old('excerpt', $event->excerpt ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Maksimal 255 karakter">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Deskripsi lengkap</label>
        <textarea name="body" rows="8" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Isi konten utama">{{ old('body', $event->body ?? '') }}</textarea>
    </div>

    <div class="space-y-2">
        <label class="block text-sm font-semibold text-slate-700">Gambar sampul</label>
        <input type="file" name="cover_image" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        @if ($event && $event->cover_image)
            <img src="{{ \App\Support\Media::url($event->cover_image) }}" alt="{{ $event->title }}" class="h-32 w-auto rounded-lg border border-slate-200 object-cover">
        @endif
    </div>

    <div class="flex items-center justify-between gap-4">
        <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-700">
            <input type="checkbox" name="published_toggle" value="1" {{ $isPublished ? 'checked' : '' }}>
            Tandai sebagai dipublikasikan
        </label>
        <div class="flex gap-3">
            <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-800">Batal</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">Simpan</button>
        </div>
    </div>
</form>
