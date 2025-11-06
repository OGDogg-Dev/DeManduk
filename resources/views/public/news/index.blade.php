@extends('layouts.app', [
    'title' => 'Berita & Blog Waduk Manduk',
    'description' => 'Ikuti kabar perkembangan terbaru, kisah komunitas, dan panduan wisata dari Waduk Manduk.',
])

@section('content')
    @php
        use Illuminate\Support\Facades\Route;

        // Helper bikin URL show, aman untuk {news}
        $makeShowUrl = function ($item) {
            if (! Route::has('news.show')) {
                return '#';
            }

            // Jika Eloquent model → biarkan Laravel pakai route key (slug/id)
            if ($item instanceof \Illuminate\Database\Eloquent\Model) {
                try {
                    return route('news.show', $item);
                } catch (\Throwable $e) {
                    // fallthrough ke slug/id
                }
            }

            $slug = data_get($item, 'slug');
            $id   = data_get($item, 'id');
            $param = $slug ?: $id;

            // HARUS bernama 'news' karena URI: berita/{news}
            return $param ? route('news.show', ['news' => $param]) : '#';
        };

        // Sidebar: Recent posts → mapping jadi array untuk <x-blog.sidebar>
        $recentItems = collect($recentPosts ?? [])
            ->map(function ($p) use ($makeShowUrl) {
                $param = data_get($p, 'slug') ?: data_get($p, 'id');
                $arr = [
                    'title' => data_get($p, 'title', 'Artikel'),
                    'image' => \App\Support\Media::url(data_get($p, 'cover_image'))
                               ?: Vite::asset('resources/images/blog-placeholder.svg'),
                    'date'  => optional(data_get($p, 'published_at'))?->translatedFormat('d F Y')
                               ?: data_get($p, 'published_at'),
                    'href'  => $makeShowUrl($p),
                ];
                // Hanya isi 'slug' jika benar-benar ada param valid (hindari UrlGenerationException di komponen)
                if ($param) {
                    $arr['slug'] = $param;
                }
                return $arr;
            })
            ->values()
            ->all();

        $searchQuery     = $searchQuery ?? request('q');
        $categoryFilters = $categoryFilters ?? [];
        $tagFilters      = $tagFilters ?? [];
    @endphp

    <x-section
        title="Berita & Blog Waduk Manduk"
        subtitle="Ikuti kabar perkembangan terbaru, kisah komunitas, dan panduan wisata untuk menyiapkan perjalanan Anda."
    >
        <div class="grid grid-cols-1 gap-8 md:grid-cols-1 lg:grid-cols-[2fr_1fr]">
            <div class="space-y-6">
                @forelse ($posts as $post)
                    @php
                        $title         = data_get($post, 'title', 'Artikel');
                        $excerpt       = data_get($post, 'excerpt');
                        $cover         = \App\Support\Media::url(data_get($post, 'cover_image'))
                                           ?: Vite::asset('resources/images/blog-placeholder.svg');

                        $published     = data_get($post, 'published_at');
                        $dateLabel     = $published instanceof \Carbon\Carbon
                                            ? $published->translatedFormat('d F Y')
                                            : (is_string($published) ? $published : null);

                        $readTime      = data_get($post, 'read_time_minutes');
                        $readTimeLabel = $readTime ? $readTime.' menit baca' : null;

                        $author        = data_get($post, 'author');
                        $category      = data_get($post, 'category');

                        // tags bisa array / csv / null
                        $rawTags = data_get($post, 'tags', []);
                        $tags = is_string($rawTags)
                                ? collect(explode(',', $rawTags))->map(fn($t) => trim($t))->filter()->values()->all()
                                : (array) $rawTags;

                        $href = $makeShowUrl($post);
                    @endphp

                    <x-blog.post-card
                        :title="$title"
                        :excerpt="$excerpt"
                        :href="$href"
                        :image="$cover"
                        :date="$dateLabel"
                        :read-time="$readTimeLabel"
                        :author="$author"
                        :category="$category"
                        :tags="$tags"
                    />
                @empty
                    <x-blog.empty-state />
                @endforelse

                @if (is_object($posts ?? null) && method_exists($posts, 'hasPages') && $posts->hasPages())
                    <div class="pt-4">
                        {{ $posts->onEachSide(1)->links() }}
                    </div>
                @endif
            </div>

            <x-blog.sidebar
                :categories="$categoryFilters"
                :tags="$tagFilters"
                :recent-posts="$recentItems"
                :search-action="route('news.index')"
                :search-query="$searchQuery"
            />
        </div>
    </x-section>
@endsection
