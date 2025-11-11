<?php

namespace Database\Seeders;

use App\Models\HomeFeature;
use App\Models\HomeGuide;
use App\Models\HomeOpeningHour;
use App\Models\HomePricingRow;
use App\Models\HomeProcedure;
use App\Models\HomeProject;
use App\Models\HomeSlide;
use App\Models\HomeStat;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('site_settings')->truncate();
        DB::table('home_slides')->truncate();
        DB::table('home_projects')->truncate();
        DB::table('home_features')->truncate();
        DB::table('home_pricing_rows')->truncate();
        DB::table('home_opening_hours')->truncate();
        DB::table('home_stats')->truncate();
        DB::table('home_procedures')->truncate();
        DB::table('home_guides')->truncate();

        SiteSetting::setValue('site.title', "D'Manduk");
        SiteSetting::setValue('site.logo_path', null);
        SiteSetting::setValue('home.about_paragraphs', json_encode([
            'Waduk Manduk dikenal sebagai destinasi wisata air yang bersih dan ramah keluarga. Pengunjung dapat menikmati panorama senja, berperahu santai, hingga mengikuti agenda komunitas yang rutin digelar di amphitheater.',
            'Berbagai wahana edukasi dan kuliner hadir menemani, mulai dari studio kreatif, area playground, hingga sentra UMKM dengan sertifikasi halal. Semua diatur rapi sehingga mudah diakses oleh semua kalangan.',
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        SiteSetting::setValue('home.about_image', 'images/gallery/gallery-6.svg');
        SiteSetting::setValue('home.map_embed_url', 'https://maps.google.com/maps?q=Waduk%20Manduk&t=&z=15&ie=UTF8&iwloc=&output=embed');
        SiteSetting::setValue('home.map_link_label', 'Buka di Google Maps');
        SiteSetting::setValue('home.map_directions_url', 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7');
        SiteSetting::setValue('home.supporting_institutions', json_encode([
            ['title' => 'Puskesmas', 'description' => 'Layanan kesehatan dasar dan penanganan medis cepat.', 'phone' => '+62 812-3456-7890'],
            ['title' => 'Polsek', 'description' => 'Koordinasi keamanan dan penanganan laporan kehilangan.', 'phone' => '+62 812-3456-7891'],
            ['title' => 'BUMDes', 'description' => 'Pengelolaan operasional wisata dan kemitraan UMKM.', 'phone' => '+62 812-3456-7892'],
            ['title' => 'KPW (Komunitas Peduli Waduk)', 'description' => 'Relawan kebersihan dan edukasi lingkungan.', 'phone' => '+62 812-3456-7893'],
            ['title' => 'Pos Keamanan Wisata', 'description' => 'Pusat informasi, patroli area, dan respon darurat.', 'phone' => '+62 812-3456-7894'],
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        
        // Social media settings
        SiteSetting::setValue('social.facebook', 'https://facebook.com/wadukmanduk');
        SiteSetting::setValue('social.instagram', 'https://instagram.com/wadukmanduk');
        SiteSetting::setValue('social.twitter', 'https://twitter.com/wadukmanduk');
        SiteSetting::setValue('social.youtube', 'https://youtube.com/wadukmanduk');

        $slides = [
            [
                'eyebrow' => 'Discover the Colorful World',
                'title' => 'New Adventure',
                'description' => 'Expedisi seru mengelilingi waduk dengan perahu wisata, lengkap dengan panorama sunrise dan udara sejuk.',
                'image_path' => 'images/gallery/1.JPG',
                'cta_label' => 'Jelajahi Sekarang',
                'cta_url' => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
            ],
            [
                'eyebrow' => 'Discover the Colorful World',
                'title' => 'New Trip',
                'description' => 'Rencanakan perjalanan keluarga dengan fasilitas lengkap: kuliner, wahana air, dan ruang bermain anak.',
                'image_path' => 'images/gallery/3.JPG',
                'cta_label' => 'Rencanakan Rute',
                'cta_url' => '/peta',
            ],
            [
                'eyebrow' => 'Discover the Colorful World',
                'title' => 'New Experience',
                'description' => 'Nikmati pengalaman malam dengan lampion night market, live music, dan kuliner khas Manduk.',
                'image_path' => 'images/gallery/6.JPG',
                'cta_label' => 'Lihat Agenda',
                'cta_url' => '/event',
            ],
        ];

        foreach ($slides as $index => $slide) {
            HomeSlide::create($slide + ['sort_order' => $index + 1]);
        }

        $projects = [
            ['title' => 'Festival Kuliner Manduk', 'description' => 'Eksplorasi rasa kuliner lokal di tepi waduk dengan live cooking.', 'image_path' => 'images/gallery/gallery-2.svg'],
            ['title' => 'Manduk Fun Paddle', 'description' => 'Komunitas olahraga air bersatu menjaga kebersihan waduk.', 'image_path' => 'images/gallery/gallery-4.svg'],
            ['title' => 'Lampion Night Market', 'description' => 'Suasana malam yang magis ditemani musik akustik dan bazar UMKM.', 'image_path' => 'images/gallery/gallery-3.svg'],
        ];

        foreach ($projects as $index => $project) {
            HomeProject::create($project + ['sort_order' => $index + 1]);
        }

        $features = [
            ['title' => 'Panorama & Wahana Air', 'description' => 'Perahu wisata, kano, dan paddle board dengan pelampung keselamatan.'],
            ['title' => 'Kuliner & UMKM', 'description' => 'Kopi Manduk, olahan ikan, dan cendera mata khas pesisir.'],
            ['title' => 'Teknisi Berpengalaman', 'description' => 'Tim teknis menjaga setiap wahana dalam kondisi prima.'],
            ['title' => 'Pelayanan Profesional', 'description' => 'Petugas informasi siap membantu itinerary dan rekomendasi aktivitas.'],
            ['title' => 'Highly Recommended', 'description' => 'Pengunjung memberikan nilai tinggi untuk kenyamanan dan kebersihan.'],
            ['title' => 'Positive Reviews', 'description' => 'Review positif dari wisatawan lokal maupun luar kota.'],
        ];

        foreach ($features as $index => $feature) {
            HomeFeature::create($feature + ['sort_order' => $index + 1]);
        }

        $ticketRows = [
            ['category' => 'ticket', 'label' => 'Tiket masuk dewasa', 'price' => 'Rp12.000', 'description' => 'Sudah termasuk akses area publik dan spot foto.'],
            ['category' => 'ticket', 'label' => 'Tiket masuk anak (3-12 tahun)', 'price' => 'Rp8.000', 'description' => 'Gratis untuk balita dengan pendamping.'],
            ['category' => 'ticket', 'label' => 'Paket keluarga (maksimal 5 orang)', 'price' => 'Rp40.000', 'description' => 'Diskon 20% untuk KTP Desa Manduk.'],
            ['category' => 'ticket', 'label' => 'Parkir motor / mobil', 'price' => 'Rp3.000 / Rp5.000', 'description' => 'Area parkir 24 jam dengan CCTV.'],
        ];

        foreach ($ticketRows as $index => $row) {
            HomePricingRow::create($row + ['sort_order' => $index + 1]);
        }

        $facilityRows = [
            ['category' => 'facility', 'label' => 'Perahu wisata (20 menit)', 'price' => 'Rp25.000 / orang', 'description' => 'Pelampung disediakan. Anak di bawah 5 tahun wajib didampingi.'],
            ['category' => 'facility', 'label' => 'Kano dan paddle board', 'price' => 'Rp35.000 / 30 menit', 'description' => 'Syarat usia minimal 10 tahun, wajib menggunakan alat keselamatan.'],
            ['category' => 'facility', 'label' => 'Gazebo pinggir waduk', 'price' => 'Rp25.000 / 3 jam', 'description' => 'Kapasitas hingga 8 orang, dekat outlet kuliner.'],
            ['category' => 'facility', 'label' => 'Amphitheater (3 jam)', 'price' => 'Rp450.000', 'description' => 'Termasuk sound system standar dan 2 petugas lapangan.'],
        ];

        foreach ($facilityRows as $index => $row) {
            HomePricingRow::create($row + ['sort_order' => count($ticketRows) + $index + 1]);
        }

        $openingHours = [
            ['label' => 'Area wisata utama', 'hours' => '07.00 - 21.00 WIB', 'note' => 'Perubahan jadwal diumumkan di media sosial resmi.'],
            ['label' => 'Pusat informasi wisata', 'hours' => '07.00 - 17.00 WIB', 'note' => 'Layanan pemesanan wahana dan pemandu.'],
            ['label' => 'Resto apung dan food court', 'hours' => '07.00 - 22.00 WIB', 'note' => 'Live cooking tersedia Jumat sampai Minggu.'],
            ['label' => 'Amphitheater dan aula serbaguna', 'hours' => '08.00 - 21.00 WIB', 'note' => 'Booking minimal H-3 untuk event.'],
            ['label' => 'Studio podcast dan media center', 'hours' => '09.00 - 17.00 WIB', 'note' => 'Reservasi online segera tersedia.'],
        ];

        foreach ($openingHours as $index => $hour) {
            HomeOpeningHour::create($hour + ['sort_order' => $index + 1]);
        }

        $stats = [
            ['label' => 'Total wisatawan', 'value' => '5.962'],
            ['label' => 'Rata-rata bulanan', 'value' => '2.394'],
            ['label' => 'UMKM aktif', 'value' => '1.439'],
            ['label' => 'Inisiatif sosial', 'value' => '933'],
        ];

        foreach ($stats as $index => $stat) {
            HomeStat::create($stat + ['sort_order' => $index + 1]);
        }

        $procedures = [
            ['title' => 'Alur kedatangan tertib', 'description' => 'Pengunjung wajib melakukan registrasi di loket, menerima gelang identitas, serta mengikuti arahan briefing keselamatan sebelum menuju dermaga.'],
            ['title' => 'Pembayaran digital terintegrasi', 'description' => 'Seluruh transaksi resmi mendukung QRIS Waduk Manduk sehingga proses tiket dan sewa fasilitas lebih cepat dan transparan.'],
            ['title' => 'Penanganan darurat siaga', 'description' => 'Pos keamanan wisata siaga selama jam operasional untuk respon pertama pada insiden medis, cuaca ekstrem, maupun informasi barang hilang.'],
        ];

        foreach ($procedures as $index => $procedure) {
            HomeProcedure::create($procedure + ['sort_order' => $index + 1]);
        }

        $guides = [
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
                    'Gunakan QRIS resmi D\'Manduk untuk pembayaran; laporkan segera bila terjadi kendala.',
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

        foreach ($guides as $index => $guide) {
            HomeGuide::create($guide + ['sort_order' => $index + 1]);
        }
    }
}
