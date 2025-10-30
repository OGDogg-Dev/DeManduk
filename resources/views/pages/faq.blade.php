@extends('layouts.app')

@section('content')
    <x-section
        title="Pertanyaan yang sering diajukan"
        subtitle="Temukan jawaban seputar tiket, fasilitas, kebijakan kunjungan, hingga informasi pembayaran digital."
    >
        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-4">
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Tiket & Kunjungan</h3>
                <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <summary class="cursor-pointer text-base font-semibold text-slate-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                        Apakah tiket bisa dibeli online?
                    </summary>
                    <p class="mt-3 text-sm text-slate-600">
                        Untuk saat ini tiket tersedia di loket utama. Sistem pembelian online akan diintegrasikan pada fase backend portal ini.
                    </p>
                </details>
                <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <summary class="cursor-pointer text-base font-semibold text-slate-800">
                        Apakah ada diskon untuk warga lokal?
                    </summary>
                    <p class="mt-3 text-sm text-slate-600">
                        Ya, pemegang KTP Desa Manduk mendapatkan diskon 20% untuk tiket masuk dan sewa gazebo.
                    </p>
                </details>
                <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <summary class="cursor-pointer text-base font-semibold text-slate-800">
                        Apakah diperbolehkan membawa makanan dari luar?
                    </summary>
                    <p class="mt-3 text-sm text-slate-600">
                        Boleh, selama menjaga kebersihan area. Dilarang membawa kompor gas portabel dan alkohol.
                    </p>
                </details>
            </div>
            <div class="space-y-4">
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Fasilitas & Layanan</h3>
                <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <summary class="cursor-pointer text-base font-semibold text-slate-800">
                        Apakah tersedia kursi roda atau stroller?
                    </summary>
                    <p class="mt-3 text-sm text-slate-600">
                        Kursi roda dapat dipinjam gratis di pusat informasi dengan meninggalkan identitas. Stroller pribadi diperbolehkan.
                    </p>
                </details>
                <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <summary class="cursor-pointer text-base font-semibold text-slate-800">
                        Bagaimana jika hujan deras?
                    </summary>
                    <p class="mt-3 text-sm text-slate-600">
                        Petugas akan mengumumkan penutupan sementara wahana air. Pengembalian dana dilakukan di loket dengan menunjukkan tiket.
                    </p>
                </details>
                <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <summary class="cursor-pointer text-base font-semibold text-slate-800">
                        Apakah ada area bermain anak?
                    </summary>
                    <p class="mt-3 text-sm text-slate-600">
                        Tersedia playground outdoor, taman sensorik, dan kursus mini memancing anak dengan pendampingan petugas.
                    </p>
                </details>
            </div>
        </div>
    </x-section>

    <x-section
        variant="muted"
        title="Informasi QRIS & pembayaran"
    >
        <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <summary class="cursor-pointer text-base font-semibold text-slate-800">
                Apakah QRIS tersedia di semua tenant?
            </summary>
            <p class="mt-3 text-sm text-slate-600">
                QRIS utama dikelola pengelola waduk. Tenant UMKM juga memiliki QRIS masing-masing. Pastikan logo resmi Waduk Manduk tertera pada stan pembayaran.
            </p>
        </details>
        <details class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <summary class="cursor-pointer text-base font-semibold text-slate-800">
                Bagaimana cara klaim transaksi gagal?
            </summary>
            <p class="mt-3 text-sm text-slate-600">
                Simpan bukti pembayaran dan laporkan ke petugas loket atau email <a href="mailto:pembayaran@wadukmanduk.id" class="font-semibold text-blue-600">pembayaran@wadukmanduk.id</a>.
                Refund dilakukan maksimal 3 hari kerja.
            </p>
        </details>
    </x-section>

    <x-section title="Butuh bantuan lebih lanjut?">
        <x-alert variant="info" title="Hubungi kami">
            Silakan isi formulir di halaman <a href="{{ route('kontak') }}" class="font-semibold text-blue-600">Kontak</a> atau kirim pesan WhatsApp ke 0812-9999-0000.
        </x-alert>
    </x-section>
@endsection
