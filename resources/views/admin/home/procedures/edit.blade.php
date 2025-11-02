@extends('layouts.admin', ['title' => 'Edit Highlight SOP'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Edit Highlight SOP</h1>
    <p class="mt-2 text-sm text-slate-600">Perbarui highlight SOP pada beranda.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.procedures.form', [
            'action' => route('admin.home.procedures.update', $procedure),
            'procedure' => $procedure,
        ])
    </div>
@endsection
