@extends('layouts.admin', ['title' => 'Edit Harga/Fasilitas'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Edit Harga atau Fasilitas</h1>
    <p class="mt-2 text-sm text-slate-600">Perbarui data harga sesuai kebutuhan terbaru.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.home.pricing.form', [
            'action' => route('admin.home.pricing.update', $pricing),
            'pricing' => $pricing,
        ])
    </div>
@endsection
