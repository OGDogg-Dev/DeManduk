@props([
    'ticketRows'   => [],
    'facilityRows' => [],
    'title'        => 'Fasilitas & Harga',
    'subtitle'     => 'Harga tiket dan fasilitas Waduk Manduk. Semua tarif mengikuti Perdes No. 04/2024 dan dapat berubah sesuai kebijakan pengelola.',
])

@php
  $tickets = !empty($ticketRows) ? $ticketRows : [
    ['Tiket masuk',        'Rp5.000 / orang',         'Dewasa & anak usia ≥3 tahun'],
    ['Parkir motor',       'Rp2.000 / unit',          'Sekali masuk'],
    ['Parkir mobil',       'Rp5.000 / unit',          'Sekali masuk'],
    ['Sewa perahu',        'Mulai Rp15.000',          'Durasi ±15–20 menit'],
  ];

  $facilities = !empty($facilityRows) ? $facilityRows : [
    ['Gazebo keluarga',    'Rp20.000 / jam',          'Maks 6–8 orang'],
    ['Amphitheater',       'Hubungi pengelola',       'Kegiatan komunitas / rombongan'],
    ['Sesi foto',          'Mulai Rp25.000',          'Aturan properti & area tertentu berlaku'],
  ];
@endphp

<x-section id="pricing" :title="$title" :subtitle="$subtitle">
  <div class="space-y-6">
    <x-table
      :headers="['Jenis', 'Tarif', 'Keterangan']"
      :rows="$tickets"
      caption="Daftar tarif tiket dan layanan dasar."
    />

    <x-table
      :headers="['Fasilitas', 'Tarif', 'Detail layanan']"
      :rows="$facilities"
      caption="Tarif fasilitas tambahan dan penyewaan ruang."
    />

    
  </div>
</x-section>
