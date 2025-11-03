<?php

namespace Database\Seeders;

use App\Models\ContactAlert;
use App\Models\ContactSupport;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        ContactSupport::query()->delete();
        ContactAlert::query()->delete();

        SiteSetting::setValue('contact.subtitle', 'Sampaikan pertanyaan, saran, atau kebutuhan kerja sama Anda. Tim kami akan merespons maksimal dalam dua hari kerja.');
        SiteSetting::setValue('contact.address', 'Dusun Manduk RT. 4 / RW. 5, Desa Jatirejo, Ngargoyoso, Karanganyar.');
        SiteSetting::setValue('contact.phone', '+62 312 999 999');
        SiteSetting::setValue('contact.email', 'halo@wadukmanduk.id');

        $supports = [
            ['title' => 'Puskesmas', 'description' => 'Layanan kesehatan dasar dan penanganan medis cepat.', 'sort_order' => 1],
            ['title' => 'Polsek', 'description' => 'Koordinasi keamanan dan laporan kehilangan.', 'sort_order' => 2],
            ['title' => 'BUMDes', 'description' => 'Pengelolaan operasional serta koordinasi UMKM.', 'sort_order' => 3],
            ['title' => 'KPW (Komunitas Peduli Waduk)', 'description' => 'Relawan kebersihan dan edukasi lingkungan.', 'sort_order' => 4],
            ['title' => 'Pos Keamanan Wisata', 'description' => 'Pusat informasi, patroli area, dan respon darurat.', 'sort_order' => 5],
        ];

        foreach ($supports as $support) {
            ContactSupport::create($support);
        }

        $alerts = [
            [
                'variant' => 'warning',
                'title' => 'Kanal komunikasi prioritas',
                'body' => 'Sampaikan kebutuhan spesifik Anda lewat form di samping atau langsung melalui instansi terkait sesuai keperluan.',
                'sort_order' => 1,
            ],
            [
                'variant' => 'success',
                'title' => 'Layanan cepat',
                'body' => 'Untuk kondisi darurat, hubungi Pos Keamanan Wisata di lokasi atau petugas Puskesmas terdekat.',
                'sort_order' => 2,
            ],
        ];

        foreach ($alerts as $alert) {
            ContactAlert::create($alert);
        }
    }
}

