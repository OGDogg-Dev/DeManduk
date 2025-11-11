@extends('layouts.admin', ['title' => 'Tambah Pengguna'])

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                &larr; Kembali ke daftar pengguna
            </a>
            <h1 class="mt-3 text-2xl font-semibold text-slate-900">Tambah Pengguna Baru</h1>
            <p class="mt-1 text-sm text-slate-600">Isi detail akun dan tentukan peran yang sesuai.</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                @csrf
                @include('admin.users._form')
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
