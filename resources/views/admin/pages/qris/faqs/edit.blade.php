@extends('layouts.admin', ['title' => 'Edit FAQ QRIS'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit FAQ QRIS</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui informasi tanya jawab QRIS.</p>
    </div>

    @include('admin.pages.qris.faqs.form', [
        'faq' => $faq,
        'action' => route('admin.pages.qris.faqs.update', $faq),
    ])
@endsection
