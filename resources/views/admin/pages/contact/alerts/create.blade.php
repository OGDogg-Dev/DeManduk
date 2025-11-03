@extends('layouts.admin', ['title' => 'Tambah Peringatan Kontak'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Peringatan Kontak</h1>
        <p class="mt-2 text-sm text-slate-600">Masukkan pesan penting untuk pengunjung halaman kontak.</p>
    </div>

    @include('admin.pages.contact.alerts.form', [
        'alert' => null,
        'action' => route('admin.pages.contact.alerts.store'),
    ])
@endsection
