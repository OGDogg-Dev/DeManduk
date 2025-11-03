@extends('layouts.admin', ['title' => 'Tambah Langkah SOP'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Langkah SOP</h1>
        <p class="mt-2 text-sm text-slate-600">Masukkan langkah baru untuk panduan SOP.</p>
    </div>

    @include('admin.pages.sop.steps.form', [
        'step' => null,
        'action' => route('admin.pages.sop.steps.store'),
    ])
@endsection
