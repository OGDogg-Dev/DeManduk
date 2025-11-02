@extends('layouts.admin', ['title' => 'Edit Fasilitas'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Edit Fasilitas</h1>
    <p class="mt-2 text-sm text-slate-600">Perbarui informasi fasilitas beranda.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.features.form', [
            'action' => route('admin.home.features.update', $feature),
            'feature' => $feature,
        ])
    </div>
@endsection
