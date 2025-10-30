@extends('layouts.app')

@section('content')
    <x-section
        title="Manduk Lakeside Festival"
        subtitle="Festival kuliner malam dengan pertunjukan musik akustik, instalasi lampion, dan peluncuran fasilitas dermaga baru."
    >
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr]">
            <div class="space-y-6">
                <x-badge variant="info">Sabtu, 23 November 2025 | 16.00 - 21.00 WIB</x-badge>
                <p class="text-base leading-relaxed text-slate-600">
                    Manduk Lakeside Festival adalah selebrasi tahunan yang menyatukan kuliner, musik, dan seni komunitas. Tahun ini
                    kami menghadirkan 40 UMKM pilihan, demo masak chef lokal, serta panggung akustik dengan latar pencahayaan dermaga baru.
                </p>
                <h3 class="text-xl font-semibold text-slate-900">Rundown acara</h3>
                <ul class="space-y-4 text-sm text-slate-600">
                    <li><strong>16.00</strong> - Pembukaan gerbang, registrasi peserta, dan sambutan Kepala Desa.</li>
                    <li><strong>17.00</strong> - Demo masak dan sesi pairing kopi Manduk bersama barista komunitas.</li>
                    <li><strong>18.30</strong> - Penampilan musik akustik dan atraksi lampion terapung.</li>
                    <li><strong>20.30</strong> - Pengumuman UMKM favorit dan doorprize merchandise resmi.</li>
                </ul>
                <x-alert variant="warning" title="Informasi tiket khusus">
                    Event ini gratis untuk pengunjung harian. Area kursi VIP tersedia terbatas dengan kontribusi Rp50.000 per orang.
                </x-alert>
            </div>
            <aside class="space-y-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900">Ringkasan acara</h3>
                <dl class="space-y-3 text-sm text-slate-600">
                    <div>
                        <dt class="font-semibold text-slate-800">Lokasi</dt>
                        <dd>Amphitheater dan dermaga utama Waduk Manduk</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-slate-800">Dress code</dt>
                        <dd>Kasual nyaman, dianjurkan membawa jaket ringan.</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-slate-800">Fasilitas</dt>
                        <dd>Area parkir luas, mushola, ruang laktasi, dan toilet bersih.</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-slate-800">Kontak PIC</dt>
                        <dd>WhatsApp 0812-3456-7890 (Rina | Event Officer)</dd>
                    </div>
                </dl>
                <a
                    href="{{ route('event.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    <- Kembali ke daftar event
                </a>
            </aside>
        </div>
    </x-section>
@endsection
