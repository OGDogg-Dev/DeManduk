@extends('layouts.app')

@section('content')
    @php
        $posts = [
            [
                'title' => 'Launching Dermaga Kayu & Area Santai Baru',
                'slug' => 'launching-dermaga-kayu',
                'excerpt' => 'Dermaga kayu berlapis anti slip dan kursi santai siap menyambut wisatawan jelang libur akhir tahun.',
                'date' => '12 Oktober 2025',
                'readTime' => '4 menit baca',
                'author' => 'Tim Redaksi Manduk',
                'category' => 'Pengembangan',
                'tags' => ['Fasilitas', 'Infrastruktur'],
            ],
            [
                'title' => 'UMKM Kuliner Manduk Resmi Bersertifikasi Halal',
                'slug' => 'umkm-kuliner-manduk-resmi-bersertifikasi-halal',
                'excerpt' => 'Sebanyak 30 pelaku UMKM berhasil mengantongi sertifikat halal untuk meningkatkan kepercayaan pengunjung.',
                'date' => '4 Oktober 2025',
                'readTime' => '3 menit baca',
                'author' => 'Diskominfo Lamongan',
                'category' => 'UMKM',
                'tags' => ['Kuliner', 'UMKM'],
            ],
            [
                'title' => 'Tips Menikmati Waduk Manduk Saat Musim Hujan',
                'slug' => 'tips-menikmati-waduk-manduk-saat-musim-hujan',
                'excerpt' => 'Kenali rute alternatif, waktu terbaik, dan fasilitas indoor yang nyaman bagi keluarga.',
                'date' => '27 September 2025',
                'readTime' => '5 menit baca',
                'author' => 'Tim Redaksi Manduk',
                'category' => 'Tips Wisata',
                'tags' => ['Panduan', 'Cuaca'],
            ],
        ];

        $categories = [
            ['label' => 'Semua', 'href' => '#', 'active' => true],
            ['label' => 'Pengembangan', 'href' => '#'],
            ['label' => 'UMKM', 'href' => '#'],
            ['label' => 'Tips Wisata', 'href' => '#'],
        ];

        $tags = [
            ['label' => 'Fasilitas'],
            ['label' => 'Agenda'],
            ['label' => 'Kuliner'],
            ['label' => 'Konservasi'],
        ];

        $recentPosts = [
            ['title' => 'Kolaborasi Komunitas Bersih Waduk', 'date' => '22 September 2025', 'slug' => 'kolaborasi-komunitas-bersih-waduk'],
            ['title' => 'Cerita Pemandu Wisata Manduk', 'date' => '18 September 2025', 'slug' => 'cerita-pemandu-wisata-manduk'],
            ['title' => 'Peresmian Studio Podcast UMKM', 'date' => '10 September 2025', 'slug' => 'peresmian-studio-podcast-umkm'],
        ];
    @endphp

    <x-section
        title="Berita & Blog Waduk Manduk"
        subtitle="Ikuti kabar perkembangan terbaru, kisah komunitas, dan panduan wisata untuk menyiapkan perjalanan Anda."
    >
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr]">
            <div class="space-y-6">
                @forelse ($posts as $post)
                    <x-blog.post-card
                        :title="$post['title']"
                        :excerpt="$post['excerpt']"
                        :date="$post['date']"
                        :read-time="$post['readTime']"
                        :author="$post['author']"
                        :category="$post['category']"
                        :tags="$post['tags']"
                        :href="route('blog.show', $post['slug'])"
                    />
                @empty
                    <x-blog.empty-state />
                @endforelse
                <x-blog.pagination :current="1" :total="3" />
            </div>
            <x-blog.sidebar
                :categories="$categories"
                :tags="$tags"
                :recent-posts="$recentPosts"
            />
        </div>
    </x-section>
@endsection
