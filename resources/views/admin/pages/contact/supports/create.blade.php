@extends('layouts.admin', ['title' => 'Tambah Instansi Pendukung'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Instansi Pendukung</h1>
        <p class="mt-2 text-sm text-slate-600">Masukkan detail instansi yang akan ditampilkan pada halaman kontak.</p>
    </div>

    @include('admin.pages.contact.supports.form', [
        'support' => null,
        'action' => route('admin.pages.contact.supports.store'),
    ])
@endsection
