@extends('layouts.admin', ['title' => 'Edit Instansi Pendukung'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Instansi Pendukung</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui informasi instansi yang tampil pada halaman kontak.</p>
    </div>

    @include('admin.pages.contact.supports.form', [
        'support' => $support,
        'action' => route('admin.pages.contact.supports.update', $support),
    ])
@endsection
