@extends('layouts.admin', ['title' => 'Langkah Pembayaran QRIS'])

@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Langkah Pembayaran</h1>
            <p class="mt-2 text-sm text-slate-600">Kelola langkah-langkah yang ditampilkan pada panduan QRIS.</p>
        </div>
        <a href="{{ route('admin.pages.qris.steps.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
            Tambah Langkah
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
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Deskripsi</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Urutan</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($steps as $step)
                    <tr>
                        <td class="px-5 py-4 font-semibold text-slate-900">{{ $step->title }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $step->description }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $step->sort_order }}</td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.pages.qris.steps.edit', $step) }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-600">Edit</a>
                            <form action="{{ route('admin.pages.qris.steps.destroy', $step) }}" method="POST" class="ml-1 inline-block" onsubmit="return confirm('Hapus langkah ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-3 py-1 text-xs font-semibold text-rose-600 transition hover:border-rose-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-6 text-center text-sm text-slate-500">
                            Belum ada langkah ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
