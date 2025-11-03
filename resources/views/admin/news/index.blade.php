@extends('layouts.admin', ['title' => 'Kelola Berita'])

@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Berita Publik</h1>
            <p class="mt-2 text-sm text-slate-600">Publikasikan informasi terbaru, artikel komunitas, dan liputan media Waduk Manduk.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
            Tulis Berita
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
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Judul</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Kategori</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Penulis</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Status</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($posts as $post)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="flex items-start gap-3">
                                <div class="h-16 w-24 overflow-hidden rounded-lg border border-slate-200 bg-slate-100">
                                    @if ($post->cover_image)
                                        <img src="{{ \App\Support\Media::url($post->cover_image) }}" alt="{{ $post->title }}" class="h-full w-full object-cover">
                                    @else
                                        <span class="flex h-full w-full items-center justify-center text-xs text-slate-400">Tidak ada gambar</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">{{ $post->title }}</div>
                                    @if ($post->excerpt)
                                        <div class="text-xs text-slate-500">{{ \Illuminate\Support\Str::limit($post->excerpt, 90) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">{{ $post->category ?? 'Tidak ada' }}</td>
                        <td class="px-5 py-4 text-slate-600">{{ $post->author ?? 'Tim Redaksi' }}</td>
                        <td class="px-5 py-4">
                            @if ($post->published_at)
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    Terbit {{ $post->published_at->translatedFormat('d M Y') }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                    Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.news.edit', $post) }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-600">Edit</a>
                            <form action="{{ route('admin.news.destroy', $post) }}" method="POST" class="ml-1 inline-block" onsubmit="return confirm('Hapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-3 py-1 text-xs font-semibold text-rose-600 transition hover:border-rose-300">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-6 text-center text-sm text-slate-500">
                            Belum ada berita yang ditulis. Mulai dengan menulis artikel pertama Anda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="border-t border-slate-200 bg-slate-50 px-5 py-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

