@extends('layouts.admin', ['title' => 'Tambah Instansi Pendukung SOP'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Instansi Pendukung</h1>
        <p class="mt-2 text-sm text-slate-600">Masukkan instansi baru yang tercantum di halaman SOP.</p>
    </div>

    @include('admin.pages.sop.partners.form', [
        'partner' => null,
        'action' => route('admin.pages.sop.partners.store'),
    ])
@endsection
