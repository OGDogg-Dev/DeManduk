@extends('layouts.admin', ['title' => 'Kelola Agenda Beranda'])

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-slate-900">Agenda Beranda</h1>
        <a href="{{ route('admin.home.projects.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">Tambah Agenda</a>
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
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Urutan</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($projects as $project)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-slate-900">{{ $project->title }}</div>
                            <div class="text-xs text-slate-500">{{ \Illuminate\Support\Str::limit($project->description, 80) }}</div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">{{ $project->sort_order }}</td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.home.projects.edit', $project) }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-600">Edit</a>
                            <form action="{{ route('admin.home.projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus agenda ini?');">
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

