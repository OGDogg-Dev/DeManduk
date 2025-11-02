@extends('layouts.admin', ['title' => 'Kelola Harga dan Fasilitas'])

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-slate-900">Harga & Fasilitas</h1>
        <a href="{{ route('admin.home.pricing.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">Tambah Data</a>
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
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Kategori</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Item</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Tarif</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Keterangan</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($pricing as $row)
                    <tr>
                        <td class="px-5 py-4 text-slate-600">{{ $row->category === 'ticket' ? 'Tiket' : 'Fasilitas' }}</td>
                        <td class="px-5 py-4 font-semibold text-slate-900">{{ $row->label }}</td>
                        <td class="px-5 py-4 text-slate-600">{{ $row->price ?: '-' }}</td>
                        <td class="px-5 py-4 text-slate-600">{{ $row->description }}</td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.home.pricing.edit', $row) }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-600">Edit</a>
                            <form action="{{ route('admin.home.pricing.destroy', $row) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-3 py-1 text-xs font-semibold text-rose-600 transition hover:border-rose-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
