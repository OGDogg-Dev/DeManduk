<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('home_slides', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path');
            $table->string('cta_label')->nullable();
            $table->string('cta_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('home_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('home_features', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('home_pricing_rows', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('label');
            $table->string('price')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('home_opening_hours', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('hours');
            $table->text('note')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('home_stats', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('value');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('home_procedures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('home_guides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('items')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->date('event_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('location')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // ---------------------------------------------------------------------
        // Seed initial data (boleh dipindah ke Seeder ke depannya)
        // ---------------------------------------------------------------------
        $now = now();
        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;

        // site_settings
        DB::table('site_settings')->insert([
            [
                'key'        => 'site.title',
                'value'      => "D'Manduk",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key'        => 'site.logo_path',
                'value'      => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key'        => 'home.about_paragraphs',
                'value'      => json_encode([
                    'Waduk Manduk dikenal sebagai destinasi wisata air yang bersih dan ramah keluarga. Pengunjung dapat menikmati panorama senja, berperahu santai, hingga mengikuti agenda komunitas yang rutin digelar di amphitheater.',
                    'Berbagai wahana edukasi dan kuliner hadir menemani, mulai dari studio kreatif, area playground, hingga sentra UMKM dengan sertifikasi halal. Semua diatur rapi sehingga mudah diakses oleh semua kalangan.',
                ], $jsonFlags),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key'        => 'home.about_image',
                'value'      => 'resources/images/gallery/gallery-6.svg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key'        => 'home.map_embed_url',
                'value'      => 'https://maps.google.com/maps?q=Waduk%20Manduk&t=&z=15&ie=UTF8&iwloc=&output=embed',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key'        => 'home.map_link_label',
                'value'      => 'Buka di Google Maps',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key'        => 'home.map_directions_url',
                'value'      => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key'        => 'home.supporting_institutions',
                'value'      => json_encode([
                    ['title' => 'Puskesmas', 'description' => 'Layanan kesehatan dasar dan penanganan medis cepat. No Telp 081335322216'],
                    ['title' => 'Polsek', 'description' => 'Koordinasi keamanan dan penanganan laporan kehilangan.'],
                    ['title' => 'BUMDes', 'description' => 'Pengelolaan operasional wisata dan kemitraan UMKM.'],
                    ['title' => 'KPW (Komunitas Peduli Waduk)', 'description' => 'Relawan kebersihan dan edukasi lingkungan.'],
                    ['title' => 'Pos Keamanan Wisata', 'description' => 'Pusat informasi, patroli area, dan respon darurat.'],
                ], $jsonFlags),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // home_slides
        DB::table('home_slides')->insert([
            [
                'eyebrow'     => 'Discover the Colorful World',
                'title'       => 'New Adventure',
                'description' => 'Expedisi seru mengelilingi waduk dengan perahu wisata, lengkap dengan panorama sunrise dan udara sejuk.',
                'image_path'  => 'resources/images/gallery/1.JPG',
                'cta_label'   => 'Jelajahi Sekarang',
                'cta_url'     => 'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7',
                'sort_order'  => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'eyebrow'     => 'Discover the Colorful World',
                'title'       => 'New Trip',
                'description' => 'Rencanakan perjalanan keluarga dengan fasilitas lengkap: kuliner, wahana air, dan ruang bermain anak.',
                'image_path'  => 'resources/images/gallery/3.JPG',
                'cta_label'   => 'Rencanakan Rute',
                'cta_url'     => '/peta',
                'sort_order'  => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'eyebrow'     => 'Discover the Colorful World',
                'title'       => 'New Experience',
                'description' => 'Nikmati pengalaman malam dengan lampion night market, live music, dan kuliner khas Manduk.',
                'image_path'  => 'resources/images/gallery/6.JPG',
                'cta_label'   => 'Lihat Agenda',
                'cta_url'     => '/event',
                'sort_order'  => 3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);

        // home_projects
        DB::table('home_projects')->insert([
            [
                'title'       => 'Festival Kuliner Manduk',
                'description' => 'Eksplorasi rasa kuliner lokal di tepi waduk dengan live cooking.',
                'image_path'  => 'resources/images/gallery/gallery-2.svg',
                'sort_order'  => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Manduk Fun Paddle',
                'description' => 'Komunitas olahraga air bersatu menjaga kebersihan waduk.',
                'image_path'  => 'resources/images/gallery/gallery-4.svg',
                'sort_order'  => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Lampion Night Market',
                'description' => 'Suasana malam yang magis ditemani musik akustik dan bazar UMKM.',
                'image_path'  => 'resources/images/gallery/gallery-3.svg',
                'sort_order'  => 3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);

        // home_features
        DB::table('home_features')->insert([
            [
                'title'       => 'Panorama & Wahana Air',
                'description' => 'Perahu wisata, kano, dan paddle board dengan pelampung keselamatan.',
                'sort_order'  => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Kuliner & UMKM',
                'description' => 'Kopi Manduk, olahan ikan, dan cendera mata khas pesisir.',
                'sort_order'  => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Teknisi Berpengalaman',
                'description' => 'Tim teknis menjaga setiap wahana dalam kondisi prima.',
                'sort_order'  => 3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Pelayanan Profesional',
                'description' => 'Petugas informasi siap membantu itinerary dan rekomendasi aktivitas.',
                'sort_order'  => 4,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Highly Recommended',
                'description' => 'Pengunjung memberikan nilai tinggi untuk kenyamanan dan kebersihan.',
                'sort_order'  => 5,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Positive Reviews',
                'description' => 'Review positif dari wisatawan lokal maupun luar kota.',
                'sort_order'  => 6,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);

        // home_pricing_rows
        DB::table('home_pricing_rows')->insert([
            [
                'category'    => 'ticket',
                'label'       => 'Tiket masuk dewasa',
                'price'       => 'Rp12.000',
                'description' => 'Sudah termasuk akses area publik dan spot foto.',
                'sort_order'  => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'category'    => 'ticket',
                'label'       => 'Tiket masuk anak (3-12 tahun)',
                'price'       => 'Rp8.000',
                'description' => 'Gratis untuk balita dengan pendamping.',
                'sort_order'  => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'category'    => 'ticket',
                'label'       => 'Paket keluarga (maksimal 5 orang)',
                'price'       => 'Rp40.000',
                'description' => 'Diskon 20% untuk KTP Desa Manduk.',
                'sort_order'  => 3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'category'    => 'ticket',
                'label'       => 'Parkir motor / mobil',
                'price'       => 'Rp3.000 / Rp5.000',
                'description' => 'Area parkir 24 jam dengan CCTV.',
                'sort_order'  => 4,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'category'    => 'facility',
                'label'       => 'Perahu wisata (20 menit)',
                'price'       => 'Rp25.000 / orang',
                'description' => 'Pelampung disediakan. Anak di bawah 5 tahun wajib didampingi.',
                'sort_order'  => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'category'    => 'facility',
                'label'       => 'Kano dan paddle board',
                'price'       => 'Rp35.000 / 30 menit',
                'description' => 'Syarat usia minimal 10 tahun, wajib menggunakan alat keselamatan.',
                'sort_order'  => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'category'    => 'facility',
                'label'       => 'Gazebo pinggir waduk',
                'price'       => 'Rp25.000 / 3 jam',
                'description' => 'Kapasitas hingga 8 orang, dekat outlet kuliner.',
                'sort_order'  => 3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'category'    => 'facility',
                'label'       => 'Amphitheater (3 jam)',
                'price'       => 'Rp450.000',
                'description' => 'Termasuk sound system standar dan 2 petugas lapangan.',
                'sort_order'  => 4,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);

        // home_opening_hours
        DB::table('home_opening_hours')->insert([
            [
                'label'      => 'Area wisata utama',
                'hours'      => '07.00 - 21.00 WIB',
                'note'       => 'Perubahan jadwal diumumkan di media sosial resmi.',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label'      => 'Pusat informasi wisata',
                'hours'      => '07.00 - 17.00 WIB',
                'note'       => 'Layanan pemesanan wahana dan pemandu.',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label'      => 'Resto apung dan food court',
                'hours'      => '07.00 - 22.00 WIB',
                'note'       => 'Live cooking tersedia Jumat sampai Minggu.',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label'      => 'Amphitheater dan aula serbaguna',
                'hours'      => '08.00 - 21.00 WIB',
                'note'       => 'Booking minimal H-3 untuk event.',
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label'      => 'Studio podcast dan media center',
                'hours'      => '09.00 - 17.00 WIB',
                'note'       => 'Reservasi online segera tersedia.',
                'sort_order' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // home_stats
        DB::table('home_stats')->insert([
            [
                'label'      => 'Total wisatawan',
                'value'      => '5.962',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label'      => 'Rata-rata bulanan',
                'value'      => '2.394',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label'      => 'UMKM aktif',
                'value'      => '1.439',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label'      => 'Inisiatif sosial',
                'value'      => '933',
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // home_procedures
        DB::table('home_procedures')->insert([
            [
                'title'       => 'Alur kedatangan tertib',
                'description' => 'Pengunjung wajib melakukan registrasi di loket, menerima gelang identitas, serta mengikuti arahan briefing keselamatan sebelum menuju dermaga.',
                'sort_order'  => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Pembayaran digital terintegrasi',
                'description' => 'Seluruh transaksi resmi mendukung QRIS Waduk Manduk sehingga proses tiket dan sewa fasilitas lebih cepat dan transparan.',
                'sort_order'  => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Penanganan darurat siaga',
                'description' => 'Pos keamanan wisata siaga selama jam operasional untuk respon pertama pada insiden medis, cuaca ekstrem, maupun informasi barang hilang.',
                'sort_order'  => 3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);

        // home_guides
        DB::table('home_guides')->insert([
            [
                'title'      => 'Pra-kunjungan',
                'items'      => json_encode([
                    'Reservasi rombongan minimal tiga hari sebelum kedatangan untuk penjadwalan petugas.',
                    'Pastikan membawa identitas resmi, surat izin event (jika ada), dan perlengkapan keselamatan pribadi.',
                    "Tinjau prakiraan cuaca serta pengumuman terbaru dari kanal resmi D'Manduk.",
                ], $jsonFlags),
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'Kedatangan & tiket',
                'items'      => json_encode([
                    'Lakukan registrasi di loket utama, ambil gelang identitas, dan simpan bukti transaksi.',
                    "Gunakan QRIS resmi D'Manduk untuk pembayaran; laporkan segera bila terjadi kegagalan transaksi.",
                    'Ikuti briefing keselamatan dari petugas sebelum memasuki dermaga atau wahana air.',
                ], $jsonFlags),
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'Aktivitas di area wisata',
                'items'      => json_encode([
                    'Patuhi kapasitas wahana, jalur pedestrian, dan zona steril yang ditetapkan petugas.',
                    'Gunakan fasilitas kebersihan: bank sampah, tong organik/anorganik, dan stasiun daur ulang.',
                    'Laporkan kejadian darurat kepada Pos Keamanan Wisata atau relawan KPW terdekat.',
                ], $jsonFlags),
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'Penutupan kegiatan',
                'items'      => json_encode([
                    'Bersihkan area yang digunakan, kembalikan perlengkapan sewa, dan lakukan pengecekan barang.',
                    'Serahkan laporan kegiatan/event kepada pengelola atau BUMDes sebagai dokumentasi.',
                    'Isi formulir evaluasi atau kirim umpan balik melalui kanal kontak resmi untuk perbaikan layanan.',
                ], $jsonFlags),
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // events
        DB::table('events')->insert([
            [
                'title'        => 'Manduk Lakeside Festival',
                'slug'         => 'manduk-lakeside-festival',
                'category'     => 'Festival',
                'event_date'   => '2025-11-23',
                'start_time'   => '16:00:00',
                'end_time'     => '21:00:00',
                'location'     => 'Amphitheater Waduk Manduk',
                'cover_image'  => null,
                'excerpt'      => 'Festival kuliner malam, pertunjukan musik akustik, dan pertunjukan seni tradisional.',
                'body'         => 'Nikmati pengalaman malam di Waduk Manduk dengan ragam kuliner khas, pertunjukan musik akustik, serta parade seni tradisional. Booth UMKM pilihan akan hadir dengan menu spesial.',
                'published_at' => $now,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'title'        => 'Fun Paddle dan Clean Up',
                'slug'         => 'fun-paddle-dan-clean-up',
                'category'     => 'Komunitas',
                'event_date'   => '2025-11-30',
                'start_time'   => '07:00:00',
                'end_time'     => '10:00:00',
                'location'     => 'Dermaga Utama',
                'cover_image'  => null,
                'excerpt'      => 'Aksi bersih waduk bersama komunitas pecinta alam dan sesi fun paddle bersama pelatih.',
                'body'         => 'Gabung dalam aksi bersih waduk sekaligus menikmati fun paddle. Peserta akan mendapatkan briefing keselamatan, perlengkapan dasar, serta sertifikat partisipasi.',
                'published_at' => $now,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'title'        => 'Manduk Night Run 5K',
                'slug'         => 'manduk-night-run-5k',
                'category'     => 'Olahraga',
                'event_date'   => '2025-12-14',
                'start_time'   => '18:30:00',
                'end_time'     => '21:00:00',
                'location'     => 'Lintasan Perimeter Waduk',
                'cover_image'  => null,
                'excerpt'      => 'Lari malam mengelilingi waduk dilengkapi instalasi lampu tematik dan expo UMKM.',
                'body'         => 'Rasakan sensasi night run dengan instalasi pencahayaan tematik. Paket peserta sudah termasuk jersey, medali finisher, dan kupon kuliner UMKM.',
                'published_at' => $now,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'title'        => 'Workshop Fotografi Landscape',
                'slug'         => 'workshop-fotografi-landscape',
                'category'     => 'Workshop',
                'event_date'   => '2025-12-21',
                'start_time'   => '08:00:00',
                'end_time'     => '12:00:00',
                'location'     => 'Sky Deck Waduk Manduk',
                'cover_image'  => null,
                'excerpt'      => 'Sesi belajar teknik fotografi sunrise bersama fotografer lokal dan praktikum langsung.',
                'body'         => 'Pelajari teknik fotografi landscape langsung di lapangan. Peserta membawa kamera pribadi dan akan didampingi mentor profesional.',
                'published_at' => $now,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('home_guides');
        Schema::dropIfExists('home_procedures');
        Schema::dropIfExists('home_stats');
        Schema::dropIfExists('home_opening_hours');
        Schema::dropIfExists('home_pricing_rows');
        Schema::dropIfExists('home_features');
        Schema::dropIfExists('home_projects');
        Schema::dropIfExists('home_slides');
        Schema::dropIfExists('site_settings');
    }
};
