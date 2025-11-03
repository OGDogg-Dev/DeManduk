@extends('layouts.app')

@section('content')
    <x-section
        title="Kontak dan form masukan"
        :subtitle="$subtitle ?? 'Sampaikan pertanyaan, saran, atau kebutuhan kerja sama Anda. Tim kami akan merespons maksimal dalam dua hari kerja.'"
    >
        <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <form class="space-y-4 rounded-3xl border border-white/15 bg-[#031838]/80 p-8 shadow-[0_30px_70px_-30px_rgba(3,24,56,0.8)] backdrop-blur" novalidate>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="contact-name" class="text-sm font-semibold text-slate-200">Nama lengkap</label>
                        <input
                            id="contact-name"
                            name="name"
                            type="text"
                            required
                            placeholder="Nama Anda"
                            class="mt-2 w-full rounded-xl border border-white/15 bg-[#041f45] px-4 py-3 text-sm text-slate-100 placeholder:text-slate-400 focus:border-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
                        >
                    </div>
                    <div>
                        <label for="contact-email" class="text-sm font-semibold text-slate-200">Email</label>
                        <input
                            id="contact-email"
                            name="email"
                            type="email"
                            required
                            placeholder="nama@domain.com"
                            class="mt-2 w-full rounded-xl border border-white/15 bg-[#041f45] px-4 py-3 text-sm text-slate-100 placeholder:text-slate-400 focus:border-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
                        >
                    </div>
                </div>
                <div>
                    <label for="contact-topic" class="text-sm font-semibold text-slate-200">Topik</label>
                    <select
                        id="contact-topic"
                        name="topic"
                        class="mt-2 w-full rounded-xl border border-white/15 bg-[#041f45] px-4 py-3 text-sm text-slate-100 focus:border-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
                    >
                        <option>Informasi umum</option>
                        <option>Kerja sama event</option>
                        <option>Keluhan atau pengaduan</option>
                        <option>Kemitraan UMKM</option>
                    </select>
                </div>
                <div>
                    <label for="contact-message" class="text-sm font-semibold text-slate-200">Pesan</label>
                    <textarea
                        id="contact-message"
                        name="message"
                        rows="5"
                        class="mt-2 w-full rounded-xl border border-white/15 bg-[#041f45] px-4 py-3 text-sm text-slate-100 placeholder:text-slate-400 focus:border-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
                        placeholder="Tuliskan pesan Anda di sini."
                    ></textarea>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label for="contact-phone" class="text-sm font-semibold text-slate-200">Nomor WhatsApp</label>
                        <input
                            id="contact-phone"
                            name="phone"
                            type="tel"
                            placeholder="+62 812 3456 7890"
                            class="w-full rounded-xl border border-white/15 bg-[#041f45] px-4 py-3 text-sm text-slate-100 placeholder:text-slate-400 focus:border-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
                        >
                    </div>
                    <div class="space-y-2">
                        <label for="contact-date" class="text-sm font-semibold text-slate-200">Tanggal kunjungan (opsional)</label>
                        <input
                            id="contact-date"
                            name="visit_date"
                            type="date"
                            class="w-full rounded-xl border border-white/15 bg-[#041f45] px-4 py-3 text-sm text-slate-100 focus:border-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
                        >
                    </div>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <p class="text-xs text-slate-400">
                        Data Anda hanya digunakan untuk menanggapi permintaan ini dan tidak dibagikan ke pihak ketiga.
                    </p>
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-full bg-amber-400 px-6 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-[#021024] transition hover:bg-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-200 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
                    >
                        Kirim pesan
                    </button>
                </div>
            </form>
            <div class="space-y-6 rounded-3xl border border-white/15 bg-[#041734]/80 p-8 shadow-[0_30px_70px_-30px_rgba(3,24,56,0.8)] backdrop-blur">
                <h3 class="text-base font-semibold text-white">Jaringan layanan D'Manduk</h3>
                <div class="space-y-4 text-sm text-slate-200">
                    <div>
                        <h4 class="font-semibold text-white">Alamat Operasional</h4>
                        <p>{{ $address ?? '-' }}</p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="font-semibold text-white">Kontak Darurat</h4>
                        <ul class="list-disc space-y-1 pl-5">
                            @forelse ($supports as $support)
                                <li>
                                    <span class="font-semibold text-white">{{ $support->title }}:</span>
                                    {{ $support->description }}
                                </li>
                            @empty
                                <li>Informasi instansi akan diperbarui segera.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-semibold text-white">Telepon & Email</h4>
                        <p>
                            Telepon:
                            @if ($phone)
                                <a href="tel:{{ $phone }}" class="font-semibold text-amber-300">{{ $phone }}</a>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </p>
                        <p>
                            Email:
                            @if ($email)
                                <a href="mailto:{{ $email }}" class="font-semibold text-amber-300">{{ $email }}</a>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </p>
                    </div>
                </div>
                @forelse ($alerts as $alert)
                    <x-alert :variant="$alert->variant" :title="$alert->title">
                        {{ $alert->body }}
                    </x-alert>
                @empty
                    <x-alert variant="info" title="Informasi akan diperbarui">
                        Tim kami sedang menyiapkan pembaruan pesan penting untuk pengunjung.
                    </x-alert>
                @endforelse
            </div>
        </div>
    </x-section>
@endsection
