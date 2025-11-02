@extends('layouts.admin', ['title' => 'Tambah Event'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Tambah Event Publik</h1>
    <p class="mt-2 text-sm text-slate-600">Isi informasi event untuk ditampilkan pada halaman publik.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.events.form', [
            'action' => route('admin.events.store'),
            'event' => null,
        ])
    </div>
@endsection
