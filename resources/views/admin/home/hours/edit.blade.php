@extends('layouts.admin', ['title' => 'Edit Jam Operasional'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Edit Jam Operasional</h1>
    <p class="mt-2 text-sm text-slate-600">Perbarui informasi jam operasional sesuai kebutuhan.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.hours.form', [
            'action' => route('admin.home.hours.update', $hour),
            'hour' => $hour,
        ])
    </div>
@endsection
