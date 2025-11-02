@extends('layouts.admin', ['title' => 'Tambah Jam Operasional'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Tambah Jam Operasional</h1>
    <p class="mt-2 text-sm text-slate-600">Tambahkan informasi jam operasional terbaru.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.hours.form', [
            'action' => route('admin.home.hours.store'),
            'hour' => null,
        ])
    </div>
@endsection
