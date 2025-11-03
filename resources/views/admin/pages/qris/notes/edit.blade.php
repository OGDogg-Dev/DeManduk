@extends('layouts.admin', ['title' => 'Edit Catatan QRIS'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Catatan QRIS</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui catatan QRIS yang sudah ada.</p>
    </div>

    @include('admin.pages.qris.notes.form', [
        'note' => $note,
        'action' => route('admin.pages.qris.notes.update', $note),
    ])
@endsection
