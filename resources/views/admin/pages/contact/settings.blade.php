@extends('layouts.admin', ['title' => 'Pengaturan Halaman Kontak'])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Pengaturan Kontak</h1>
        <p class="mt-2 text-sm text-slate-600">Perbarui informasi utama yang tampil pada halaman kontak publik.</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.pages.contact.settings.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Subjudul</label>
                <textarea name="subtitle" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('subtitle', $subtitle) }}</textarea>
                @error('subtitle')
                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Alamat</label>
                    <textarea name="address" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('address', $address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $phone) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @error('phone')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $email) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        @error('email')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8">
        <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Kelola konten terkait</h2>
        <div class="mt-3 grid gap-4 md:grid-cols-2">
            <a href="{{ route('admin.pages.contact.supports.index') }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Instansi Pendukung</h3>
                    <p class="mt-2 text-sm text-slate-600">Tambah atau ubah daftar instansi yang tampil pada halaman kontak.</p>
                </div>
                <span class="mt-4 text-sm font-semibold text-blue-600">Kelola instansi -></span>
            </a>
            <a href="{{ route('admin.pages.contact.alerts.index') }}" class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Peringatan Kontak</h3>
                    <p class="mt-2 text-sm text-slate-600">Atur pesan prioritas seperti kanal komunikasi cepat atau himbauan darurat.</p>
                </div>
                <span class="mt-4 text-sm font-semibold text-blue-600">Kelola peringatan -></span>
            </a>
        </div>
    </div>
@endsection
