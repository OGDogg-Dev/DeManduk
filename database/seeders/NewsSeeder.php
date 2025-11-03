<?php

namespace Database\Seeders;

use App\Models\NewsPost;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        NewsPost::query()->delete();

        $now = now();

        $posts = [
            [
                'title' => 'Launching Dermaga Kayu & Area Santai Baru',
                'slug' => 'launching-dermaga-kayu',
                'author' => "Tim Redaksi D'Manduk",
                'category' => 'Pengembangan',
                'excerpt' => 'Dermaga kayu berlapis anti slip dan kursi santai siap menyambut wisatawan jelang libur akhir tahun.',
                'body' => "Waduk Manduk resmi memperkenalkan dermaga kayu baru berkapasitas 200 pengunjung.\nStruktur dermaga menggunakan material ramah lingkungan dengan lapisan anti slip sehingga aman saat hujan.\n\nArea santai disertai kursi kayu ergonomis, penerangan hemat energi, dan titik foto baru menghadap lampion terapung. Pengunjung dapat menikmati panorama matahari terbenam dengan latar belakang perahu wisata.\n\nProgram revitalisasi melibatkan BUMDes dan komunitas Manduk Creative dengan tenaga kerja lokal.",
                'cover_image' => 'resources/images/blog/dermaga-launch.svg',
                'read_time_minutes' => 4,
                'tags' => ['Fasilitas', 'Infrastruktur', 'Revitalisasi'],
                'published_at' => $now->copy()->subDays(10),
            ],
            [
                'title' => 'UMKM Kuliner Manduk Resmi Bersertifikasi Halal',
                'slug' => 'umkm-kuliner-manduk-resmi-bersertifikasi-halal',
                'author' => 'Diskominfo Karanganyar',
                'category' => 'UMKM',
                'excerpt' => 'Sebanyak 30 pelaku UMKM berhasil mengantongi sertifikat halal untuk meningkatkan kepercayaan pengunjung.',
                'body' => "Sertifikasi halal difasilitasi oleh pemerintah desa bekerja sama dengan lembaga resmi.\nPelaku usaha menerima pendampingan penuh dari tahap administrasi hingga audit lapangan.\n\nKini pengunjung dapat menikmati kuliner Manduk dengan rasa aman dan nyaman.\nKegiatan sosialisasi juga mencakup pengelolaan kebersihan dapur dan standar penyajian.",
                'cover_image' => 'resources/images/blog/umkm-halal.svg',
                'read_time_minutes' => 3,
                'tags' => ['UMKM', 'Kuliner', 'Halal'],
                'published_at' => $now->copy()->subDays(7),
            ],
            [
                'title' => 'Tips Menikmati Waduk Manduk Saat Musim Hujan',
                'slug' => 'tips-menikmati-waduk-manduk-saat-musim-hujan',
                'author' => "Tim Panduan D'Manduk",
                'category' => 'Tips Wisata',
                'excerpt' => 'Kenali rute alternatif, waktu terbaik, dan fasilitas indoor yang nyaman bagi keluarga.',
                'body' => "Musim hujan bukan halangan untuk berwisata di Waduk Manduk.\nPilih jam kunjungan pagi menjelang siang ketika curah hujan cenderung rendah.\n\nManfaatkan fasilitas indoor seperti studio kreatif, pusat informasi, dan area kuliner tertutup.\nSimpan nomor Pos Keamanan Wisata untuk respon cepat bila diperlukan.\n\nSelalu cek aplikasi cuaca dan gunakan alas kaki anti slip demi kenyamanan.",
                'cover_image' => 'resources/images/blog/rainy-tips.svg',
                'read_time_minutes' => 5,
                'tags' => ['Panduan', 'Cuaca', 'Keamanan'],
                'published_at' => $now->copy()->subDays(3),
            ],
        ];

        foreach ($posts as $post) {
            NewsPost::query()->create($post + [
                'created_by' => null,
                'updated_by' => null,
            ]);
        }
    }
}
