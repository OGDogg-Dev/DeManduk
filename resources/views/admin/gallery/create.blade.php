@extends('layouts.admin', ['title' => 'Tambah Item Galeri'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Item Galeri</h1>
        <p class="mt-2 text-sm text-slate-600">Unggah foto dan isi detailnya untuk tampil di halaman publik.</p>
    </div>

    @include('admin.gallery.form', [
        'galleryItem' => null,
        'action' => route('admin.gallery.store'),
        'method' => 'POST',
    ])
@endsection

