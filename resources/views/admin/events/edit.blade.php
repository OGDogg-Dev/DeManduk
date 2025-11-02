@extends('layouts.admin', ['title' => 'Edit Event'])

@section('content')
    <h1 class="text-2xl font-semibold text-slate-900">Edit Event Publik</h1>
    <p class="mt-2 text-sm text-slate-600">Perbarui informasi event dan status publikasinya.</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('admin.events.form', [
            'action' => route('admin.events.update', $event),
            'event' => $event,
        ])
    </div>
@endsection
