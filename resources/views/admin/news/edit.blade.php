@extends('layouts.admin', ['title' => 'Edit Berita'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Berita</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui isi artikel, status publikasi, atau gambar sampul.</p>
    </div>

    @include('admin.news.form', [
        'post' => $post,
        'action' => route('admin.news.update', $post),
        'method' => 'PUT',
    ])
@endsection

