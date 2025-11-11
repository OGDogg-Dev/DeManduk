@extends('layouts.admin', ['title' => 'Ubah Pengguna'])

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                &larr; Kembali ke daftar pengguna
            </a>
            <h1 class="mt-3 text-2xl font-semibold text-slate-900">Ubah Data Pengguna</h1>
            <p class="mt-1 text-sm text-slate-600">Perbarui informasi akun dan status penyetujuannya.</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                @include('admin.users._form', ['user' => $user])
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    >
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-700">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
