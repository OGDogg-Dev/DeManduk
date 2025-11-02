@props(['openingRows' => []])

<x-section
    id="hours"
    variant="muted"
    title="Jam Operasional"
    subtitle="Rencanakan kunjungan Anda sesuai jadwal terbaru. Informasi ini akan diperbarui secara berkala."
>
    <x-table :headers="['Hari', 'Jam buka', 'Catatan']" :rows="$openingRows" />
    <x-alert variant="warning" title="Penyesuaian musiman">
        Saat debit air meningkat di musim hujan, jam operasional dapat dipersingkat. Pantau pengumuman melalui media sosial resmi kami.
    </x-alert>
</x-section>
