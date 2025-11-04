@extends('layouts.admin', ['title' => 'Instansi Pendukung'])

@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Instansi Pendukung</h1>
            <p class="mt-2 text-sm text-slate-600">Kelola daftar instansi yang ditampilkan pada halaman kontak.</p>
        </div>
        <a href="{{ route('admin.pages.contact.supports.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
            Tambah Instansi
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
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Nama</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Deskripsi</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Nomor Telepon</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Urutan</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($supports as $support)
                    <tr>
                        <td class="px-5 py-4 font-semibold text-slate-900">{{ $support->title }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $support->description }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">
                            @if ($support->phone)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    {{ $support->phone }}
                                </div>
                            @else
                                <span class="text-slate-400 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $support->sort_order }}</td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.pages.contact.supports.edit', $support) }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-600">Edit</a>
                            <form action="{{ route('admin.pages.contact.supports.destroy', $support) }}" method="POST" class="ml-1 inline-block" onsubmit="return confirm('Hapus instansi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-3 py-1 text-xs font-semibold text-rose-600 transition hover:border-rose-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-6 text-center text-sm text-slate-500">
                            Belum ada data instansi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
