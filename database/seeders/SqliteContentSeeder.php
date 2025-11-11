<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SqliteContentSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $data = [
        'users' => [
            [
                'id' => 1,
                'name' => 'Administrator D\'Manduk',
                'email' => 'admin@dmanduk.test',
                'email_verified_at' => '2025-11-04 16:29:22',
                'password' => '$2y$12$M07NBRyHByIavrMt4HTFTuPEpys6zogAMOx6GbjOXhFJPEAhs8rma',
                'remember_token' => null,
                'created_at' => '2025-11-04 16:17:42',
                'updated_at' => '2025-11-04 16:29:22',
                'role' => 'admin',
                'requires_approval' => 0
            ],
            [
                'id' => 2,
                'name' => 'Koordinator Kontributor',
                'email' => 'kontributor@dmanduk.test',
                'email_verified_at' => '2025-11-04 16:29:22',
                'password' => '$2y$12$tmiknFHCkB4DdsqO/3KwgOPUZuFDMPN3OlIKtET.BQKio806NSgnW',
                'remember_token' => null,
                'created_at' => '2025-11-04 16:17:42',
                'updated_at' => '2025-11-04 16:29:23',
                'role' => 'contributor',
                'requires_approval' => 0
            ],
            [
                'id' => 3,
                'name' => 'Relawan KPW',
                'email' => 'kpw@dmanduk.test',
                'email_verified_at' => '2025-11-04 16:29:23',
                'password' => '$2y$12$nyptXgVuSxuvjTOEx8Gh5ek6ZRvMZUsVV/k0tN9UCAh.IYpfhiaBS',
                'remember_token' => null,
                'created_at' => '2025-11-04 16:17:43',
                'updated_at' => '2025-11-04 16:29:23',
                'role' => 'kpw',
                'requires_approval' => 1
            ],
        ],
        'site_settings' => [
            [
                'id' => 1,
                'key' => 'site.title',
                'value' => 'D\'Manduk',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 2,
                'key' => 'site.logo_path',
                'value' => null,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 3,
                'key' => 'site.favicon_path',
                'value' => null,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 4,
                'key' => 'home.about_paragraphs',
                'value' => '["Waduk Manduk adalah bagian dari rencana pengembangan","Waduk Gondang di Kabupaten Karanganyar, Jawa Tengah, yang bertujuan memperluas genangan air waduk tersebut. Waduk ini dikelola sebagai objek wisata dengan pengembangan yang memanfaatkan teknologi digital, serta melibatkan Badan Usaha Milik Desa (BUMDes) dan Komunitas Peduli Waduk (KPW) untuk menata pengelolaan wisata dan memperkuat kapasitas masyarakat lokal"]',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-05 10:41:47'
            ],
            [
                'id' => 5,
                'key' => 'home.about_image',
                'value' => 'home/about/P3TcaJkTAKM73QQ5fNfomj2pNNfv1bEGv79K4gzK.jpg',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-05 10:41:47'
            ],
            [
                'id' => 6,
                'key' => 'home.map_embed_url',
                'value' => 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3064.1120274156183!2d111.07821437500283!3d-7.572589692441629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMzQnMjEuMyJTIDExMcKwMDQnNTAuOCJF!5e1!3m2!1sen!2sid!4v1762339264892!5m2!1sen!2sid',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-05 10:41:47'
            ],
            [
                'id' => 7,
                'key' => 'home.map_link_label',
                'value' => 'Buka di Google Maps',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 8,
                'key' => 'home.map_directions_url',
                'value' => 'https://maps.app.goo.gl/6ArzHxFbjvQGsNAX7',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-05 10:41:47'
            ],
            [
                'id' => 9,
                'key' => 'home.supporting_institutions',
                'value' => '[{"title":"Puskesmas","description":"Layanan kesehatan dasar dan penanganan medis cepat.","phone":"+62 812-3456-7890"},{"title":"Polsek","description":"Koordinasi keamanan dan penanganan laporan kehilangan.","phone":"+62 812-3456-7891"},{"title":"BUMDes","description":"Pengelolaan operasional wisata dan kemitraan UMKM.","phone":"+62 812-3456-7892"},{"title":"KPW (Komunitas Peduli Waduk)","description":"Relawan kebersihan dan edukasi lingkungan.","phone":"+62 812-3456-7893"},{"title":"Pos Keamanan Wisata","description":"Pusat informasi, patroli area, dan respon darurat.","phone":"+62 812-3456-7894"}]',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 10,
                'key' => 'social.facebook',
                'value' => 'https://facebook.com/wadukmanduk',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 11,
                'key' => 'social.instagram',
                'value' => 'https://instagram.com/wadukmanduk',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 12,
                'key' => 'social.twitter',
                'value' => 'https://twitter.com/wadukmanduk',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 13,
                'key' => 'social.youtube',
                'value' => 'https://youtube.com/wadukmanduk',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 14,
                'key' => 'contact.subtitle',
                'value' => 'Sampaikan pertanyaan, saran, atau kebutuhan kerja sama Anda. Tim kami akan merespons maksimal dalam dua hari kerja.',
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
            [
                'id' => 15,
                'key' => 'contact.address',
                'value' => 'Dusun Manduk RT. 4 / RW. 5, Desa Jatirejo, Ngargoyoso, Karanganyar.',
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
            [
                'id' => 16,
                'key' => 'contact.phone',
                'value' => '+62 312 999 999',
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
            [
                'id' => 17,
                'key' => 'contact.email',
                'value' => 'halo@dmanduk.id',
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 19:43:02'
            ],
            [
                'id' => 18,
                'key' => 'seo.meta_title',
                'value' => 'Waduk - JDIH Kemenko Maritim & Investasi',
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
            [
                'id' => 19,
                'key' => 'seo.meta_description',
                'value' => 'Waduk adalah wadah buatan yang terbentuk sebagai akibat dibangunnya bendungan. Referensi resmi: Peraturan Presiden Nomor 64 Tahun 2022.',
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
            [
                'id' => 20,
                'key' => 'seo.reference_label',
                'value' => 'Kemenko Bidang Kemaritiman dan Investasi',
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
            [
                'id' => 21,
                'key' => 'seo.reference_url',
                'value' => 'https://jdih.maritim.go.id/waduk',
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
            [
                'id' => 22,
                'key' => 'seo.reference_snippet',
                'value' => 'Waduk. Waduk adalah wadah buatan yang terbentuk sebagai akibat dibangunnya bendungan. Referensi. Peraturan Presiden Nomor 64 Tahun 2022 ...',
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
        ],
        'home_slides' => [
            [
                'id' => 1,
                'eyebrow' => 'Discover the Colorful World',
                'title' => 'New Adventure',
                'description' => 'Expedisi seru mengelilingi waduk dengan perahu wisata, lengkap dengan panorama sunrise dan udara sejuk.',
                'image_path' => 'images/gallery/1.JPG',
                'cta_label' => 'Jelajahi Sekarang',
                'cta_url' => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 2,
                'eyebrow' => 'Discover the Colorful World',
                'title' => 'New Trip',
                'description' => 'Rencanakan perjalanan keluarga dengan fasilitas lengkap: kuliner, wahana air, dan ruang bermain anak.',
                'image_path' => 'images/gallery/3.JPG',
                'cta_label' => 'Rencanakan Rute',
                'cta_url' => '/peta',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 3,
                'eyebrow' => 'Discover the Colorful World',
                'title' => 'New Experience',
                'description' => 'Nikmati pengalaman malam dengan lampion night market, live music, dan kuliner khas Manduk.',
                'image_path' => 'images/gallery/6.JPG',
                'cta_label' => 'Lihat Agenda',
                'cta_url' => '/event',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
        ],
        'home_projects' => [
            [
                'id' => 1,
                'title' => 'Festival Durian Manduk',
                'description' => 'Cara paling lezat untuk merayakan desa: bertemu, berbagi cerita, dan pulang membawa kenangan manis… juga sedikit “aroma rindu” di ujung duri.',
                'image_path' => 'images/gallery/gallery-2.svg',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 19:51:42'
            ],
            [
                'id' => 2,
                'title' => 'Lomba Kreasi Anak',
                'description' => 'Kreatifitas dan cinta alam di Waduk Manduk tempat bermain, belajar, dan berbangga pada desa sendiri.',
                'image_path' => 'images/gallery/gallery-4.svg',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 19:52:22'
            ],
        ],
        'home_features' => [
            [
                'id' => 1,
                'title' => 'Panorama & Wahana Air',
                'description' => 'Bebek Gowes dengan pelampung keselamatan.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-05 10:35:13'
            ],
            [
                'id' => 2,
                'title' => 'Kuliner & UMKM',
                'description' => 'Sego Wader, dan Olahan Ikan Lainnya',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-05 10:35:52'
            ],
            [
                'id' => 3,
                'title' => 'Teknisi Berpengalaman',
                'description' => 'Tim teknis menjaga setiap wahana dalam kondisi prima.',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 4,
                'title' => 'Pelayanan Profesional',
                'description' => 'Petugas informasi siap membantu itinerary dan rekomendasi aktivitas.',
                'sort_order' => 4,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 5,
                'title' => 'Highly Recommended',
                'description' => 'Pengunjung memberikan nilai tinggi untuk kenyamanan dan kebersihan.',
                'sort_order' => 5,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 6,
                'title' => 'Positive Reviews',
                'description' => 'Review positif dari wisatawan lokal maupun luar kota.',
                'sort_order' => 6,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
        ],
        'home_pricing_rows' => [
            [
                'id' => 1,
                'category' => 'ticket',
                'label' => 'Tiket masuk dewasa',
                'price' => 'Rp10.000',
                'description' => 'Sudah termasuk akses area publik dan spot foto.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-05 10:43:05'
            ],
            [
                'id' => 2,
                'category' => 'ticket',
                'label' => 'Tiket masuk anak (3-12 tahun)',
                'price' => 'Rp8.000',
                'description' => 'Gratis untuk balita dengan pendamping.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 4,
                'category' => 'ticket',
                'label' => 'Parkir motor / mobil',
                'price' => 'Rp2.000 / Rp5.000',
                'description' => 'Area parkir 24 jam dengan Pengawas',
                'sort_order' => 4,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-05 10:43:38'
            ],
            [
                'id' => 5,
                'category' => 'facility',
                'label' => 'Perahu wisata (20 menit)',
                'price' => 'Rp25.000 / orang',
                'description' => 'Pelampung disediakan. Anak di bawah 5 tahun wajib didampingi.',
                'sort_order' => 5,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
        ],
        'home_opening_hours' => [
            [
                'id' => 1,
                'label' => 'Area wisata utama',
                'hours' => '07.00 - 21.00 WIB',
                'note' => 'Perubahan jadwal diumumkan di media sosial resmi.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 2,
                'label' => 'Pusat informasi wisata',
                'hours' => '07.00 - 17.00 WIB',
                'note' => 'Layanan pemesanan wahana dan pemandu.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 5,
                'label' => 'Studio podcast dan media center',
                'hours' => '09.00 - 17.00 WIB',
                'note' => 'Reservasi online segera tersedia.',
                'sort_order' => 5,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
        ],
        'home_stats' => [
            [
                'id' => 1,
                'label' => 'Total wisatawan',
                'value' => '5.962',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 2,
                'label' => 'Rata-rata bulanan',
                'value' => '2.394',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
        ],
        'home_procedures' => [
            [
                'id' => 1,
                'title' => 'Alur kedatangan tertib',
                'description' => 'Pengunjung wajib melakukan registrasi di loket, menerima gelang identitas, serta mengikuti arahan briefing keselamatan sebelum menuju dermaga.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 2,
                'title' => 'Pembayaran digital terintegrasi',
                'description' => 'Seluruh transaksi resmi mendukung QRIS Waduk Manduk sehingga proses tiket dan sewa fasilitas lebih cepat dan transparan.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 3,
                'title' => 'Penanganan darurat siaga',
                'description' => 'Pos keamanan wisata siaga selama jam operasional untuk respon pertama pada insiden medis, cuaca ekstrem, maupun informasi barang hilang.',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
        ],
        'home_guides' => [
            [
                'id' => 1,
                'title' => 'Pra-kunjungan',
                'items' => '["Reservasi rombongan minimal tiga hari sebelum kedatangan untuk penjadwalan petugas.","Pastikan membawa identitas resmi, surat izin event (jika ada), dan perlengkapan keselamatan pribadi.","Tinjau prakiraan cuaca serta pengumuman terbaru dari kanal resmi D\'Manduk."]',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 2,
                'title' => 'Kedatangan & tiket',
                'items' => '["Lakukan registrasi di loket utama, ambil gelang identitas, dan simpan bukti transaksi.","Gunakan QRIS resmi D\'Manduk untuk pembayaran; laporkan segera bila terjadi kendala.","Ikuti briefing keselamatan dari petugas sebelum memasuki dermaga atau wahana air."]',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 3,
                'title' => 'Aktivitas di area wisata',
                'items' => '["Patuhi kapasitas wahana, jalur pedestrian, dan zona steril yang ditetapkan petugas.","Gunakan fasilitas kebersihan: bank sampah, tong organik\\/anorganik, dan stasiun daur ulang.","Laporkan kejadian darurat kepada Pos Keamanan Wisata atau relawan KPW terdekat."]',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 4,
                'title' => 'Penutupan kegiatan',
                'items' => '["Bersihkan area yang digunakan, kembalikan perlengkapan sewa, dan lakukan pengecekan barang.","Serahkan laporan kegiatan\\/event kepada pengelola atau BUMDes sebagai dokumentasi.","Isi formulir evaluasi atau kirim umpan balik melalui kanal kontak resmi untuk perbaikan layanan."]',
                'sort_order' => 4,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
        ],
        'contact_supports' => [
            [
                'id' => 16,
                'title' => 'Puskesmas',
                'description' => 'Layanan kesehatan dasar dan penanganan medis cepat.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27',
                'phone' => '+62 812-3456-7890'
            ],
            [
                'id' => 17,
                'title' => 'Polisi / Damkar',
                'description' => 'Koordinasi keamanan dan laporan kehilangan.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 19:40:30',
                'phone' => '+62 812-3456-7891'
            ],
            [
                'id' => 18,
                'title' => 'BUMDes',
                'description' => 'Pengelolaan operasional serta koordinasi UMKM.',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27',
                'phone' => '+62 812-3456-7892'
            ],
            [
                'id' => 19,
                'title' => 'Komunitas Peduli Waduk',
                'description' => 'Relawan kebersihan dan edukasi lingkungan.',
                'sort_order' => 4,
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 19:41:12',
                'phone' => '+62 812-3456-7893'
            ],
            [
                'id' => 20,
                'title' => 'Pos Keamanan Wisata',
                'description' => 'Pusat informasi, patroli area, dan respon darurat.',
                'sort_order' => 5,
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27',
                'phone' => '+62 812-3456-7894'
            ],
        ],
        'contact_alerts' => [
            [
                'id' => 7,
                'variant' => 'warning',
                'title' => 'Kanal komunikasi prioritas',
                'body' => 'Sampaikan kebutuhan spesifik Anda lewat form di samping atau langsung melalui instansi terkait sesuai keperluan.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
            [
                'id' => 8,
                'variant' => 'success',
                'title' => 'Layanan cepat',
                'body' => 'Untuk kondisi darurat, hubungi Pos Keamanan Wisata di lokasi atau petugas Puskesmas terdekat.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:34:27',
                'updated_at' => '2025-11-04 16:34:27'
            ],
        ],
        'gallery_items' => [
            [
                'id' => 7,
                'title' => 'Panorama Senja Waduk Manduk',
                'caption' => 'Langit jingga memantul di permukaan waduk, favorit pengunjung untuk menikmati sore hari.',
                'image_path' => 'images/gallery/gallery-1.svg',
                'status' => 'published',
                'sort_order' => 1,
                'published_at' => '2025-11-04 16:29:23',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 8,
                'title' => 'Dermaga Perahu Wisata',
                'caption' => 'Dermaga kayu dengan perahu wisata siap membawa rombongan berkeliling.',
                'image_path' => 'images/gallery/gallery-2.svg',
                'status' => 'published',
                'sort_order' => 2,
                'published_at' => '2025-11-04 16:29:23',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 9,
                'title' => 'Lampion Night Market',
                'caption' => 'Suasana pasar malam tematik dengan dekorasi lampion mendampingi UMKM lokal.',
                'image_path' => 'images/gallery/gallery-3.svg',
                'status' => 'published',
                'sort_order' => 3,
                'published_at' => '2025-11-04 16:29:23',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 10,
                'title' => 'Fun Paddle Komunitas',
                'caption' => 'Komunitas kano dan paddle board menjalani latihan rutin sekaligus pembersihan waduk.',
                'image_path' => 'images/gallery/gallery-4.svg',
                'status' => 'published',
                'sort_order' => 4,
                'published_at' => '2025-11-04 16:29:23',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 11,
                'title' => 'Sentra Kuliner Manduk',
                'caption' => 'Deretan kios kuliner halal yang menyajikan menu khas desa Jatirejo.',
                'image_path' => 'images/gallery/gallery-5.svg',
                'status' => 'published',
                'sort_order' => 5,
                'published_at' => '2025-11-04 16:29:23',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 12,
                'title' => 'Sky Deck Manduk',
                'caption' => 'Pengunjung menikmati panorama 360 derajat dari sky deck utama.',
                'image_path' => 'images/gallery/gallery-6.svg',
                'status' => 'published',
                'sort_order' => 6,
                'published_at' => '2025-11-04 16:29:23',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
        ],
        'events' => [
            [
                'id' => 1,
                'title' => 'Manduk Lakeside Festival',
                'slug' => 'manduk-lakeside-festival',
                'category' => 'Festival',
                'event_date' => '2025-11-23 00:00:00',
                'start_time' => '16:00:00',
                'end_time' => '21:00:00',
                'location' => 'Amphitheater Waduk Manduk',
                'cover_image' => null,
                'excerpt' => 'Festival kuliner malam, pertunjukan musik akustik, dan pertunjukan seni tradisional.',
                'body' => 'Manduk Lakeside Festival adalah selebrasi tahunan yang menyatukan kuliner, musik, dan seni komunitas.
Nikmati demo masak chef lokal, panggung akustik, serta parade lampion terapung di dermaga baru.',
                'published_at' => '2025-11-04 16:29:24',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 2,
                'title' => 'Fun Paddle dan Clean Up',
                'slug' => 'fun-paddle-dan-clean-up',
                'category' => 'Komunitas',
                'event_date' => '2025-11-30 00:00:00',
                'start_time' => '07:00:00',
                'end_time' => '10:00:00',
                'location' => 'Dermaga Utama',
                'cover_image' => null,
                'excerpt' => 'Aksi bersih waduk bersama komunitas pecinta alam dan sesi fun paddle bersama pelatih.',
                'body' => 'Gabung dalam aksi bersih waduk sekaligus menikmati fun paddle.
Peserta akan mendapatkan briefing keselamatan, perlengkapan dasar, serta sertifikat partisipasi.',
                'published_at' => '2025-11-04 16:29:24',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 3,
                'title' => 'Lomba Kreasi Anak',
                'slug' => 'lomba-kreasi-anak',
                'category' => 'Lomba',
                'event_date' => '2025-12-14 00:00:00',
                'start_time' => '18:30:00',
                'end_time' => '21:00:00',
                'location' => 'Tepi Waduk Manduk',
                'cover_image' => null,
                'excerpt' => 'Perlombaan untuk anak anak',
                'body' => 'Di tepian Waduk Manduk yang sejuk dan hijau, imajinasi anak-anak akan bermekaran! Kami mengundang adik-adik untuk ikut Lomba Kreasi Anak panggung berekspresi lewat gambar, mewarna, kolase bahan alam, hingga kreasi daur ulang bertema “Alamku, Wadukku”.

Di sini, setiap coretan bercerita tentang air yang dijaga, pepohonan yang dirawat, dan kampung yang dibanggakan. Orang tua dapat mendampingi sambil menikmati panorama waduk, angin yang lembut, dan suasana keluarga yang hangat.



Acara dirancang ramah anak dan ramah lingkungan: peserta diajak membawa alat masing-masing, panitia menyiapkan kertas dan beberapa bahan alam yang aman. Penilaian menitikberatkan pada ide orisinal, pesan lingkungan, keterampilan/kerapian, serta keberanian bercerita singkat tentang karyanya. Pemenang akan mendapat trofi, paket edukasi seni & lingkungan, serta voucher wahana perahu untuk keluarga.',
                'published_at' => '2025-11-04 16:29:24',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 19:48:12'
            ],
            [
                'id' => 4,
                'title' => 'Festival Durian Manduk',
                'slug' => 'festival-durian-manduk',
                'category' => 'Festival',
                'event_date' => '2025-09-08 00:00:00',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'location' => 'Waduk Manduk',
                'cover_image' => null,
                'excerpt' => 'Festival panen raya di dusun manduk tepatnya di waduk manduk',
                'body' => 'Di lereng Ngargoyoso yang sejuk, Festival Durian Manduk hadir sebagai pesta rasa dan kebanggaan warga. Sejak pagi, jalan menuju Waduk Manduk riuh oleh tawa keluarga, pedagang UMKM, dan petani yang menenteng durian terbaik dari kebun. Begitu kulit berduri itu “dibuka”, aroma manis legit langsung menyapa mengundang siapa pun untuk mencicip dan merayakan musim panen.



Festival ini bukan sekadar makan durian bersama. Ada Kontes Raja Durian (menilai rasa, ketebalan daging, aroma, kematangan), Lelang & Cicip Bareng durian juara, Kelas Budidaya bersama petani, Tur Kebun untuk mengenal varietas lokal, hingga Demo Kuliner Durian—dari lempok, pancake, es krim, sampai kopi durian. Di panggung, seniman lokal menyajikan karawitan, campursari, dan akustik sore; sementara Zona Keluarga menghadirkan permainan anak, photobooth, dan lomba makan durian seru namun aman.



Semua dirancang ramah lingkungan: area makan terpisah, tempat cuci tangan, pemilahan sampah organik-anorganik, gelas pakai ulang, dan dukungan bank sampah setempat. Fasilitas umum parkir, mushola, toilet disiapkan di sekitar area waduk agar pengunjung nyaman berlama-lama menikmati panorama danau dan bukit.',
                'published_at' => '2025-11-04 16:29:24',
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-05 12:13:07'
            ],
        ],
        'news_posts' => [
            [
                'id' => 4,
                'title' => 'OPTIMALISASI PENGELOLAAN DAN DIGITALISASI OBYEK WISATA WADUK MANDUK JATIREJO SEBAGAI DESTINASI EKOWISATA BERKELANJUTAN BERBASIS PEMBERDAYAAN MASYARAKAT',
                'slug' => 'digitalisasi-obyek-wisata',
                'author' => 'Team PKM PMM',
                'category' => 'Pengembangan',
                'excerpt' => 'Program Pengabdian kepada Masyarakat skema Pemberdayaan Masyarakat oleh Mahasiswa (PKM–PMM) 2025 dilaksanakan oleh Politeknik Indonusa Surakarta di Waduk Manduk, Desa Jatirejo, Kecamatan Ngargoyoso, Kabupaten Karanganyar.',
                'body' => 'Kegiatan ini didukung oleh Direktorat Penelitian dan Pengabdian kepada Masyarakat, Direktorat Jenderal Riset dan Pengembangan, Kementerian Pendidikan Tinggi, Sains, dan Teknologi, dengan total dana sebesar Rp63.401.000.



Program berlangsung selama dua bulan, 1 Oktober hingga 30 November 2025, dengan ketua pelaksana Edy Susena, M.Kom., serta anggota Markus Utomo Sukendar, M.I.Kom. dan Tominanto, S.Kom., M.Sc. Kegiatan ini melibatkan mahasiswa gabungan dari dua program studi, yaitu Teknologi Rekayasa Perangkat Lunak (TRPL) dan Produksi Media (PM).



Kegiatan ini mengusung tema “Optimalisasi Pengelolaan dan Digitalisasi Obyek Wisata Waduk Manduk Jatirejo sebagai Destinasi Ekowisata Berkelanjutan Berbasis Pemberdayaan Masyarakat.”



Fokus utama kegiatan adalah memberdayakan BUMDes Jatirejo dan Komunitas Peduli Waduk (KPW) melalui penataan dan peningkatan kapasitas pengelolaan wisata dan penerapan teknologi digital. Kegiatan mencakup pelatihan manajemen destinasi wisata, workshop manajemen keuangan digital, FGD perencanaan infrastruktur wisata, serta pelatihan branding dan pemasaran digital wisata.



Dalam implementasinya, mahasiswa bersama dosen pendamping dan masyarakat melakukan berbagai kegiatan fisik dan pengembangan teknologi. Beberapa inovasi yang diterapkan antara lain: 

- Digitalisasi profil waduk Obyek Wisata Waduk Manduk Jatirejo Berbasis Website, 

- Branding Image Obyek Wisata Waduk Manduk Jatirejo, Rambu wisata Obyek Wisata Waduk Manduk Jatirejo, 

- Tempat sampah modern Obyek Wisata Waduk Manduk Jatirejo, 

- Pembuatan viewpoint bench multi fungsi di Obyek Wisata Waduk Manduk Jatirejo, 

- Fasilitas umum Obyek Wisata Waduk Manduk Jatirejo (Meja kursi taman dari Teraso), 

- Pembuatan pagar pengaman waduk dengan kanal C, 

- Peningkatan wahana bermain anak dengan menambahkan ayunan besi, 

- Peningkatan area loket dengan paving, Peningkatan dermaga (Wahana Bebek Gowes), 

- Peningkatan area parkir.



Melalui kegiatan ini, tim PKM–PMM berhasil menggabungkan aspek teknologi, manajemen, produksi, dan pemasaran digital dalam satu rangkaian pemberdayaan masyarakat. Seluruh kegiatan dilaksanakan secara partisipatif dengan melibatkan BUMDes, KPW, dan warga desa, sehingga hasilnya dapat langsung dirasakan oleh masyarakat.



Program ini menjadi bukti nyata kontribusi Politeknik Indonusa Surakarta dalam mendukung pembangunan desa berbasis potensi lokal dan teknologi tepat guna menuju ekowisata berkelanjutan dan mandiri.',
                'cover_image' => 'news/dQ5YAwswL5OXz5V3VdoFrnQKDgbxJbmmQLg2pVeR.jpg',
                'read_time_minutes' => 1,
                'tags' => '["Fasilitas","Infrastruktur","Revitalisasi","Digitalisasi"]',
                'published_at' => '2025-10-25 16:29:23',
                'created_by' => null,
                'updated_by' => 1,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-05 10:33:42'
            ],
        ],
        'qris_steps' => [
            [
                'id' => 5,
                'title' => 'Siapkan aplikasi pembayaran',
                'description' => 'Buka aplikasi mobile banking atau e-wallet favorit yang mendukung QRIS.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 6,
                'title' => 'Scan QR',
                'description' => 'Arahkan kamera ke poster QRIS Waduk Manduk. Pastikan nama merchant sesuai.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 7,
                'title' => 'Masukkan nominal',
                'description' => 'Tiket, wahana, dan produk UMKM memiliki nominal yang diinformasikan kasir.',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 8,
                'title' => 'Tunjukkan bukti bayar',
                'description' => 'Tunjukkan bukti pembayaran kepada petugas untuk validasi dan pencatatan.',
                'sort_order' => 4,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
        ],
        'qris_notes' => [
            [
                'id' => 4,
                'content' => 'Transaksi QRIS diproses langsung di lokasi. Situs ini tidak menerima pembayaran online.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 5,
                'content' => 'Simpan bukti transaksi digital Anda untuk keperluan refund atau audit.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 6,
                'content' => 'Batas nominal mengikuti kebijakan aplikasi pembayaran masing-masing.',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
        ],
        'qris_faqs' => [
            [
                'id' => 3,
                'icon' => '?',
                'title' => 'Kenapa transaksi gagal?',
                'body' => 'Pastikan jaringan internet stabil dan saldo mencukupi. Jika nominal terdebet namun transaksi gagal, hubungi petugas dan kirim bukti bayar ke pembayaran@wadukmanduk.id.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 4,
                'icon' => 'DC',
                'title' => 'Bisakah bayar dengan kartu debit?',
                'body' => 'Layanan EDC sedang dalam pengembangan. Gunakan QRIS atau pembayaran tunai di loket.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
        ],
        'sop_steps' => [
            [
                'id' => 5,
                'title' => 'Pra-kunjungan',
                'items' => '["Reservasi rombongan minimal tiga hari sebelum kedatangan untuk penjadwalan petugas.","Pastikan membawa identitas resmi, surat izin event (jika ada), dan perlengkapan keselamatan pribadi.","Tinjau prakiraan cuaca serta pengumuman terbaru dari kanal resmi D\'Manduk."]',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 6,
                'title' => 'Kedatangan & tiket',
                'items' => '["Lakukan registrasi di loket utama, ambil gelang identitas, dan simpan bukti transaksi.","Gunakan QRIS resmi D\'Manduk untuk pembayaran; laporkan segera bila terjadi kegagalan transaksi.","Ikuti briefing keselamatan dari petugas sebelum memasuki dermaga atau wahana air."]',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 7,
                'title' => 'Aktivitas di area wisata',
                'items' => '["Patuhi kapasitas wahana, jalur pedestrian, dan zona steril yang ditetapkan petugas.","Gunakan fasilitas kebersihan: bank sampah, tong organik\\/anorganik, dan stasiun daur ulang.","Laporkan kejadian darurat kepada Pos Keamanan Wisata atau relawan KPW terdekat."]',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 8,
                'title' => 'Penutupan kegiatan',
                'items' => '["Bersihkan area yang digunakan, kembalikan perlengkapan sewa, dan lakukan pengecekan barang.","Serahkan laporan kegiatan\\/event kepada pengelola atau BUMDes sebagai dokumentasi.","Isi formulir evaluasi atau kirim umpan balik melalui kanal kontak resmi untuk perbaikan layanan."]',
                'sort_order' => 4,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
        ],
        'sop_objectives' => [
            [
                'id' => 5,
                'content' => 'Menjaga keselamatan pengunjung dan pekerja wisata.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 6,
                'content' => 'Memastikan proses tiket, pembayaran, dan penggunaan fasilitas berlangsung transparan.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 7,
                'content' => 'Melindungi kelestarian lingkungan waduk melalui tata kelola kebersihan terpadu.',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
            [
                'id' => 8,
                'content' => 'Mendorong koordinasi cepat antar instansi ketika terjadi kondisi darurat.',
                'sort_order' => 4,
                'created_at' => '2025-11-04 16:29:23',
                'updated_at' => '2025-11-04 16:29:23'
            ],
        ],
        'sop_partners' => [
            [
                'id' => 6,
                'title' => 'Puskesmas',
                'description' => 'Menangani layanan medis pertama dan rujukan kesehatan bagi pengunjung maupun petugas.',
                'sort_order' => 1,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 7,
                'title' => 'Polsek',
                'description' => 'Berkolaborasi menjaga keamanan area, penanganan laporan kehilangan, dan rekayasa lalu lintas.',
                'sort_order' => 2,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 8,
                'title' => 'BUMDes',
                'description' => 'Mengelola operasional resmi, kemitraan UMKM, serta sinkronisasi jadwal event desa.',
                'sort_order' => 3,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 9,
                'title' => 'KPW (Komunitas Peduli Waduk)',
                'description' => 'Menggerakkan relawan kebersihan dan edukasi lingkungan bagi pengunjung dan UMKM.',
                'sort_order' => 4,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
            [
                'id' => 10,
                'title' => 'Pos Keamanan Wisata',
                'description' => 'Menjadi pusat komando lapangan untuk penanganan darurat, lost and found, dan informasi umum.',
                'sort_order' => 5,
                'created_at' => '2025-11-04 16:29:24',
                'updated_at' => '2025-11-04 16:29:24'
            ],
        ],
        'sop_documents' => [
            [
                'id' => 1,
                'title' => 'SOP Destinasi Obyek Wisata Waduk Manduk Jatirejo',
                'file_path' => 'documents/nBoJffnE9R5mhtV1SGqZzHOpAolghB25TCIk3c1S.pdf',
                'original_name' => 'Luaran 1a-SOP Destinasi Obyek Wisata Waduk Manduk Jatirejo.pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 640686,
                'uploaded_at' => '2025-11-05 13:54:49',
                'created_at' => '2025-11-05 13:54:50',
                'updated_at' => '2025-11-06 05:30:40'
            ],
            [
                'id' => 2,
                'title' => 'SOP Penanggulangan Bencana Wahana Air Waduk Manduk Jatirejo',
                'file_path' => 'documents/r6MnyvNsi4WuDqMXbFPRvpJogB4ob1rq0OFD873S.pdf',
                'original_name' => 'Luaran 1b-SOP Penanggulangan Bencana Wahana Air Waduk Manduk Jatirejo.pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 531863,
                'uploaded_at' => '2025-11-06 05:31:30',
                'created_at' => '2025-11-06 05:31:30',
                'updated_at' => '2025-11-06 05:31:30'
            ],
            [
                'id' => 3,
                'title' => 'SOP Perencanaan Pengembangan Waduk Manduk Jatirejo',
                'file_path' => 'documents/ksJVR2B5ROBsUa8laBu0PJsLMOVXsF1yDIUzLXF4.pdf',
                'original_name' => 'Luaran 2-Perencanaan_Pengembangan_Waduk_Manduk_Jatirejo.pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 609703,
                'uploaded_at' => '2025-11-06 05:32:20',
                'created_at' => '2025-11-06 05:32:20',
                'updated_at' => '2025-11-06 05:32:20'
            ],
            [
                'id' => 4,
                'title' => 'SOP Pencatatan Keuangan Digital dengan QRIS Waduk Manduk Jatirejo',
                'file_path' => 'documents/WQcPRwH8T8wkIfLUkXMGm8hcsJNZBfPqntHqOejq.pdf',
                'original_name' => 'Luaran 3-SOP Pencatatan Keuangan Digital dengan QRIS Waduk Manduk Jatirejo.pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 594562,
                'uploaded_at' => '2025-11-06 05:32:48',
                'created_at' => '2025-11-06 05:32:48',
                'updated_at' => '2025-11-06 05:32:48'
            ],
            [
                'id' => 5,
                'title' => 'SOP Branding dan Pemasaran Digital Waduk Manduk Jatirejo',
                'file_path' => 'documents/DiDihCCgjBifYES5t8mN4DOpsyLWX4s1oZBTkiXB.pdf',
                'original_name' => 'Luaran 4-SOP_Branding_dan_Pemasaran_Digital_Waduk_Manduk_Jatirejo.pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 603141,
                'uploaded_at' => '2025-11-06 05:33:33',
                'created_at' => '2025-11-06 05:33:33',
                'updated_at' => '2025-11-06 05:33:33'
            ],
        ],
        ];

        foreach ($data as $table => $rows) {
            DB::table($table)->truncate();

            if (! empty($rows)) {
                DB::table($table)->insert($rows);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
