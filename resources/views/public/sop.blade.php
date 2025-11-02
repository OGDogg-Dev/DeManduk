@extends('layouts.app')

@section('content')
    <x-section
        title="Standar Operasional Prosedur D'Manduk"
        subtitle="Dokumen ringkas ini menjadi acuan utama bagi pengunjung, pelaku UMKM, dan petugas dalam menjaga kualitas layanan Waduk Manduk."
    >
        <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-5 text-slate-700">
                <p>
                    SOP D'Manduk disusun untuk memastikan setiap aktivitas wisata berjalan aman, tertib, dan inklusif.
                    Seluruh petugas frontliner, pengelola fasilitas, hingga komunitas relawan menerapkan panduan ini dalam melayani pengunjung.
                </p>
                <p>
                    Dokumen lengkap dapat diunduh melalui desk informasi. Ringkasan di bawah membantu Anda memahami alur utama pelayanan ketika berkunjung.
                </p>
                <x-alert variant="info" title="Catatan pembaruan">
                    SOP diperbarui secara berkala berdasarkan evaluasi kunjungan dan rekomendasi instansi pendukung: Puskesmas, Polsek, BUMDes, KPW, serta Pos Keamanan Wisata.
                </x-alert>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Tujuan utama</h3>
                <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-relaxed text-slate-600">
                    <li>Menjaga keselamatan pengunjung dan pekerja wisata.</li>
                    <li>Memastikan proses tiket, pembayaran, dan penggunaan fasilitas berlangsung transparan.</li>
                    <li>Melindungi kelestarian lingkungan waduk melalui tata kelola kebersihan terpadu.</li>
                    <li>Mendorong koordinasi cepat antar instansi ketika terjadi kondisi darurat.</li>
                </ul>
            </div>
        </div>
    </x-section>

    <x-section
        variant="muted"
        title="Alur pelayanan inti"
        subtitle="Ikuti langkah-langkah berikut agar pengalaman berwisata tetap nyaman dan sesuai prosedur."
    >
        <div class="grid gap-6 lg:grid-cols-2">
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900">1. Pra-kunjungan</h3>
                <ol class="mt-3 space-y-3 text-sm leading-relaxed text-slate-600">
                    <li>Reservasi rombongan minimal tiga hari sebelum kedatangan untuk penjadwalan petugas.</li>
                    <li>Pastikan membawa identitas resmi, surat izin event (jika ada), dan perlengkapan keselamatan pribadi.</li>
                    <li>Tinjau prakiraan cuaca serta pengumuman terbaru dari kanal resmi D'Manduk.</li>
                </ol>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900">2. Kedatangan & tiket</h3>
                <ol class="mt-3 space-y-3 text-sm leading-relaxed text-slate-600">
                    <li>Lakukan registrasi di loket utama, ambil gelang identitas, dan simpan bukti transaksi.</li>
                    <li>Gunakan QRIS resmi D'Manduk untuk pembayaran; laporkan segera bila terjadi kegagalan transaksi.</li>
                    <li>Ikuti briefing keselamatan dari petugas sebelum memasuki dermaga atau wahana air.</li>
                </ol>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900">3. Aktivitas di area wisata</h3>
                <ol class="mt-3 space-y-3 text-sm leading-relaxed text-slate-600">
                    <li>Patuhi kapasitas wahana, jalur pedestrian, dan zona steril yang ditetapkan petugas.</li>
                    <li>Gunakan fasilitas kebersihan: bank sampah, tong organik/anorganik, dan stasiun daur ulang.</li>
                    <li>Laporkan kejadian darurat kepada Pos Keamanan Wisata atau relawan KPW terdekat.</li>
                </ol>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900">4. Penutupan kegiatan</h3>
                <ol class="mt-3 space-y-3 text-sm leading-relaxed text-slate-600">
                    <li>Bersihkan area yang digunakan, kembalikan perlengkapan sewa, dan lakukan pengecekan barang.</li>
                    <li>Serahkan laporan kegiatan/event kepada pengelola atau BUMDes sebagai dokumentasi.</li>
                    <li>Isi formulir evaluasi atau kirim umpan balik melalui kanal kontak resmi untuk perbaikan layanan.</li>
                </ol>
            </article>
        </div>
    </x-section>

    <x-section title="Koordinasi instansi pendukung">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h4 class="text-sm font-semibold text-slate-900">Puskesmas</h4>
                <p class="mt-2 text-sm text-slate-600">Menangani layanan medis pertama dan rujukan kesehatan bagi pengunjung maupun petugas.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h4 class="text-sm font-semibold text-slate-900">Polsek</h4>
                <p class="mt-2 text-sm text-slate-600">Berkolaborasi menjaga keamanan area, penanganan laporan kehilangan, dan rekayasa lalu lintas.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h4 class="text-sm font-semibold text-slate-900">BUMDes</h4>
                <p class="mt-2 text-sm text-slate-600">Mengelola operasional resmi, kemitraan UMKM, serta sinkronisasi jadwal event desa.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h4 class="text-sm font-semibold text-slate-900">KPW (Komunitas Peduli Waduk)</h4>
                <p class="mt-2 text-sm text-slate-600">Menggerakkan relawan kebersihan dan edukasi lingkungan bagi pengunjung dan UMKM.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h4 class="text-sm font-semibold text-slate-900">Pos Keamanan Wisata</h4>
                <p class="mt-2 text-sm text-slate-600">Menjadi pusat komando lapangan untuk penanganan darurat, lost and found, dan informasi umum.</p>
            </div>
        </div>
        <x-alert variant="success" title="Hubungi kami">
            Untuk klarifikasi lebih lanjut, gunakan halaman <a href="{{ route('kontak') }}" class="font-semibold text-blue-600">Kontak</a> atau koordinasikan langsung dengan instansi terkait sesuai kebutuhan Anda.
        </x-alert>
    </x-section>
@endsection
