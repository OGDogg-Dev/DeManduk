@extends('layouts.admin', ['title' => 'Dasbor'])

@php
    $stats = [
        [
            'label' => 'Total Kunjungan Bulan Ini',
            'value' => '2.394',
            'description' => 'Naik dibanding bulan lalu setelah promosi di media sosial.',
            'trend' => 6.8,
            'icon' => 'chart-bar',
            'color' => 'indigo',
        ],
        [
            'label' => 'Event Mendatang',
            'value' => '4',
            'description' => 'Event komunitas yang butuh kurasi konten front page.',
            'trend' => 2.5,
            'icon' => 'calendar',
            'color' => 'emerald',
        ],
        [
            'label' => 'UMKM Terdaftar',
            'value' => '1.439',
            'description' => 'Bisa dikelompokkan ulang untuk katalog kuliner publik.',
            'trend' => 0.0,
            'icon' => 'building-storefront',
            'color' => 'amber',
        ],
        [
            'label' => 'Tiket QRIS Tervalidasi',
            'value' => '982',
            'description' => 'Transaksi daring sejak uji coba bulan Oktober.',
            'trend' => 11.4,
            'icon' => 'credit-card',
            'color' => 'rose',
        ],
    ];

    $publicSections = [
        [
            'name' => 'Beranda',
            'status' => 'Tayang',
            'last_update' => '2 hari lalu',
            'owner' => 'Admin Desa',
            'url' => route('home'),
        ],
        [
            'name' => 'Profil & Sejarah',
            'status' => 'Draf',
            'last_update' => '5 hari lalu',
            'owner' => 'Tim Narasi',
            'url' => '#',
        ],
        [
            'name' => 'Agenda Event',
            'status' => 'Perlu review',
            'last_update' => '1 hari lalu',
            'owner' => 'Pokdarwis',
            'url' => route('event.index'),
        ],
        [
            'name' => 'Galeri Media',
            'status' => 'Tayang',
            'last_update' => '4 jam lalu',
            'owner' => 'Tim Dokumentasi',
            'url' => route('galeri'),
        ],
    ];

    $timeline = [
        [
            'time' => '08.40',
            'title' => 'Perbarui hero carousel',
            'description' => 'Tambahkan foto festival lampion ke slider utama.',
            'author' => 'Admin Desa',
            'status' => 'completed',
        ],
        [
            'time' => '10.15',
            'title' => 'Review konten FAQ',
            'description' => 'Pastikan informasi tiket online sudah menampilkan jadwal beta.',
            'author' => 'Tim Narasi',
            'status' => 'in-progress',
        ],
        [
            'time' => '13.55',
            'title' => 'Unggah dokumentasi event',
            'description' => 'Upload 12 foto Manduk Fun Paddle ke galeri publik.',
            'author' => 'Tim Dokumentasi',
            'status' => 'pending',
        ],
    ];

    $systemStatus = [
        [
            'label' => 'Konten terisi',
            'value' => '87%',
            'note' => 'Section publik sudah terisi data',
            'percent' => 87,
            'icon' => 'document-text',
        ],
        [
            'label' => 'Validasi media',
            'value' => '12 / 20',
            'note' => 'Gambar beresolusi tinggi siap tayang',
            'percent' => 60,
            'icon' => 'photo',
        ],
        [
            'label' => 'Tautan sosial',
            'value' => '4 / 4',
            'note' => 'Akun media sosial terhubung ke footer',
            'percent' => 100,
            'icon' => 'share',
        ],
        [
            'label' => 'Tiket digital',
            'value' => '92%',
            'note' => 'QRIS digunakan pengunjung daring',
            'percent' => 92,
            'icon' => 'credit-card',
        ],
    ];

    $backlog = [
        ['title' => 'Review SOP & upload PDF terbaru', 'owner' => 'Sekretariat', 'eta' => 'Besok', 'priority' => 'high'],
        ['title' => 'Kurasi berita komunitas minggu ini', 'owner' => 'Tim Konten', 'eta' => '2 hari lagi', 'priority' => 'medium'],
        ['title' => 'Sinkronisasi event Desember', 'owner' => 'Pokdarwis', 'eta' => 'Jumat', 'priority' => 'low'],
    ];
    
    $quickActions = [
        ['label' => 'Tambah Event Baru', 'url' => route('admin.events.create'), 'icon' => 'calendar-plus', 'color' => 'indigo'],
        ['label' => 'Upload Galeri', 'url' => route('admin.gallery.create'), 'icon' => 'photo-plus', 'color' => 'emerald'],
        ['label' => 'Tambah Berita', 'url' => route('admin.news.create'), 'icon' => 'newspaper', 'color' => 'amber'],
        ['label' => 'Edit Kontak', 'url' => route('admin.pages.contact.settings.edit'), 'icon' => 'envelope-open', 'color' => 'rose'],
    ];
@endphp

@section('content')
    <div class="space-y-6">
        <!-- Welcome & Quick Stats -->
        <section class="rounded-2xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-500 p-6 text-white shadow-lg">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-indigo-100/80">Dashboard Utama</p>
                    <h1 class="text-2xl font-bold">Halo, Admin Desa!</h1>
                    <p class="max-w-xl text-sm text-indigo-100/90">
                        Pantau statistik utama dan akses cepat ke manajemen konten Waduk Manduk.
                    </p>
                </div>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                    @foreach ($stats as $index => $stat)
                        <div class="rounded-xl bg-white/10 p-4 text-center">
                            <div class="text-lg font-bold">{{ $stat['value'] }}</div>
                            <div class="mt-1 text-xs text-indigo-100/80">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Quick Actions -->
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <header class="mb-4">
                <h2 class="text-lg font-semibold text-slate-900">Akses Cepat</h2>
                <p class="text-sm text-slate-500">Kelola konten utama dengan satu klik.</p>
            </header>
            
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach ($quickActions as $action)
                    <a 
                        href="{{ $action['url'] }}" 
                        class="group flex flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50 p-4 transition-all hover:scale-105 hover:shadow-md"
                    >
                        <x-admin.icon 
                            :name="$action['icon']" 
                            class="h-6 w-6 text-{{ $action['color'] }}-600 mb-2" 
                        />
                        <span class="text-sm font-medium text-slate-700">{{ $action['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Main Grid -->
        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Public Content Status -->
            <section class="lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-slate-900">Status Konten Publik</h2>
                    <a href="{{ route('admin.home.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat semua</a>
                </div>
                
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Halaman</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Pemutakhiran</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($publicSections as $section)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-slate-900">{{ $section['name'] }}</div>
                                        <div class="text-xs text-slate-500">{{ $section['owner'] }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @php
                                            $statusColors = [
                                                'Tayang' => 'bg-emerald-100 text-emerald-800',
                                                'Draf' => 'bg-amber-100 text-amber-800',
                                                'Perlu review' => 'bg-blue-100 text-blue-800',
                                            ];
                                        @endphp
                                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusColors[$section['status']] ?? 'bg-slate-100 text-slate-800' }}">
                                            {{ $section['status'] }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-slate-500">{{ $section['last_update'] }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ $section['url'] }}" target="_blank" 
                                           class="inline-flex items-center gap-1 text-xs font-medium text-indigo-600 hover:text-indigo-900">
                                            Lihat
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Today's Activity -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-slate-900">Aktivitas Hari Ini</h2>
                    <button type="button" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Tandai semua</button>
                </div>
                
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-4">
                    <ol class="space-y-4">
                        @foreach ($timeline as $index => $item)
                            @php
                                $statusColor = [
                                    'completed' => 'text-emerald-600 bg-emerald-600',
                                    'in-progress' => 'text-amber-600 bg-amber-600',
                                    'pending' => 'text-slate-400 bg-slate-400',
                                ][$item['status']] ?? 'text-slate-400 bg-slate-400';
                            @endphp
                            
                            <li class="flex">
                                <div class="flex flex-col items-center mr-4">
                                    <div class="w-2 h-2 rounded-full {{ $statusColor }}"></div>
                                    @if (!$loop->last)
                                        <div class="w-0.5 h-full bg-slate-200 mt-2"></div>
                                    @endif
                                </div>
                                
                                <div class="flex-1 pb-2">
                                    <div class="flex justify-between">
                                        <span class="text-xs font-semibold text-slate-500">{{ $item['time'] }}</span>
                                        <span class="text-xs text-slate-400">Oleh {{ $item['author'] }}</span>
                                    </div>
                                    <p class="font-medium text-slate-900 mt-1">{{ $item['title'] }}</p>
                                    <p class="text-sm text-slate-500 mt-1">{{ $item['description'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>
        </div>

        <!-- System Status & Priority Tasks -->
        <div class="grid gap-6 lg:grid-cols-2">
            <!-- System Status -->
            <section>
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Status Sistem Operasional</h2>
                
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    @foreach ($systemStatus as $index => $status)
                        <div class="mb-5 last:mb-0">
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <x-admin.icon :name="$status['icon']" class="h-4 w-4 text-slate-500" />
                                        <span class="font-medium text-slate-900">{{ $status['label'] }}</span>
                                    </div>
                                    <p class="text-sm text-slate-500">{{ $status['note'] }}</p>
                                </div>
                                <span class="text-sm font-bold text-indigo-600">{{ $status['value'] }}</span>
                            </div>
                            
                            <div class="w-full bg-slate-200 rounded-full h-2">
                                <div 
                                    class="bg-indigo-600 h-2 rounded-full transition-all duration-500 ease-out" 
                                    style="width: {{ $status['percent'] }}%"
                                ></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Priority Backlog -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-slate-900">Tugas Prioritas</h2>
                    <button type="button" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Tambah tugas</button>
                </div>
                
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <ul class="space-y-4">
                        @foreach ($backlog as $task)
                            @php
                                $priorityColors = [
                                    'high' => 'border-l-red-500',
                                    'medium' => 'border-l-amber-500',
                                    'low' => 'border-l-green-500',
                                ];
                            @endphp
                            
                            <li class="border-l-4 {{ $priorityColors[$task['priority']] ?? 'border-l-slate-300' }} pl-4 py-2">
                                <p class="font-medium text-slate-900">{{ $task['title'] }}</p>
                                <div class="flex justify-between mt-1">
                                    <span class="text-xs text-slate-500">{{ $task['owner'] }}</span>
                                    <span class="text-xs font-semibold text-slate-600">{{ $task['eta'] }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
@endsection
