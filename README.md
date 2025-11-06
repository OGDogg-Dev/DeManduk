<p align="center"><img src="public/assets/branding/logo.svg" alt="D'Manduk" width="200"></p>

# D'Manduk — Portal Informasi Wisata Waduk Manduk

D'Manduk adalah aplikasi Laravel 12 yang menyajikan informasi operasional Waduk Manduk: ringkasan SOP, agenda acara, galeri, jadwal layanan, serta integrasi pembayaran QRIS. Antarmuka public memanfaatkan komponen Blade kustom, Tailwind CSS 4, dan counter interaktif, sedangkan panel admin menyediakan pengelolaan konten dokumen SOP, galeri, berita, dan halaman panduan.

Konten default yang dibutuhkan aplikasi (dokumen SOP, data jam operasional, dll) disimpan dalam `database/seeders/SqliteContentSeeder.php`, diambil dari snapshot `database.sqlite` dan siap ditanam ulang kapan saja.

## Fitur Ringkas

- **Landing page dinamis**: hero carousel, quick nav dengan scroll spy, statistik beranimasi, accordion SOP, dan galeri dengan lightbox.
- **PDF viewer**: pratinjau dokumen SOP langsung melalui iframe streaming.
- **Panel admin**: CRUD lengkap untuk event, berita, galeri, SOP (dokumen & panduan), serta pengaturan laman beranda/QRIS/kontak.
- **Integrasi QRIS**: menampilkan langkah, catatan, dan FAQ penggunaan pembayaran digital.
- **Seeder snapshot**: `SqliteContentSeeder` menyusun ulang isi database sesuai dataset produksi demo.

## Persyaratan Sistem

- PHP 8.2+ dengan ekstensi `pdo_sqlite`, `mbstring`, `openssl`, `intl`
- Composer 2.6+
- Node.js 20+ & npm 10+
- SQLite (default) atau MySQL/PostgreSQL jika ingin menyesuaikan koneksi
- Git (opsional, untuk klon repositori)

## Instalasi

```bash
# 1. Klon repositori
git clone https://github.com/<username>/DeManduk.git
cd DeManduk

# 2. Pasang dependensi PHP dan Node
composer install
npm install

# 3. Salin env & set kunci aplikasi
cp .env.example .env
php artisan key:generate

# 4. Siapkan database SQLite (default)
touch database/database.sqlite

# 5. Migrasi & seeding snapshot konten
php artisan migrate --force
php artisan db:seed --class=Database\\Seeders\\SqliteContentSeeder

# 6. Build asset frontend
npm run build    # atau `npm run dev` untuk mode pengembangan

# 7. Jalankan server lokal
php artisan serve
```

Untuk workflow cepat, tersedia skrip gabungan:

```bash
composer run setup    # install + migrate + npm build sekaligus
```

## Skrip Pengembangan

- `composer run dev` — menyalakan PHP dev server, queue listener, dan Vite secara paralel
- `npm run dev` — Vite development server (HMR)
- `npm run build` — bundel produksi
- `php artisan test` — menjalankan suite pengujian

## Struktur Penting

- `app/Http/Controllers` — logic untuk halaman publik dan admin (mis. `SopDocumentController`, `HomeController`)
- `resources/views/components/public/*` — komponen Blade untuk landing page (hero, quick-nav, accordion SOP, dll)
- `database/seeders/SqliteContentSeeder.php` — dataset lengkap yang mereplikasi `database.sqlite`
- `storage/app/public/documents` — berkas PDF SOP (sesuaikan saat deploy)

## Lisensi

Proyek ini dibangun di atas Laravel dan dirilis dengan lisensi MIT. Silakan gunakan, modifikasi, dan kembangkan sesuai kebutuhan destinasi wisata Anda. Walau demikian, mohon tetap menjaga atribusi pada karya asli D'Manduk bila dibutuhkan.။
