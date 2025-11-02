@extends('layouts.admin', ['title' => 'Tambah Fasilitas'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Tambah Fasilitas</h1>
    <p class="mt-2 text-sm text-slate-600">Konten ini akan tampil pada section Fasilitas di beranda.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.features.form', [
            'action' => route('admin.home.features.store'),
            'feature' => null,
        ])
    </div>
@endsection
