@extends('layouts.admin', ['title' => 'Tambah Panduan SOP'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Tambah Panduan SOP</h1>
    <p class="mt-2 text-sm text-slate-600">Daftar langkah ini akan muncul pada section Panduan di beranda.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.guides.form', [
            'action' => route('admin.home.guides.store'),
            'guide' => null,
        ])
    </div>
@endsection
