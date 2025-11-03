@extends('layouts.app')

@section('content')
    <x-section
        title="Berita & Blog Waduk Manduk"
        subtitle="Ikuti kabar perkembangan terbaru, kisah komunitas, dan panduan wisata untuk menyiapkan perjalanan Anda."
    >
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr]">
            <div class="space-y-6">
                @forelse ($posts as $post)
                    @php
                        $cover = \App\Support\Media::url($post->cover_image) ?? Vite::asset('resources/images/blog-placeholder.svg');
                        $dateLabel = optional($post->published_at)->translatedFormat('d F Y');
                        $readTimeLabel = $post->read_time_minutes ? $post->read_time_minutes . ' menit baca' : null;
                    @endphp
                    <x-blog.post-card
                        :title="$post->title"
                        :excerpt="$post->excerpt"
                        :href="route('news.show', $post)"
                        :image="$cover"
                        :date="$dateLabel"
                        :read-time="$readTimeLabel"
                        :author="$post->author"
                        :category="$post->category"
                        :tags="$post->tags ?? []"
                    />
                @empty
                    <x-blog.empty-state />
                @endforelse

                @if ($posts->hasPages())
                    <div class="pt-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
            <x-blog.sidebar
                :categories="$categoryFilters"
                :tags="$tagFilters"
                :recent-posts="$recentPosts"
                :search-action="route('news.index')"
                :search-query="$searchQuery"
            />
        </div>
    </x-section>
@endsection

