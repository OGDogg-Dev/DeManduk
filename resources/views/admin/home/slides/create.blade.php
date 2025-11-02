@extends('layouts.admin', ['title' => 'Tambah Slide'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Tambah Slide Beranda</h1>
    <p class="mt-2 text-sm text-slate-600">Isi data berikut untuk menambahkan slide baru pada beranda publik.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.slides.form', [
            'action' => route('admin.home.slides.store'),
            'slide' => null,
        ])
    </div>
@endsection
