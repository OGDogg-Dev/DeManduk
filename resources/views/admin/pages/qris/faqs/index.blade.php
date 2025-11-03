@extends('layouts.admin', ['title' => 'FAQ QRIS'])

@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">FAQ QRIS</h1>
            <p class="mt-2 text-sm text-slate-600">Kelola daftar pertanyaan yang membantu pengunjung memahami QRIS.</p>
        </div>
        <a href="{{ route('admin.pages.qris.faqs.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
            Tambah FAQ
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
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Pertanyaan</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Ikon</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Urutan</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($faqs as $faq)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-slate-900">{{ $faq->title }}</div>
                            @if ($faq->body)
                                <div class="text-xs text-slate-500">{{ \Illuminate\Support\Str::limit($faq->body, 120) }}</div>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $faq->icon }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $faq->sort_order }}</td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.pages.qris.faqs.edit', $faq) }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-600">Edit</a>
                            <form action="{{ route('admin.pages.qris.faqs.destroy', $faq) }}" method="POST" class="ml-1 inline-block" onsubmit="return confirm('Hapus FAQ ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-3 py-1 text-xs font-semibold text-rose-600 transition hover:border-rose-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-6 text-center text-sm text-slate-500">
                            Belum ada FAQ ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
