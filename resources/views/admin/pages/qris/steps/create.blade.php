@extends('layouts.admin', ['title' => 'Tambah Langkah QRIS'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Langkah QRIS</h1>
        <p class="mt-2 text-sm text-slate-600">Tambahkan langkah baru pada panduan QRIS.</p>
    </div>

    @include('admin.pages.qris.steps.form', [
        'step' => null,
        'action' => route('admin.pages.qris.steps.store'),
    ])
@endsection
