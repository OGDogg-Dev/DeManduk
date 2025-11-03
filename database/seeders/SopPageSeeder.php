<?php

namespace Database\Seeders;

use App\Models\SopObjective;
use App\Models\SopPartner;
use App\Models\SopStep;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SopPageSeeder extends Seeder
{
    public function run(): void
    {
        SopStep::query()->delete();
        SopObjective::query()->delete();
        SopPartner::query()->delete();

        SiteSetting::setValue(
            'sop.subtitle',
            'Dokumen ringkas ini menjadi acuan utama bagi pengunjung, pelaku UMKM, dan petugas dalam menjaga kualitas layanan Waduk Manduk.'
        );
        SiteSetting::setValue('sop.intro_paragraphs', json_encode([
            'SOP D\'Manduk disusun untuk memastikan setiap aktivitas wisata berjalan aman, tertib, dan inklusif. Seluruh petugas frontliner, pengelola fasilitas, hingga komunitas relawan menerapkan panduan ini dalam melayani pengunjung.',
            'Dokumen lengkap dapat diunduh melalui desk informasi. Ringkasan di bawah membantu Anda memahami alur utama pelayanan ketika berkunjung.',
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        SiteSetting::setValue('sop.info_alert_variant', 'info');
        SiteSetting::setValue('sop.info_alert_title', 'Catatan pembaruan');
        SiteSetting::setValue(
            'sop.info_alert_body',
            'SOP diperbarui secara berkala berdasarkan evaluasi kunjungan dan rekomendasi instansi pendukung: Puskesmas, Polsek, BUMDes, KPW, serta Pos Keamanan Wisata.'
        );
        SiteSetting::setValue('sop.bottom_alert_variant', 'success');
        SiteSetting::setValue('sop.bottom_alert_title', 'Hubungi kami');
        SiteSetting::setValue(
            'sop.bottom_alert_body',
            'Untuk klarifikasi lebih lanjut, gunakan halaman Kontak atau koordinasikan langsung dengan instansi terkait sesuai kebutuhan Anda.'
        );

        $objectives = [
            'Menjaga keselamatan pengunjung dan pekerja wisata.',
            'Memastikan proses tiket, pembayaran, dan penggunaan fasilitas berlangsung transparan.',
            'Melindungi kelestarian lingkungan waduk melalui tata kelola kebersihan terpadu.',
            'Mendorong koordinasi cepat antar instansi ketika terjadi kondisi darurat.',
        ];

        foreach ($objectives as $index => $objective) {
            SopObjective::create([
                'content' => $objective,
                'sort_order' => $index + 1,
            ]);
        }

        $steps = [
            [
                'title' => 'Pra-kunjungan',
                'items' => [
                    'Reservasi rombongan minimal tiga hari sebelum kedatangan untuk penjadwalan petugas.',
                    'Pastikan membawa identitas resmi, surat izin event (jika ada), dan perlengkapan keselamatan pribadi.',
                    'Tinjau prakiraan cuaca serta pengumuman terbaru dari kanal resmi D\'Manduk.',
                ],
            ],
            [
                'title' => 'Kedatangan & tiket',
                'items' => [
                    'Lakukan registrasi di loket utama, ambil gelang identitas, dan simpan bukti transaksi.',
                    'Gunakan QRIS resmi D\'Manduk untuk pembayaran; laporkan segera bila terjadi kegagalan transaksi.',
                    'Ikuti briefing keselamatan dari petugas sebelum memasuki dermaga atau wahana air.',
                ],
            ],
            [
                'title' => 'Aktivitas di area wisata',
                'items' => [
                    'Patuhi kapasitas wahana, jalur pedestrian, dan zona steril yang ditetapkan petugas.',
                    'Gunakan fasilitas kebersihan: bank sampah, tong organik/anorganik, dan stasiun daur ulang.',
                    'Laporkan kejadian darurat kepada Pos Keamanan Wisata atau relawan KPW terdekat.',
                ],
            ],
            [
                'title' => 'Penutupan kegiatan',
                'items' => [
                    'Bersihkan area yang digunakan, kembalikan perlengkapan sewa, dan lakukan pengecekan barang.',
                    'Serahkan laporan kegiatan/event kepada pengelola atau BUMDes sebagai dokumentasi.',
                    'Isi formulir evaluasi atau kirim umpan balik melalui kanal kontak resmi untuk perbaikan layanan.',
                ],
            ],
        ];

        foreach ($steps as $index => $step) {
            SopStep::create([
                'title' => $step['title'],
                'items' => $step['items'],
                'sort_order' => $index + 1,
            ]);
        }

        $partners = [
            ['title' => 'Puskesmas', 'description' => 'Menangani layanan medis pertama dan rujukan kesehatan bagi pengunjung maupun petugas.', 'sort_order' => 1],
            ['title' => 'Polsek', 'description' => 'Berkolaborasi menjaga keamanan area, penanganan laporan kehilangan, dan rekayasa lalu lintas.', 'sort_order' => 2],
            ['title' => 'BUMDes', 'description' => 'Mengelola operasional resmi, kemitraan UMKM, serta sinkronisasi jadwal event desa.', 'sort_order' => 3],
            ['title' => 'KPW (Komunitas Peduli Waduk)', 'description' => 'Menggerakkan relawan kebersihan dan edukasi lingkungan bagi pengunjung dan UMKM.', 'sort_order' => 4],
            ['title' => 'Pos Keamanan Wisata', 'description' => 'Menjadi pusat komando lapangan untuk penanganan darurat, lost and found, dan informasi umum.', 'sort_order' => 5],
        ];

        foreach ($partners as $partner) {
            SopPartner::create($partner);
        }
    }
}

