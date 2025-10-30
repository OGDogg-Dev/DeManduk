@extends('layouts.app')

@section('content')
    <x-section
        title="Harga tiket dan fasilitas Waduk Manduk"
        subtitle="Semua tarif mengikuti Perdes No. 04/2024 dan dapat berubah sesuai kebijakan pengelola. Pembayaran tunai dan QRIS tersedia di seluruh loket."
    >
        @php
            $ticketRows = [
                ['Tiket masuk dewasa', 'Rp12.000', 'Sudah termasuk akses area publik dan spot foto.'],
                ['Tiket masuk anak (3-12 tahun)', 'Rp8.000', 'Gratis untuk balita dengan pendamping.'],
                ['Paket keluarga (maksimal 5 orang)', 'Rp40.000', 'Diskon 20% untuk KTP Desa Manduk.'],
                ['Parkir motor / mobil', 'Rp3.000 / Rp5.000', 'Area parkir 24 jam dengan CCTV.'],
            ];

            $facilityRows = [
                ['Perahu wisata (20 menit)', 'Rp25.000 / orang', 'Pelampung disediakan. Anak di bawah 5 tahun wajib didampingi.'],
                ['Kano dan paddle board', 'Rp35.000 / 30 menit', 'Syarat utama: bisa berenang dan gunakan rompi keselamatan.'],
                ['Sewa gazebo keluarga', 'Rp50.000 / 2 jam', 'Termasuk colokan listrik dan layanan kebersihan.'],
                ['Amphitheater mini', 'Rp250.000 / 4 jam', 'Untuk komunitas, event sekolah, prewedding. Booking minimal H-7.'],
                ['Studio podcast UMKM', 'Rp75.000 / jam', 'Termasuk operator dasar dan koneksi internet 20 Mbps.'],
            ];
        @endphp
        <x-table
            :headers="['Jenis', 'Tarif', 'Keterangan']"
            :rows="$ticketRows"
            caption="Daftar tarif tiket dan layanan dasar."
        />
        <x-table
            :headers="['Fasilitas', 'Tarif', 'Detail layanan']"
            :rows="$facilityRows"
            caption="Tarif fasilitas tambahan dan penyewaan ruang."
        />
        <x-alert variant="info" title="Pemesanan rombongan">
            Rombongan 30 orang ke atas dapat menghubungi <a href="mailto:event@wadukmanduk.id" class="font-semibold text-blue-600">event@wadukmanduk.id</a>
            untuk mendapatkan jadwal khusus, pemandu wisata, serta paket konsumsi.
        </x-alert>
    </x-section>

    <x-section
        variant="muted"
        title="Fasilitas pendukung"
        subtitle="Kami terus meningkatkan kualitas layanan agar pengunjung merasa aman dan nyaman sepanjang kunjungan."
    >
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <x-card title="Toilet dan ruang bilas">
                <x-slot:icon>TB</x-slot:icon>
                <p class="text-sm text-slate-600">Tersedia enam blok toilet bersih dengan petugas kebersihan terjadwal dan akses kursi roda.</p>
            </x-card>
            <x-card title="Ruang laktasi dan klinik">
                <x-slot:icon>RK</x-slot:icon>
                <p class="text-sm text-slate-600">Ruang laktasi nyaman, klinik kecil dengan petugas medis siaga, serta mitra ambulans.</p>
            </x-card>
            <x-card title="Mushola dan area ibadah">
                <x-slot:icon>MI</x-slot:icon>
                <p class="text-sm text-slate-600">Mushola terapung dengan sajadah bersih dan informasi jadwal salat otomatis.</p>
            </x-card>
            <x-card title="Wi-Fi publik dan charging">
                <x-slot:icon>WF</x-slot:icon>
                <p class="text-sm text-slate-600">Akses internet gratis dua jam per perangkat dan titik pengisian daya di sudut kuliner.</p>
            </x-card>
            <x-card title="Loker penyimpanan">
                <x-slot:icon>LK</x-slot:icon>
                <p class="text-sm text-slate-600">Loker digital untuk menyimpan barang berharga selama bermain wahana air.</p>
            </x-card>
            <x-card title="Penjagaan 24 jam">
                <x-slot:icon>PJ</x-slot:icon>
                <p class="text-sm text-slate-600">Satgas keamanan bersinergi dengan kepolisian setempat dan sistem tombol darurat.</p>
            </x-card>
        </div>
    </x-section>

    <x-section title="Ketentuan umum pengunjung">
        <div class="grid gap-6 md:grid-cols-2">
            <x-card title="Protokol keselamatan">
                <x-slot:icon>KS</x-slot:icon>
                <ul class="list-disc space-y-2 pl-5 text-sm text-slate-600">
                    <li>Gunakan rompi pelampung saat naik perahu atau kano.</li>
                    <li>Dilarang berenang di luar area yang diawasi petugas.</li>
                    <li>Ikuti arahan evakuasi saat sirine peringatan berbunyi.</li>
                </ul>
            </x-card>
            <x-card title="Etika dan kenyamanan">
                <x-slot:icon>EK</x-slot:icon>
                <ul class="list-disc space-y-2 pl-5 text-sm text-slate-600">
                    <li>Jaga kebersihan, gunakan tempat sampah terpilah organik dan anorganik.</li>
                    <li>Dilarang membawa hewan peliharaan kecuali hewan pendamping bersertifikat.</li>
                    <li>Merokok hanya diperbolehkan di zona yang bertanda khusus.</li>
                </ul>
            </x-card>
        </div>
    </x-section>
@endsection
