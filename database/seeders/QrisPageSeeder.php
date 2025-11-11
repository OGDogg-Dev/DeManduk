<?php

namespace Database\Seeders;

use App\Models\QrisFaq;
use App\Models\QrisNote;
use App\Models\QrisStep;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class QrisPageSeeder extends Seeder
{
    public function run(): void
    {
        QrisStep::query()->delete();
        QrisNote::query()->delete();
        QrisFaq::query()->delete();

        SiteSetting::setValue('qris.subtitle', 'Nikmati transaksi non-tunai yang cepat dan aman di seluruh area Waduk Manduk menggunakan satu kode QR resmi.');
        SiteSetting::setValue('qris.primary_alert_variant', 'info');
        SiteSetting::setValue('qris.primary_alert_title', 'Kode QR resmi pengelola');
        SiteSetting::setValue(
            'qris.primary_alert_body',
            'Selalu pastikan logo Waduk Manduk dan tulisan "Badan Pengelola Waduk Manduk" tertera pada poster maupun stiker QRIS. Jika menemukan QR mencurigakan, laporkan ke petugas loket.'
        );
        SiteSetting::setValue('qris.poster_path', 'images/qris/waduk-manduk-qris.svg');
        SiteSetting::setValue('qris.poster_formats', 'SVG (placeholder - PNG dan PDF segera tersedia)');
        SiteSetting::setValue('qris.bottom_alert_variant', 'warning');
        SiteSetting::setValue('qris.bottom_alert_title', 'Disclaimer penting');
        SiteSetting::setValue(
            'qris.bottom_alert_body',
            'Situs ini hanya menyediakan informasi. Segala transaksi dilakukan langsung di lokasi Waduk Manduk. Pengelola tidak bertanggung jawab atas transfer ke rekening selain QRIS resmi.'
        );

        $steps = [
            ['title' => 'Siapkan aplikasi pembayaran', 'description' => 'Buka aplikasi mobile banking atau e-wallet favorit yang mendukung QRIS.', 'sort_order' => 1],
            ['title' => 'Scan QR', 'description' => 'Arahkan kamera ke poster QRIS Waduk Manduk. Pastikan nama merchant sesuai.', 'sort_order' => 2],
            ['title' => 'Masukkan nominal', 'description' => 'Tiket, wahana, dan produk UMKM memiliki nominal yang diinformasikan kasir.', 'sort_order' => 3],
            ['title' => 'Tunjukkan bukti bayar', 'description' => 'Tunjukkan bukti pembayaran kepada petugas untuk validasi dan pencatatan.', 'sort_order' => 4],
        ];

        foreach ($steps as $step) {
            QrisStep::create($step);
        }

        $notes = [
            ['content' => 'Transaksi QRIS diproses langsung di lokasi. Situs ini tidak menerima pembayaran online.', 'sort_order' => 1],
            ['content' => 'Simpan bukti transaksi digital Anda untuk keperluan refund atau audit.', 'sort_order' => 2],
            ['content' => 'Batas nominal mengikuti kebijakan aplikasi pembayaran masing-masing.', 'sort_order' => 3],
        ];

        foreach ($notes as $note) {
            QrisNote::create($note);
        }

        $faqs = [
            [
                'icon' => '?',
                'title' => 'Kenapa transaksi gagal?',
                'body' => 'Pastikan jaringan internet stabil dan saldo mencukupi. Jika nominal terdebet namun transaksi gagal, hubungi petugas dan kirim bukti bayar ke pembayaran@wadukmanduk.id.',
                'sort_order' => 1,
            ],
            [
                'icon' => 'DC',
                'title' => 'Bisakah bayar dengan kartu debit?',
                'body' => 'Layanan EDC sedang dalam pengembangan. Gunakan QRIS atau pembayaran tunai di loket.',
                'sort_order' => 2,
            ],
        ];

        foreach ($faqs as $faq) {
            QrisFaq::create($faq);
        }
    }
}

