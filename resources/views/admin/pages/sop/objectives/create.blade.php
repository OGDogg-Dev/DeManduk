@extends('layouts.admin', ['title' => 'Tambah Tujuan SOP'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Tujuan SOP</h1>
        <p class="mt-2 text-sm text-slate-600">Tambahkan tujuan baru untuk halaman SOP.</p>
    </div>

    @include('admin.pages.sop.objectives.form', [
        'objective' => null,
        'action' => route('admin.pages.sop.objectives.store'),
    ])
@endsection
