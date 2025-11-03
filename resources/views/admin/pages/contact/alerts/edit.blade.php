@extends('layouts.admin', ['title' => 'Edit Peringatan Kontak'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Peringatan Kontak</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui pesan penting pada halaman kontak.</p>
    </div>

    @include('admin.pages.contact.alerts.form', [
        'alert' => $alert,
        'action' => route('admin.pages.contact.alerts.update', $alert),
    ])
@endsection
