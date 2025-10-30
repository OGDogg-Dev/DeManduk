@extends('layouts.app')

@section('content')
    <x-section
        title="Informasi QRIS Waduk Manduk"
        subtitle="Nikmati transaksi non-tunai yang cepat dan aman di seluruh area Waduk Manduk menggunakan satu kode QR resmi."
    >
        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="space-y-6">
                <x-alert variant="info" title="Kode QR resmi pengelola">
                    Selalu pastikan logo Waduk Manduk dan tulisan &quot;Badan Pengelola Waduk Manduk&quot; tertera pada poster maupun stiker QRIS.
                    Jika menemukan QR mencurigakan, laporkan ke petugas loket.
                </x-alert>
                <x-qris.steps
                    :steps="[
                        ['title' => 'Siapkan aplikasi pembayaran', 'description' => 'Buka aplikasi mobile banking atau e-wallet favorit yang mendukung QRIS.'],
                        ['title' => 'Scan QR', 'description' => 'Arahkan kamera ke poster QRIS Waduk Manduk. Pastikan nama merchant sesuai.'],
                        ['title' => 'Masukkan nominal', 'description' => 'Tiket, wahana, dan produk UMKM memiliki nominal yang diinformasikan kasir.'],
                        ['title' => 'Tunjukkan bukti bayar', 'description' => 'Tunjukkan bukti pembayaran kepada petugas untuk validasi dan pencatatan.'],
                    ]"
                />
                <x-alert variant="success" title="Keuntungan menggunakan QRIS">
                    Tidak perlu uang tunai, bukti transaksi tercatat otomatis, dan promo bank atau e-wallet tetap berlaku.
                </x-alert>
            </div>
            <div class="space-y-6">
                <x-qris.download-poster
                    :download="Vite::asset('resources/images/qris/waduk-manduk-qris.svg')"
                    format="SVG"
                    formats="SVG (placeholder - PNG dan PDF segera tersedia)"
                />
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-slate-900">Catatan transaksi</h3>
                    <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-slate-600">
                        <li>Transaksi QRIS diproses langsung di lokasi. Situs ini tidak menerima pembayaran online.</li>
                        <li>Simpan bukti transaksi digital Anda untuk keperluan refund atau audit.</li>
                        <li>Batas nominal mengikuti kebijakan aplikasi pembayaran masing-masing.</li>
                    </ul>
                </div>
            </div>
        </div>
    </x-section>

    <x-section variant="muted" title="Pertanyaan umum seputar QRIS">
        <div class="grid gap-6 md:grid-cols-2">
            <x-card title="Kenapa transaksi gagal?">
                <x-slot:icon>?</x-slot:icon>
                <p class="text-sm text-slate-600">
                    Pastikan jaringan internet stabil dan saldo mencukupi. Jika nominal terdebet namun transaksi gagal, hubungi petugas dan kirim bukti bayar ke
                    <a href="mailto:pembayaran@wadukmanduk.id" class="font-semibold text-blue-600">pembayaran@wadukmanduk.id</a>.
                </p>
            </x-card>
            <x-card title="Bisakah bayar dengan kartu debit?">
                <x-slot:icon>DC</x-slot:icon>
                <p class="text-sm text-slate-600">
                    Saat ini layanan EDC sedang dalam pengembangan. Untuk sementara, gunakan QRIS atau pembayaran tunai di loket.
                </p>
            </x-card>
        </div>
    </x-section>

    <x-section title="Butuh bantuan lebih lanjut?">
        <x-alert variant="warning" title="Disclaimer penting">
            Situs ini hanya menyediakan informasi. Segala transaksi dilakukan langsung di lokasi Waduk Manduk. Pengelola tidak bertanggung jawab atas transfer ke rekening selain QRIS resmi.
        </x-alert>
    </x-section>
@endsection
