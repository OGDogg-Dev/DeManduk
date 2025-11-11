@extends('layouts.app')

@section('content')
    <section class="relative flex min-h-[70vh] items-center justify-center bg-gradient-to-br from-emerald-50 via-white to-slate-50 py-24">
        <div class="mx-auto w-full max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div class="space-y-6 text-slate-700">
                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-1 text-sm font-semibold uppercase tracking-wide text-emerald-700">
                        Daftar Kontributor
                    </span>
                    <h1 class="text-3xl font-bold text-slate-900 sm:text-4xl">
                        Bergabung sebagai kontributor konten Waduk Manduk
                    </h1>
                    <p class="text-base leading-relaxed">
                        Akun yang didaftarkan melalui formulir ini otomatis mendapatkan peran <strong>Kontributor</strong>.
                        Anda dapat menulis berita, mengunggah dokumentasi, atau membantu tim admin memperbarui informasi wisata.
                    </p>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li>�?� Gunakan email aktif agar admin dapat menghubungi Anda.</li>
                        <li>�?� Tim admin bisa mengubah peran atau menonaktifkan akun kapan saja.</li>
                        <li>�?� Simpan kredensial Anda secara aman untuk menghindari penyalahgunaan.</li>
                    </ul>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-xl shadow-emerald-100/40">
                    <form action="{{ route('register.perform') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="space-y-2 text-center">
                            <h2 class="text-2xl font-semibold text-slate-900">Buat Akun Kontributor</h2>
                            <p class="text-sm text-slate-500">Lengkapi data diri Anda di bawah ini.</p>
                        </div>

                        @if ($errors->any())
                            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="space-y-1">
                            <label for="name" class="text-sm font-semibold text-slate-700">Nama lengkap</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-emerald-300 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                                placeholder="Nama Anda"
                            >
                        </div>

                        <div class="space-y-1">
                            <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-emerald-300 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                                placeholder="nama@domain.id"
                            >
                        </div>

                        <div class="space-y-1">
                            <label for="password" class="text-sm font-semibold text-slate-700">Kata sandi</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-emerald-300 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                                placeholder="Minimal 8 karakter"
                            >
                        </div>

                        <div class="space-y-1">
                            <label for="password_confirmation" class="text-sm font-semibold text-slate-700">Konfirmasi kata sandi</label>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-emerald-300 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                                placeholder="Ulangi kata sandi"
                            >
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2"
                        >
                            Daftar &amp; Gabung Kontributor
                        </button>

                        <p class="text-center text-sm text-slate-500">
                            Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Masuk di sini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
