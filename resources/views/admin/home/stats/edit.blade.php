@extends('layouts.admin', ['title' => 'Edit Statistik'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Edit Statistik</h1>
    <p class="mt-2 text-sm text-slate-600">Perbarui angka statistik beranda.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.stats.form', [
            'action' => route('admin.home.stats.update', $stat),
            'stat' => $stat,
        ])
    </div>
@endsection
