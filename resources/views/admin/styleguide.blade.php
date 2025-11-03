@extends('layouts.admin', ['title' => 'Styleguide'])

@section('content')
    <div class="space-y-10">
        <header class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-semibold text-slate-900">Styleguide UI</h1>
            <p class="text-sm text-slate-500">Referensi cepat untuk warna, tombol, kartu, dan pola form yang digunakan di area admin.</p>
        </header>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Palet Warna</h2>
            <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $swatches = [
                        ['label' => 'Indigo 600', 'class' => 'bg-indigo-600', 'code' => '#4f46e5'],
                        ['label' => 'Blue 500', 'class' => 'bg-blue-500', 'code' => '#3b82f6'],
                        ['label' => 'Slate 900', 'class' => 'bg-slate-900', 'code' => '#0f172a'],
                        ['label' => 'Slate 50', 'class' => 'bg-slate-100 text-slate-900', 'code' => '#f1f5f9'],
                    ];
                @endphp
                @foreach ($swatches as $swatch)
                    <div class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 shadow-sm">
                        <span class="h-16 w-full rounded-xl {{ $swatch['class'] }}"></span>
                        <span class="text-sm font-semibold text-slate-900">{{ $swatch['label'] }}</span>
                        <span class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ $swatch['code'] }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Tombol</h2>
            <div class="mt-5 flex flex-wrap items-center gap-4">
                <button type="button" class="btn-primary">Primary</button>
                <button type="button" class="btn-secondary">Secondary</button>
                <button type="button" class="btn-danger">Destructive</button>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Form Kontrol</h2>
            <form class="space-y-6">
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-widest text-slate-500">Judul konten</label>
                        <input type="text" placeholder="Masukkan judul..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-widest text-slate-500">Status</label>
                        <select class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option>Tayang</option>
                            <option>Draf</option>
                            <option>Perlu review</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-semibold uppercase tracking-widest text-slate-500">Deskripsi</label>
                    <textarea rows="4" placeholder="Tulis deskripsi singkat..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" class="btn-primary">Simpan</button>
                    <button type="button" class="btn-secondary">Batal</button>
                </div>
            </form>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Kartu & Tabel</h2>
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <p class="text-sm text-slate-500">Kartu standar dapat menggunakan kombinasi kelas <code class="text-indigo-500">rounded-2xl border bg-white shadow-sm</code>.</p>
                    <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 p-5 shadow-sm">
                        <h3 class="text-base font-semibold text-slate-900">Contoh Kartu</h3>
                        <p class="mt-2 text-sm text-slate-600">Gunakan untuk ringkasan data, highlight metrik, atau panel informasi singkat.</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Untuk tabel gunakan pembungkus <code class="text-indigo-500">rounded-2xl border overflow-hidden</code>.</p>
                    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">
                                <tr>
                                    <th class="px-4 py-3">Kolom</th>
                                    <th class="px-4 py-3">Contoh</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white text-slate-600">
                                <tr>
                                    <td class="px-4 py-3 font-medium text-slate-900">Judul</td>
                                    <td class="px-4 py-3">Landing Page</td>
                                    <td class="px-4 py-3"><span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">TAYANG</span></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-slate-900">Footer</td>
                                    <td class="px-4 py-3">Update alamat</td>
                                    <td class="px-4 py-3"><span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">REVIEW</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
