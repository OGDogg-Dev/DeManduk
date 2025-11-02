@extends('layouts.app')

@section('content')
    <x-section
        title="Sejarah dan transformasi Waduk Manduk"
        subtitle="Dari sumber irigasi desa menjadi destinasi wisata terpadu dengan pengelolaan profesional dan partisipasi aktif warga."
    >
        <div class="space-y-5 text-slate-700">
            <p>
                Waduk Manduk dibangun pada era 1980-an sebagai penyangga irigasi untuk lahan pertanian di Desa Manduk. Dalam
                dua dekade terakhir, kawasan ini menjadi ruang sosial warga: tempat memancing, berolahraga, dan menyelenggarakan
                tradisi sedekah bumi.
            </p>
            <p>
                Tahun 2022, pemerintah desa bersama komunitas lokal memulai program revitalisasi. Dermaga diperkuat, jalur pedestrian
                ramah difabel dibangun, dan area UMKM diatur ulang agar nyaman bagi pengunjung. Langkah tersebut menjadikan Waduk Manduk
                ikon wisata air baru di Kabupaten Gresik.
            </p>
            <p>
                Visi kami adalah menghadirkan waduk yang lestari, nyaman, dan memberikan manfaat ekonomi bagi warga. Setiap program wisata
                disusun bersama pokdarwis, karang taruna, hingga pelaku UMKM agar pertumbuhan berjalan inklusif.
            </p>
        </div>
    </x-section>

    <x-section
        title="Nilai inti pengelolaan"
        subtitle="Kami menerapkan prinsip berkelanjutan dan pelayanan prima untuk semua pengunjung."
    >
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <x-card title="Keamanan dan ketertiban">
                <x-slot:icon>KK</x-slot:icon>
                <p class="text-sm leading-relaxed text-slate-600">
                    Petugas berjaga selama jam buka, dilengkapi CCTV dan pos informasi. Aturan keselamatan air diterapkan secara ketat.
                </p>
            </x-card>
            <x-card title="Kebersihan terjaga">
                <x-slot:icon>KB</x-slot:icon>
                <p class="text-sm leading-relaxed text-slate-600">
                    Program bank sampah dan jadwal bersih waduk rutin memastikan lingkungan tetap nyaman.
                </p>
            </x-card>
            <x-card title="Pelibatan komunitas">
                <x-slot:icon>PK</x-slot:icon>
                <p class="text-sm leading-relaxed text-slate-600">
                    Agenda wisata disusun bersama komunitas seni, olahraga, dan UMKM agar manfaat ekonomi merata.
                </p>
            </x-card>
        </div>
    </x-section>

    <x-section
        variant="muted"
        title="Struktur pengelolaan"
        subtitle="Pengelolaan dilakukan secara kolaboratif oleh pemerintah desa dan badan usaha milik desa."
    >
        <div class="grid gap-6 md:grid-cols-2">
            <x-card title="Badan Pengelola Waduk Manduk">
                <x-slot:icon>BP</x-slot:icon>
                <ul class="list-disc space-y-2 pl-5 text-sm text-slate-600">
                    <li>Kepala: Kepala Desa Manduk</li>
                    <li>Direktur operasional: BUMDes Manduk Sejahtera</li>
                    <li>Bidang pelayanan: Pokdarwis Tirta Manduk</li>
                    <li>Bidang keamanan dan kebersihan: Satgas gabungan</li>
                </ul>
            </x-card>
            <x-card title="Skema kemitraan">
                <x-slot:icon>SK</x-slot:icon>
                <ul class="list-disc space-y-2 pl-5 text-sm text-slate-600">
                    <li>UMKM kuliner: kemitraan bagi hasil 80% - 20%</li>
                    <li>Event organizer: seleksi kurasi bertema wisata air</li>
                    <li>Pegiat seni: program residensi dan panggung mingguan</li>
                </ul>
            </x-card>
        </div>
    </x-section>

    <x-section title="Rencana pengembangan 2025 - 2027">
        @php
            $developmentRows = [
                ['Konservasi', 'Penanaman 1.000 pohon peneduh dan penataan taman riparian.', "<x-badge variant='success'>Mulai 2025</x-badge>"],
                ['Digitalisasi', 'Integrasi tiket online dengan sistem tamu dan loyalty visitor.', "<x-badge variant='info'>Perancangan</x-badge>"],
                ['Ekonomi lokal', 'Inkubasi UMKM olahan ikan dan souvenir ramah lingkungan.', "<x-badge variant='warning'>Onboarding</x-badge>"],
            ];
        @endphp
        <x-table
            :headers="['Fokus', 'Program', 'Status']"
            :rows="$developmentRows"
        />
    </x-section>
@endsection
