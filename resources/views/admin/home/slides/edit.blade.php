@extends('layouts.admin', ['title' => 'Edit Slide'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Edit Slide Beranda</h1>
    <p class="mt-2 text-sm text-slate-600">Perbarui informasi slide untuk menyesuaikan konten halaman beranda.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.slides.form', [
            'action' => route('admin.home.slides.update', $slide),
            'slide' => $slide,
        ])
    </div>
@endsection
