@extends('layouts.app')

@section('content')
    <x-section
        title="Jam operasional Waduk Manduk"
        subtitle="Rencanakan kunjungan Anda sesuai jadwal terbaru. Informasi ini akan diperbarui secara berkala."
    >
        @php
            $openingRows = [
                ['Senin', '06.00 - 17.00 WIB', 'Jalur jogging dan taman dibuka lebih awal mulai pukul 05.30.'],
                ['Selasa', '06.00 - 17.00 WIB', 'Perawatan dermaga dilakukan setelah jam 17.30.'],
                ['Rabu', '06.00 - 17.00 WIB', 'Diskon 10% untuk pengunjung rombongan pelajar.'],
                ['Kamis', '06.00 - 17.00 WIB', 'Sesi senam pagi komunitas pukul 07.00.'],
                ['Jumat', '06.00 - 17.30 WIB', 'Istirahat salat Jumat pukul 11.00 - 13.00 (wahana ditutup sementara).'],
                ['Sabtu', '05.30 - 18.30 WIB', 'Live music sore dan lampion night market mulai pukul 16.30.'],
                ['Minggu', '05.30 - 18.30 WIB', 'Puncak kunjungan, parkir tambahan disiapkan di sisi timur.'],
            ];
        @endphp
        <x-table
            :headers="['Hari', 'Jam buka', 'Catatan']"
            :rows="$openingRows"
        />
        <x-alert variant="warning" title="Penyesuaian musiman">
            Saat debit air meningkat di musim hujan, jam operasional dapat dipersingkat. Pantau pengumuman melalui media sosial resmi kami.
        </x-alert>
    </x-section>

    <x-section
        variant="muted"
        title="Jam layanan khusus"
        subtitle="Beberapa fasilitas memiliki jam operasional berbeda. Pastikan menyesuaikan jadwal sebelum berkunjung."
    >
        @php
            $serviceRows = [
                ['Pusat informasi wisata', '07.00 - 17.00 WIB', 'Layanan pemesanan wahana dan pemandu.'],
                ['Resto apung dan food court', '07.00 - 22.00 WIB', 'Live cooking tersedia Jumat sampai Minggu.'],
                ['Amphitheater dan aula serbaguna', '08.00 - 21.00 WIB', 'Booking minimal H-3 untuk event.'],
                ['Studio podcast dan media center', '09.00 - 17.00 WIB', 'Reservasi online segera tersedia.'],
            ];
        @endphp
        <x-table
            :headers="['Fasilitas', 'Jam layanan', 'Keterangan']"
            :rows="$serviceRows"
        />
    </x-section>

    <x-section
        title="Rekomendasi waktu kunjungan"
        subtitle="Pilih waktu terbaik sesuai aktivitas favorit Anda."
    >
        <div class="grid gap-6 md:grid-cols-3">
            <x-card title="Pagi (05.30 - 09.00)">
                <x-slot:icon>PG</x-slot:icon>
                <p class="text-sm text-slate-200">Nikmati sunrise, olahraga ringan, dan suasana sejuk dengan antrean minim.</p>
            </x-card>
            <x-card title="Siang (11.00 - 15.00)">
                <x-slot:icon>SG</x-slot:icon>
                <p class="text-sm text-slate-200">Waktu terbaik untuk kuliner dan aktivitas edukasi di studio kreatif indoor.</p>
            </x-card>
            <x-card title="Sore - malam (15.00 - 18.30)">
                <x-slot:icon>SM</x-slot:icon>
                <p class="text-sm text-slate-200">Cocok untuk jelajah wahana air dan menikmati lampion night market di akhir pekan.</p>
            </x-card>
        </div>
    </x-section>
@endsection
