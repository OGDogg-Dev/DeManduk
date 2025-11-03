@extends('layouts.admin', ['title' => 'Edit Instansi Pendukung SOP'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Instansi Pendukung</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui informasi instansi pada halaman SOP.</p>
    </div>

    @include('admin.pages.sop.partners.form', [
        'partner' => $partner,
        'action' => route('admin.pages.sop.partners.update', $partner),
    ])
@endsection
