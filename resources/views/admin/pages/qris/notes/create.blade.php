@extends('layouts.admin', ['title' => 'Tambah Catatan QRIS'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Catatan QRIS</h1>
        <p class="mt-2 text-sm text-slate-600">Masukkan catatan tambahan untuk informasi QRIS.</p>
    </div>

    @include('admin.pages.qris.notes.form', [
        'note' => null,
        'action' => route('admin.pages.qris.notes.store'),
    ])
@endsection
