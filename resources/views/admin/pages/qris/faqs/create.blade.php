@extends('layouts.admin', ['title' => 'Tambah FAQ QRIS'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah FAQ QRIS</h1>
        <p class="mt-2 text-sm text-slate-600">Tambahkan pertanyaan untuk membantu pengunjung memahami cara bayar QRIS.</p>
    </div>

    @include('admin.pages.qris.faqs.form', [
        'faq' => null,
        'action' => route('admin.pages.qris.faqs.store'),
    ])
@endsection
