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
            ['title' => 'Puskesmas', 'description' => 'Layanan kesehatan dasar dan penanganan medis cepat.', 'phone' => '+62 812-3456-7890', 'sort_order' => 1],
            ['title' => 'Polsek', 'description' => 'Koordinasi keamanan dan laporan kehilangan.', 'phone' => '+62 812-3456-7891', 'sort_order' => 2],
            ['title' => 'BUMDes', 'description' => 'Pengelolaan operasional serta koordinasi UMKM.', 'phone' => '+62 812-3456-7892', 'sort_order' => 3],
            ['title' => 'KPW (Komunitas Peduli Waduk)', 'description' => 'Relawan kebersihan dan edukasi lingkungan.', 'phone' => '+62 812-3456-7893', 'sort_order' => 4],
            ['title' => 'Pos Keamanan Wisata', 'description' => 'Pusat informasi, patroli area, dan respon darurat.', 'phone' => '+62 812-3456-7894', 'sort_order' => 5],
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
        
        // Social media settings (if not already set)
        \App\Models\SiteSetting::setValue('social.facebook', \App\Models\SiteSetting::getValue('social.facebook', 'https://facebook.com/wadukmanduk'));
        \App\Models\SiteSetting::setValue('social.instagram', \App\Models\SiteSetting::getValue('social.instagram', 'https://instagram.com/wadukmanduk'));
        \App\Models\SiteSetting::setValue('social.twitter', \App\Models\SiteSetting::getValue('social.twitter', 'https://twitter.com/wadukmanduk'));
        \App\Models\SiteSetting::setValue('social.youtube', \App\Models\SiteSetting::getValue('social.youtube', 'https://youtube.com/wadukmanduk'));
    }
}

