@extends('layouts.app')

@section('content')
    <x-section
        title="Kontak dan form masukan"
        subtitle="Sampaikan pertanyaan, saran, atau kebutuhan kerja sama Anda. Tim kami akan merespons maksimal dalam dua hari kerja."
    >
        <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <form class="space-y-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm" novalidate>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="contact-name" class="text-sm font-semibold text-slate-700">Nama lengkap</label>
                        <input
                            id="contact-name"
                            name="name"
                            type="text"
                            required
                            placeholder="Nama Anda"
                            class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        >
                    </div>
                    <div>
                        <label for="contact-email" class="text-sm font-semibold text-slate-700">Email</label>
                        <input
                            id="contact-email"
                            name="email"
                            type="email"
                            required
                            placeholder="nama@domain.com"
                            class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        >
                    </div>
                </div>
                <div>
                    <label for="contact-topic" class="text-sm font-semibold text-slate-700">Topik</label>
                    <select
                        id="contact-topic"
                        name="topic"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    >
                        <option>Informasi umum</option>
                        <option>Kerja sama event</option>
                        <option>Keluhan atau pengaduan</option>
                        <option>Kemitraan UMKM</option>
                    </select>
                </div>
                <div>
                    <label for="contact-message" class="text-sm font-semibold text-slate-700">Pesan</label>
                    <textarea
                        id="contact-message"
                        name="message"
                        rows="5"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        placeholder="Tuliskan pesan Anda di sini."
                    ></textarea>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label for="contact-phone" class="text-sm font-semibold text-slate-700">Nomor WhatsApp</label>
                        <input
                            id="contact-phone"
                            name="phone"
                            type="tel"
                            placeholder="+62 812 3456 7890"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        >
                    </div>
                    <div class="space-y-2">
                        <label for="contact-date" class="text-sm font-semibold text-slate-700">Tanggal kunjungan (opsional)</label>
                        <input
                            id="contact-date"
                            name="visit_date"
                            type="date"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        >
                    </div>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <p class="text-xs text-slate-500">
                        Data Anda hanya digunakan untuk menanggapi permintaan ini dan tidak dibagikan ke pihak ketiga.
                    </p>
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    >
                        Kirim pesan
                    </button>
                </div>
            </form>
            <div class="space-y-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900">Informasi kontak resmi</h3>
                <dl class="space-y-3 text-sm text-slate-600">
                    <div>
                        <dt class="font-semibold text-slate-800">Alamat</dt>
                        <dd>Balai Pengelola Waduk Manduk, Desa Manduk, Kecamatan Duduk Sampeyan, Kabupaten Gresik.</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-slate-800">Telepon</dt>
                        <dd><a href="tel:+62312999999" class="text-blue-600 hover:underline">+62 312 999 999</a></dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-slate-800">Email</dt>
                        <dd><a href="mailto:halo@wadukmanduk.id" class="text-blue-600 hover:underline">halo@wadukmanduk.id</a></dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-slate-800">Jam layanan</dt>
                        <dd>Senin sampai Jumat, 08.00 - 16.00 WIB</dd>
                    </div>
                </dl>
                <x-alert variant="warning" title="Kebijakan respon">
                    Tanggapan resmi akan dikirim melalui email. Mohon hindari menyertakan informasi sensitif pada form.
                </x-alert>
                <x-alert variant="success" title="Butuh respon cepat?">
                    Hubungi WhatsApp Center 0812-9999-0000 pada jam operasional untuk bantuan langsung.
                </x-alert>
            </div>
        </div>
    </x-section>
@endsection
