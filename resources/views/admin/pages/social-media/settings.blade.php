@extends('layouts.admin', ['title' => 'Pengaturan Media Sosial'])

@section('content')
    <div class="space-y-6">
        <header class="border-b border-slate-200 pb-4">
            <h1 class="text-2xl font-bold text-slate-900">Pengaturan Media Sosial</h1>
            <p class="mt-2 text-slate-600">Kelola tautan akun media sosial publik untuk ditampilkan di footer.</p>
        </header>

        <form method="POST" action="{{ route('admin.pages.social-media.settings.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3 pb-4">
                        <i class="fa fa-facebook text-blue-600 text-xl"></i>
                        <h2 class="text-lg font-semibold text-slate-900">Facebook</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="social_facebook" class="block text-sm font-semibold text-slate-700">
                                URL Akun Facebook
                            </label>
                            <p class="mb-2 text-xs text-slate-500">Alamat lengkap profil atau halaman Facebook Anda</p>
                            <input
                                type="url"
                                name="social_facebook"
                                id="social_facebook"
                                value="{{ old('social_facebook', $socialMedia['facebook']) }}"
                                placeholder="https://www.facebook.com/namakamu"
                                class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>
                        <div class="text-xs text-slate-500">
                            <p>Tautan ini akan muncul di footer halaman publik.</p>
                            <p class="mt-1">Contoh: https://www.facebook.com/wadukmanduk</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3 pb-4">
                        <i class="fa fa-instagram text-pink-600 text-xl"></i>
                        <h2 class="text-lg font-semibold text-slate-900">Instagram</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="social_instagram" class="block text-sm font-semibold text-slate-700">
                                URL Akun Instagram
                            </label>
                            <p class="mb-2 text-xs text-slate-500">Alamat lengkap profil Instagram Anda</p>
                            <input
                                type="url"
                                name="social_instagram"
                                id="social_instagram"
                                value="{{ old('social_instagram', $socialMedia['instagram']) }}"
                                placeholder="https://www.instagram.com/namakamu"
                                class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>
                        <div class="text-xs text-slate-500">
                            <p>Tautan ini akan muncul di footer halaman publik.</p>
                            <p class="mt-1">Contoh: https://www.instagram.com/wadukmanduk</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3 pb-4">
                        <i class="fa fa-twitter text-blue-400 text-xl"></i>
                        <h2 class="text-lg font-semibold text-slate-900">Twitter</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="social_twitter" class="block text-sm font-semibold text-slate-700">
                                URL Akun Twitter
                            </label>
                            <p class="mb-2 text-xs text-slate-500">Alamat lengkap profil Twitter Anda</p>
                            <input
                                type="url"
                                name="social_twitter"
                                id="social_twitter"
                                value="{{ old('social_twitter', $socialMedia['twitter']) }}"
                                placeholder="https://www.twitter.com/namakamu"
                                class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>
                        <div class="text-xs text-slate-500">
                            <p>Tautan ini akan muncul di footer halaman publik.</p>
                            <p class="mt-1">Contoh: https://www.twitter.com/wadukmanduk</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3 pb-4">
                        <i class="fa fa-youtube text-red-600 text-xl"></i>
                        <h2 class="text-lg font-semibold text-slate-900">YouTube</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="social_youtube" class="block text-sm font-semibold text-slate-700">
                                URL Channel YouTube
                            </label>
                            <p class="mb-2 text-xs text-slate-500">Alamat lengkap channel YouTube Anda</p>
                            <input
                                type="url"
                                name="social_youtube"
                                id="social_youtube"
                                value="{{ old('social_youtube', $socialMedia['youtube']) }}"
                                placeholder="https://www.youtube.com/namakamu"
                                class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>
                        <div class="text-xs text-slate-500">
                            <p>Tautan ini akan muncul di footer halaman publik.</p>
                            <p class="mt-1">Contoh: https://www.youtube.com/@wadukmanduk</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    class="btn-primary flex items-center gap-2 px-6 py-3"
                >
                    <i class="fa fa-save"></i>
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
@endsection
