@props([
    'openingRows' => [],
    'caption'     => 'Jam operasional saat ini',
])

@php
  $rows = !empty($openingRows) ? $openingRows : [
    ['Senin–Jumat',  '07.00 – 17.00 WIB', 'Operasional reguler'],
    ['Sabtu–Minggu', '06.00 – 18.00 WIB', 'Antrean lebih ramai'],
    ['Hari Besar',   'Mengikuti pengumuman', 'Cek media sosial resmi'],
  ];
@endphp

<x-section
  id="hours"
  variant="muted"
  title="Jam Operasional"
  subtitle="Rencanakan kunjungan Anda sesuai jadwal terbaru. Informasi ini akan diperbarui secara berkala."
>
  <x-table
    :headers="['Hari', 'Jam buka', 'Catatan']"
    :rows="$rows"
    :caption="$caption"
  />

  <x-alert variant="warning" title="Penyesuaian musiman" class="mt-6">
    Saat debit air meningkat di musim hujan, jam operasional dapat dipersingkat. Pantau pengumuman melalui media sosial resmi kami.
  </x-alert>
</x-section>
