@extends('layouts.admin', ['title' => 'Tambah Agenda'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Tambah Agenda Beranda</h1>
    <p class="mt-2 text-sm text-slate-600">Konten agenda akan tampil pada section Agenda di beranda publik.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.projects.form', [
            'action' => route('admin.home.projects.store'),
            'project' => null,
        ])
    </div>
@endsection
