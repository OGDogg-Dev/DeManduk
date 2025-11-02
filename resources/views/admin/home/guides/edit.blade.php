@extends('layouts.admin', ['title' => 'Edit Panduan SOP'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Edit Panduan SOP</h1>
    <p class="mt-2 text-sm text-slate-600">Perbarui langkah-langkah panduan kunjungan.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.guides.form', [
            'action' => route('admin.home.guides.update', $guide),
            'guide' => $guide,
        ])
    </div>
@endsection
