@extends('layouts.app')

@section('content')
    <section class="relative flex min-h-[70vh] items-center justify-center bg-gradient-to-br from-blue-50 via-white to-slate-50 py-24">
        <div class="mx-auto w-full max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div class="space-y-6 text-slate-700">
                    <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-1 text-sm font-semibold uppercase tracking-wide text-blue-700">
                        Admin Area
                    </span>
                    <h1 class="text-3xl font-bold text-slate-900 sm:text-4xl">
                        Masuk untuk mengelola portal Waduk Manduk
                    </h1>
                    <p class="text-base leading-relaxed">
                        Gunakan akun admin yang terdaftar untuk memperbarui konten publik, jadwal event, dan informasi tiket digital.
                        Jika Anda membutuhkan akses, hubungi super admin desa.
                    </p>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li>• Konten publik akan otomatis tersambung ke komponen laman utama.</li>
                        <li>• Aktivitas login dicatat untuk audit internal Pokdarwis.</li>
                        <li>• Pastikan Anda keluar setelah selesai menggunakan dashboard.</li>
                    </ul>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-xl shadow-blue-100/40">
                    <form action="{{ route('login.perform') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2 text-center">
                            <h2 class="text-2xl font-semibold text-slate-900">Masuk Admin</h2>
                            <p class="text-sm text-slate-500">
                                Masukkan email dan kata sandi yang telah terdaftar.
                            </p>
                        </div>

                        @if ($errors->any())
                            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="space-y-1">
                            <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                placeholder="nama@wadukmanduk.id"
                            >
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center justify-between">
                                <label for="password" class="text-sm font-semibold text-slate-700">Kata sandi</label>
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                placeholder="Masukkan kata sandi"
                            >
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    {{ old('remember') ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                >
                                Ingat saya
                            </label>
                            <a href="{{ route('home') }}" class="text-sm font-semibold text-blue-600 transition hover:text-blue-700">
                                Kembali ke beranda
                            </a>
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        >
                            Masuk ke Dashboard
                        </button>

                        <p class="text-center text-sm text-slate-500">
                            Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700">Daftar kontributor</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
