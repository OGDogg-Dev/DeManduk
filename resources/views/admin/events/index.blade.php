@extends('layouts.admin', ['title' => 'Kelola Event'])

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-slate-900">Event Publik</h1>
        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">Tambah Event</a>
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
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Tanggal</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-500">Status</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($events as $event)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-slate-900">{{ $event->title }}</div>
                            <div class="text-xs text-slate-500">{{ $event->category }}</div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            {{ $event->event_date ? $event->event_date->translatedFormat('d F Y') : 'TBA' }}
                        </td>
                        <td class="px-5 py-4">
                            @if ($event->published_at)
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Terbit</span>
                            @else
                                <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">Draft</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.events.edit', $event) }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-600">Edit</a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus event ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-3 py-1 text-xs font-semibold text-rose-600 transition hover:border-rose-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="border-t border-slate-200 bg-slate-50 px-5 py-4">
            {{ $events->links() }}
        </div>
    </div>
@endsection
