@extends('layouts.admin', ['title' => 'Edit Tujuan SOP'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Tujuan SOP</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui tujuan SOP.</p>
    </div>

    @include('admin.pages.sop.objectives.form', [
        'objective' => $objective,
        'action' => route('admin.pages.sop.objectives.update', $objective),
    ])
@endsection
