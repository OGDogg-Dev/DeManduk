@extends('layouts.admin', ['title' => 'Kelola Galeri'])

@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Galeri Publik</h1>
            <p class="mt-2 text-sm text-slate-600">Tambahkan foto terbaru, atur status publikasi, dan kelola urutan tampilan.</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
            Tambah Item
        </a>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Foto</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Judul &amp; Caption</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Status</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Urutan</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($items as $item)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="h-16 w-24 overflow-hidden rounded-lg border border-slate-200 bg-slate-100">
                                @if ($item->image_path)
                                    <img src="{{ \App\Support\Media::url($item->image_path) }}" alt="{{ $item->title }}" class="h-full w-full object-cover">
                                @else
                                    <span class="flex h-full w-full items-center justify-center text-xs text-slate-400">Tidak ada gambar</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-slate-900">{{ $item->title }}</div>
                            @if ($item->caption)
                                <div class="text-xs text-slate-500">{{ \Illuminate\Support\Str::limit($item->caption, 90) }}</div>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            @php
                                $statusLabels = [
                                    \App\Models\GalleryItem::STATUS_DRAFT => ['label' => 'Draft', 'class' => 'bg-slate-100 text-slate-600 border border-slate-200'],
                                    \App\Models\GalleryItem::STATUS_SUBMITTED => ['label' => 'Menunggu', 'class' => 'bg-amber-50 text-amber-600 border border-amber-200'],
                                    \App\Models\GalleryItem::STATUS_PUBLISHED => ['label' => 'Publik', 'class' => 'bg-emerald-50 text-emerald-600 border border-emerald-200'],
                                ];
                                $status = $statusLabels[$item->status] ?? $statusLabels[\App\Models\GalleryItem::STATUS_DRAFT];
                            @endphp
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $status['class'] }}">
                                {{ $status['label'] }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            {{ $item->sort_order }}
                        </td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.gallery.edit', $item) }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-600">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="ml-1 inline-block" onsubmit="return confirm('Hapus item galeri ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-3 py-1 text-xs font-semibold text-rose-600 transition hover:border-rose-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-6 text-center text-sm text-slate-500">
                            Belum ada item galeri. Tambahkan foto pertama Anda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $items->links() }}
    </div>
@endsection

