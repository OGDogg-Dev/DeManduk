@extends('layouts.admin', ['title' => 'Edit Langkah SOP'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Langkah SOP</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui detail langkah SOP.</p>
    </div>

    @include('admin.pages.sop.steps.form', [
        'step' => $step,
        'action' => route('admin.pages.sop.steps.update', $step),
    ])
@endsection
