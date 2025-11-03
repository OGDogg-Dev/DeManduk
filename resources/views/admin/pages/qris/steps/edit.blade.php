@extends('layouts.admin', ['title' => 'Edit Langkah QRIS'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Langkah QRIS</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui detail langkah QRIS.</p>
    </div>

    @include('admin.pages.qris.steps.form', [
        'step' => $step,
        'action' => route('admin.pages.qris.steps.update', $step),
    ])
@endsection
