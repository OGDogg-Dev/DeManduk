@extends('layouts.admin', ['title' => 'Edit Item Galeri'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Item Galeri</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui detail foto atau status publikasi.</p>
    </div>

    @include('admin.gallery.form', [
        'galleryItem' => $galleryItem,
        'action' => route('admin.gallery.update', $galleryItem),
        'method' => 'PUT',
    ])
@endsection

