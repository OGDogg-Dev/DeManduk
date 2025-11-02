@props([
    'ticketRows' => [],
    'facilityRows' => [],
])

<x-section
    id="pricing"
    title="Fasilitas & Harga"
    subtitle="Harga tiket dan fasilitas Waduk Manduk. Semua tarif mengikuti Perdes No. 04/2024 dan dapat berubah sesuai kebijakan pengelola."
>
    <x-table :headers="['Jenis', 'Tarif', 'Keterangan']" :rows="$ticketRows" caption="Daftar tarif tiket dan layanan dasar." />
    <x-table :headers="['Fasilitas', 'Tarif', 'Detail layanan']" :rows="$facilityRows" caption="Tarif fasilitas tambahan dan penyewaan ruang." />
    <x-alert variant="info" title="Pemesanan rombongan">
        Rombongan 30 orang ke atas dapat menghubungi
        <a href="mailto:event@wadukmanduk.id" class="font-semibold text-blue-600">event@wadukmanduk.id</a>
        untuk mendapatkan jadwal khusus, pemandu wisata, serta paket konsumsi.
    </x-alert>
</x-section>
