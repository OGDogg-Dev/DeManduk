@extends('layouts.admin', ['title' => 'Tambah Statistik'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Tambah Statistik</h1>
    <p class="mt-2 text-sm text-slate-600">Statistik ditampilkan pada ringkasan SOP di beranda.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.stats.form', [
            'action' => route('admin.home.stats.store'),
            'stat' => null,
        ])
    </div>
@endsection
