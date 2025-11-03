@extends('layouts.admin', ['title' => 'Dasbor'])

@php
    $stats = [
        [
            'label' => 'Total Kunjungan Bulan Ini',
            'value' => '2.394',
            'description' => 'Naik dibanding bulan lalu setelah promosi di media sosial.',
            'trend' => 6.8,
            'icon' => 'chart-bar',
        ],
        [
            'label' => 'Event Mendatang',
            'value' => '4',
            'description' => 'Event komunitas yang butuh kurasi konten front page.',
            'trend' => 2.5,
            'icon' => 'calendar',
        ],
        [
            'label' => 'UMKM Terdaftar',
            'value' => '1.439',
            'description' => 'Bisa dikelompokkan ulang untuk katalog kuliner publik.',
            'trend' => 0.0,
            'icon' => 'building-storefront',
        ],
        [
            'label' => 'Tiket QRIS Tervalidasi',
            'value' => '982',
            'description' => 'Transaksi daring sejak uji coba bulan Oktober.',
            'trend' => 11.4,
            'icon' => 'credit-card',
        ],
    ];

    $publicSections = [
        [
            'name' => 'Beranda',
            'status' => 'Tayang',
            'last_update' => '2 hari lalu',
            'owner' => 'Admin Desa',
        ],
        [
            'name' => 'Profil & Sejarah',
            'status' => 'Draf',
            'last_update' => '5 hari lalu',
            'owner' => 'Tim Narasi',
        ],
        [
            'name' => 'Agenda Event',
            'status' => 'Perlu review',
            'last_update' => '1 hari lalu',
            'owner' => 'Pokdarwis',
        ],
        [
            'name' => 'Galeri Media',
            'status' => 'Tayang',
            'last_update' => '4 jam lalu',
            'owner' => 'Tim Dokumentasi',
        ],
    ];

    $timeline = [
        [
            'time' => '08.40',
            'title' => 'Perbarui hero carousel',
            'description' => 'Tambahkan foto festival lampion ke slider utama.',
            'author' => 'Admin Desa',
        ],
        [
            'time' => '10.15',
            'title' => 'Review konten FAQ',
            'description' => 'Pastikan informasi tiket online sudah menampilkan jadwal beta.',
            'author' => 'Tim Narasi',
        ],
        [
            'time' => '13.55',
            'title' => 'Unggah dokumentasi event',
            'description' => 'Upload 12 foto Manduk Fun Paddle ke galeri publik.',
            'author' => 'Tim Dokumentasi',
        ],
    ];

    $systemStatus = [
        [
            'label' => 'Konten terisi',
            'value' => '87%',
            'note' => 'Section publik sudah terisi data',
            'percent' => 87,
        ],
        [
            'label' => 'Validasi media',
            'value' => '12 / 20',
            'note' => 'Gambar beresolusi tinggi siap tayang',
            'percent' => 60,
        ],
        [
            'label' => 'Tiket digital',
            'value' => '92%',
            'note' => 'QRIS digunakan pengunjung daring',
            'percent' => 92,
        ],
    ];

    $backlog = [
        ['title' => 'Review SOP & upload PDF terbaru', 'owner' => 'Sekretariat', 'eta' => 'Besok'],
        ['title' => 'Kurasi berita komunitas minggu ini', 'owner' => 'Tim Konten', 'eta' => '2 hari lagi'],
        ['title' => 'Sinkronisasi event Desember', 'owner' => 'Pokdarwis', 'eta' => 'Jumat'],
    ];
@endphp

@section('content')
    <div class="space-y-8">
        <section class="rounded-3xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-500 p-8 text-white shadow-lg">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-indigo-100/80">Ringkasan Hari Ini</p>
                    <h1 class="text-3xl font-semibold">Halo, Admin Desa!</h1>
                    <p class="max-w-2xl text-sm text-indigo-100/90">
                        Kelola konten publik, pantau event, dan pastikan pengalaman pengunjung D'Manduk selalu prima.
                    </p>
                    <div class="flex flex-wrap gap-3 pt-1">
                        <a href="{{ route('admin.home.index') }}" class="btn-primary px-6 py-3">Kelola Beranda</a>
                        <a href="{{ route('admin.events.create') }}" class="btn-secondary px-6 py-3">Tambah Event</a>
                        <a href="{{ route('admin.pages.contact.settings.edit') }}" class="btn-ghost px-6 py-3 text-white hover:text-white/90">Kontak Publik</a>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-3 text-center">
                    <div class="rounded-2xl border border-white/20 bg-white/10 px-6 py-5 shadow-lg backdrop-blur">
                        <p class="text-xs uppercase tracking-[0.3em] text-indigo-100/70">Pengunjung</p>
                        <p class="mt-2 text-2xl font-semibold">2.394</p>
                        <p class="text-xs text-emerald-200">↑ 6.8% vs minggu lalu</p>
                    </div>
                    <div class="rounded-2xl border border-white/20 bg-white/10 px-6 py-5 shadow-lg backdrop-blur">
                        <p class="text-xs uppercase tracking-[0.3em] text-indigo-100/70">Event Aktif</p>
                        <p class="mt-2 text-2xl font-semibold">4</p>
                        <p class="text-xs text-indigo-100/80">2 butuh kurasi konten</p>
                    </div>
                    <div class="rounded-2xl border border-white/20 bg-white/10 px-6 py-5 shadow-lg backdrop-blur">
                        <p class="text-xs uppercase tracking-[0.3em] text-indigo-100/70">UMKM</p>
                        <p class="mt-2 text-2xl font-semibold">1.439</p>
                        <p class="text-xs text-indigo-100/80">87% melengkapi profil</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($stats as $stat)
                <x-admin.stat-card
                    :label="$stat['label']"
                    :value="$stat['value']"
                    :description="$stat['description']"
                    :trend="$stat['trend']"
                    trend-label="Perbandingan vs minggu lalu"
                    :icon="$stat['icon']"
                />
            @endforeach
        </div>

        <div class="grid gap-6 xl:grid-cols-3">
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">
                <header class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Status Konten Publik</h2>
                        <p class="text-sm text-slate-500">Pantau halaman publik yang akan ditampilkan ke pengunjung.</p>
                    </div>
                    <a href="{{ route('admin.home.index') }}" class="btn-secondary px-4 py-2">Kelola konten</a>
                </header>

                <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">
                            <tr>
                                <th class="px-5 py-3">Bagian</th>
                                <th class="px-5 py-3">Status</th>
                                <th class="px-5 py-3">Pemutakhiran</th>
                                <th class="px-5 py-3">Penanggung jawab</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                            @foreach ($publicSections as $section)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="px-5 py-3 font-semibold text-slate-900">{{ $section['name'] }}</td>
                                    <td class="px-5 py-3">
                                        @php
                                            $statusColors = [
                                                'Tayang' => 'bg-emerald-100 text-emerald-700',
                                                'Draf' => 'bg-slate-100 text-slate-700',
                                                'Perlu review' => 'bg-amber-100 text-amber-700',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $statusColors[$section['status']] ?? 'bg-slate-100 text-slate-700' }}">
                                            {{ $section['status'] }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-slate-500">{{ $section['last_update'] }}</td>
                                    <td class="px-5 py-3">
                                        <span class="inline-flex items-center gap-2 text-sm font-medium text-slate-700">
                                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-xs font-semibold text-indigo-600">
                                                {{ strtoupper(substr($section['owner'], 0, 2)) }}
                                            </span>
                                            {{ $section['owner'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <header class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Aktivitas Hari Ini</h2>
                        <p class="text-sm text-slate-500">Rencana kerja tim pengelola.</p>
                    </div>
                    <button type="button" class="btn-secondary px-3 py-2 text-xs">Tandai selesai</button>
                </header>

                <ol class="mt-6 space-y-5 text-sm text-slate-600">
                    @foreach ($timeline as $item)
                        <li class="relative border-l border-slate-200 pl-5">
                            <span class="absolute -left-[9px] top-1 h-3 w-3 rounded-full border border-white bg-indigo-500"></span>
                            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">{{ $item['time'] }}</p>
                            <p class="mt-1 text-base font-semibold text-slate-900">{{ $item['title'] }}</p>
                            <p class="mt-1 leading-relaxed text-slate-600">{{ $item['description'] }}</p>
                            <p class="mt-2 text-xs font-medium text-slate-400">Oleh {{ $item['author'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </section>
        </div>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Checklist Publikasi</h2>
                    <p class="text-sm text-slate-500">Langkah yang perlu dipenuhi sebelum konten tampil di halaman publik.</p>
                </div>
                <button type="button" class="btn-primary px-4 py-2">Buat tugas baru</button>
            </header>

            <div class="mt-5 grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h3 class="text-sm font-semibold text-indigo-600">Pratinjau Konten</h3>
                    <p class="mt-2 text-sm text-slate-600">Gunakan mode pratinjau untuk memastikan layout komponen publik tampil konsisten di perangkat mobile.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h3 class="text-sm font-semibold text-emerald-600">Validasi Data Harga</h3>
                    <p class="mt-2 text-sm text-slate-600">Konfirmasi ulang tarif fasilitas sebelum melakukan publikasi agar sinkron dengan loket offline.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h3 class="text-sm font-semibold text-amber-600">Sinkronisasi Media</h3>
                    <p class="mt-2 text-sm text-slate-600">Pastikan aset galeri resolusi tinggi dioptimasi sebelum diunggah agar tidak memperlambat laman publik.</p>
                </div>
            </div>
        </section>

        <div class="grid gap-6 lg:grid-cols-[1.4fr_0.6fr]">
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Status Sistem Operasional</h2>
                <div class="mt-6 space-y-5">
                    @foreach ($systemStatus as $status)
                        <div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">{{ $status['label'] }}</p>
                                    <p class="text-sm text-slate-500">{{ $status['note'] }}</p>
                                </div>
                                <span class="text-sm font-semibold text-indigo-600">{{ $status['value'] }}</span>
                            </div>
                            <div class="meter mt-3">
                                <span class="meter__fill" style="width: {{ $status['percent'] }}%;"></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Backlog Prioritas</h2>
                <ul class="mt-4 space-y-4">
                    @foreach ($backlog as $task)
                        <li class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-900">{{ $task['title'] }}</p>
                            <p class="mt-1 text-xs uppercase tracking-[0.3em] text-slate-500">{{ $task['owner'] }} • {{ $task['eta'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
@endsection
