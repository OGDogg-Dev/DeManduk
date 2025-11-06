@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;

    // Zona waktu & hari ini (ID)
    $now = Carbon::now('Asia/Jakarta');
    $dayOfWeek = $now->dayOfWeek; // 0=Min, 1=Sen, ... 6=Sab
    $idDayMap = [1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jumat',6=>'Sabtu',0=>'Minggu'];
    $todayName = $idDayMap[$dayOfWeek];

    // Jadwal operasional (display & machine)
    $schedule = [
        ['label'=>'Senin',  'opens'=>'06:00', 'closes'=>'17:00', 'note'=>'Jalur jogging dan taman dibuka lebih awal mulai pukul 05.30.'],
        ['label'=>'Selasa', 'opens'=>'06:00', 'closes'=>'17:00', 'note'=>'Perawatan dermaga dilakukan setelah jam 17.30.'],
        ['label'=>'Rabu',   'opens'=>'06:00', 'closes'=>'17:00', 'note'=>'Diskon 10% untuk pengunjung rombongan pelajar.'],
        ['label'=>'Kamis',  'opens'=>'06:00', 'closes'=>'17:00', 'note'=>'Sesi senam pagi komunitas pukul 07.00.'],
        // Catatan: ada jeda siang di Jumat (wahana tutup sementara). Tetap dibuka total 06:00–17:30.
        ['label'=>'Jumat',  'opens'=>'06:00', 'closes'=>'17:30', 'note'=>'Istirahat salat Jumat 11.00–13.00 (wahana ditutup sementara).'],
        ['label'=>'Sabtu',  'opens'=>'05:30', 'closes'=>'18:30', 'note'=>'Live music sore & lampion night market mulai pukul 16.30.'],
        ['label'=>'Minggu', 'opens'=>'05:30', 'closes'=>'18:30', 'note'=>'Puncak kunjungan, parkir tambahan disiapkan di sisi timur.'],
    ];

    // Helper format tampilan jam: 06:00 -> 06.00 WIB
    $fmtDisp = fn(string $hhmm) => str_replace(':', '.', $hhmm) . ' WIB';

    // Tentukan "Hari ini" & status buka/tutup
    $openingRows = [];
    foreach ($schedule as $row) {
        $isToday = ($row['label'] === $todayName);
        $nowStr  = $now->format('H:i');
        $openNow = ($nowStr >= $row['opens'] && $nowStr <= $row['closes']);

        $hariCell = e($row['label']);
        if ($isToday) {
            $hariCell .= ' <span class="ml-2 rounded-full bg-[var(--color-primary)]/15 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-[var(--color-primary)]">Hari ini</span>';
        }

        $jamCell = e($fmtDisp($row['opens']).' - '.$fmtDisp($row['closes']));
        if ($isToday) {
            $jamCell .= $openNow
                ? ' <span class="ml-2 rounded-full bg-emerald-400/15 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-[var(--color-success-600)]">Sedang buka</span>'
                : ' <span class="ml-2 rounded-full bg-rose-400/15 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-[var(--color-primary)]">Tutup</span>';
        }

        $openingRows[] = [$hariCell, $jamCell, e($row['note'])];
    }

    $updatedCaption = 'Diperbarui ' . $now->locale('id')->translatedFormat('j M Y');
@endphp

    <x-section
        id="hours"
        title="Jam operasional Waduk Manduk"
        subtitle="Rencanakan kunjungan Anda sesuai jadwal terbaru. Informasi ini akan diperbarui secara berkala."
    >
        <div class="overflow-x-auto">
            <x-table
                :headers="['Hari', 'Jam buka', 'Catatan']"
                :rows="$openingRows"
                :caption="'Ringkasan jam operasional — ' . $updatedCaption"
            />
        </div>

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
                ['Resto apung & food court', '07.00 - 22.00 WIB', 'Live cooking tersedia Jumat s.d. Minggu.'],
                ['Amphitheater & aula serbaguna', '08.00 - 21.00 WIB', 'Booking minimal H-3 untuk event.'],
                ['Studio podcast & media center', '09.00 - 17.00 WIB', 'Reservasi online segera tersedia.'],
            ];
        @endphp
        <div class="overflow-x-auto">
            <x-table
                :headers="['Fasilitas', 'Jam layanan', 'Keterangan']"
                :rows="$serviceRows"
            />
        </div>
    </x-section>

    <x-section
        title="Rekomendasi waktu kunjungan"
        subtitle="Pilih waktu terbaik sesuai aktivitas favorit Anda."
    >
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-3">
            <x-card title="Pagi (05.30 - 09.00)">
                <x-slot:icon>PG</x-slot:icon>
                <p class="text-sm text-[var(--color-muted)]">Nikmati sunrise, olahraga ringan, dan suasana sejuk dengan antrean minim.</p>
            </x-card>
            <x-card title="Siang (11.00 - 15.00)">
                <x-slot:icon>SG</x-slot:icon>
                <p class="text-sm text-[var(--color-muted)]">Waktu terbaik untuk kuliner dan aktivitas edukasi di studio kreatif indoor.</p>
            </x-card>
            <x-card title="Sore - malam (15.00 - 18.30)">
                <x-slot:icon>SM</x-slot:icon>
                <p class="text-sm text-[var(--color-muted)]">Cocok untuk jelajah wahana air dan menikmati lampion night market di akhir pekan.</p>
            </x-card>
        </div>
    </x-section>
@endsection
