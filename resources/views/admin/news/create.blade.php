@extends('layouts.admin', ['title' => 'Tulis Berita Baru'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tulis Berita Baru</h1>
        <p class="mt-2 text-sm text-slate-600">Isi detail artikel, unggah gambar sampul, dan terbitkan ke halaman berita publik.</p>
    </div>

    @include('admin.news.form', [
        'post' => null,
        'action' => route('admin.news.store'),
        'method' => 'POST',
    ])
@endsection

