@extends('layouts.app', [
    'title' => $post->title,
    'description' => ($post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->body ?? ''), 160)),
    'image' => \App\Support\Media::url($post->cover_image) ?: asset('images/blog-placeholder.svg'),
])

@section('content')
    @php
        use Illuminate\Support\Str;

        $dateLabel      = optional($post->published_at)->translatedFormat('d F Y');
        $readTimeLabel  = $post->read_time_minutes ? $post->read_time_minutes . ' menit baca' : null;
        $coverUrl       = \App\Support\Media::url($post->cover_image) ?: asset('images/blog-placeholder.svg');

        // Normalisasi tags (string/array/collection → array of strings)
        $tags = collect($post->tags ?? [])
            ->when(is_string($post->tags ?? null), fn($c) => collect(explode(',', $post->tags)))
            ->map(fn($t) => trim(is_array($t) ? ($t['label'] ?? reset($t) ?? '') : $t))
            ->filter()->values()->all();
    @endphp

    {{-- Breadcrumb kecil --}}
    <nav aria-label="Breadcrumb" class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 mt-4">
        <ol class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.3em] text-[var(--color-muted)]">
            <li><a href="{{ route('home') }}" class="hover:text-[var(--color-primary)]">Beranda</a></li>
            <li aria-hidden="true">/</li>
            <li><a href="{{ route('news.index') }}" class="hover:text-[var(--color-primary)]">Berita</a></li>
            <li aria-hidden="true">/</li>
            <li class="text-[var(--color-ink)]">{{ Str::limit($post->title, 48) }}</li>
        </ol>
    </nav>

    <x-section :title="$post->title" :subtitle="$post->excerpt">
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr]">
            <article class="glass-card space-y-6 rounded-3xl p-8 text-[var(--color-ink)] shadow-2xl" itemscope itemtype="https://schema.org/BlogPosting">
                <meta itemprop="headline" content="{{ $post->title }}">
                <meta itemprop="datePublished" content="{{ optional($post->published_at)->toIso8601String() }}">
                <meta itemprop="dateModified" content="{{ optional($post->updated_at)->toIso8601String() }}">
                <meta itemprop="image" content="{{ $coverUrl }}">
                <meta itemprop="author" content="{{ $post->author ?? 'Tim D\'Manduk' }}">
                <meta itemprop="articleSection" content="{{ $post->category ?? 'Berita' }}">

                <x-blog.post-meta
                    :date="$dateLabel"
                    :read-time="$readTimeLabel"
                    :author="$post->author"
                />

                @if ($coverUrl)
                    <figure class="overflow-hidden rounded-3xl border border-white/15 bg-[#041f45] shadow-[0_26px_60px_-28px_rgba(5,23,63,0.8)]">
                        <img
                            src="{{ $coverUrl }}"
                            alt="{{ $post->title }}"
                            loading="eager"
                            class="w-full object-cover"
                            itemprop="image"
                        >
                    </figure>
                @endif

                {{-- Konten: dukung HTML siap pakai via body_html, fallback nl2br --}}
                <div class="prose prose-invert max-w-none" itemprop="articleBody">
                    @if (!empty($post->body_html))
                        {!! $post->body_html !!}
                    @else
                        {!! nl2br(e($post->body ?? 'Konten berita akan diperbarui segera.')) !!}
                    @endif
                </div>

                @if (! empty($tags))
                    <div class="flex flex-wrap gap-2">
                        @foreach ($tags as $tag)
                            <x-blog.tag-chip :label="$tag" :href="route('news.index', ['tag' => $tag])" />
                        @endforeach
                    </div>
                @endif

                {{-- Prev / Next opsional (siapkan $prevPost/$nextPost di controller jika perlu) --}}
                @if (isset($prevPost) || isset($nextPost))
                    <nav class="mt-6 flex items-center justify-between gap-3 text-sm" aria-label="Navigasi artikel">
                        <div class="min-w-0">
                            @isset($prevPost)
                                <a href="{{ route('news.show', $prevPost) }}"
                                   class="inline-flex items-center gap-2 rounded-xl border border-white/20 px-4 py-2 text-[var(--color-ink)] transition hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]">
                                    ← {{ Str::limit($prevPost->title, 48) }}
                                </a>
                            @endisset
                        </div>
                        <div class="min-w-0 text-right">
                            @isset($nextPost)
                                <a href="{{ route('news.show', $nextPost) }}"
                                   class="inline-flex items-center gap-2 rounded-xl border border-white/20 px-4 py-2 text-[var(--color-ink)] transition hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]">
                                    {{ Str::limit($nextPost->title, 48) }} →
                                </a>
                            @endisset
                        </div>
                    </nav>
                @endif
            </article>

            <aside class="glass-card space-y-6 rounded-3xl p-6 text-[var(--color-ink)] shadow-2xl">
                <h3 class="text-base font-semibold text-[var(--color-ink)]">Informasi artikel</h3>
                <dl class="space-y-3 text-sm text-[var(--color-ink)]">
                    @if ($post->category)
                        <div>
                            <dt class="font-semibold text-[var(--color-ink)]">Kategori</dt>
                            <dd>
                                <a href="{{ route('news.index', ['category' => $post->category]) }}" class="hover:text-[var(--color-primary)]">
                                    {{ $post->category }}
                                </a>
                            </dd>
                        </div>
                    @endif
                    @if ($post->author)
                        <div>
                            <dt class="font-semibold text-[var(--color-ink)]">Penulis</dt>
                            <dd>{{ $post->author }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="font-semibold text-[var(--color-ink)]">Tanggal terbit</dt>
                        <dd>{{ $dateLabel ?? 'Segera diumumkan' }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-[var(--color-ink)]">Durasi baca</dt>
                        <dd>{{ $readTimeLabel ?? 'sekitar 3 menit' }}</dd>
                    </div>
                </dl>

                <x-blog.share :url="route('news.show', $post)" />

                @if (!empty($relatedPosts) && $relatedPosts->isNotEmpty())
                    <div class="space-y-3">
                        <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">Artikel terkait</h3>
                        <ul class="space-y-2 text-sm text-[var(--color-primary)]">
                            @foreach ($relatedPosts as $related)
                                <li>
                                    <a href="{{ route('news.show', $related) }}" class="hover:underline">
                                        {{ $related->title }}
                                    </a>
                                    <span class="block text-xs text-[var(--color-muted)]">
                                        {{ optional($related->published_at)->translatedFormat('d F Y') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a
                    href="{{ route('news.index') }}"
                    class="inline-flex items-center gap-2 rounded-full bg-amber-400 px-4 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-[var(--color-ink)] transition hover:bg-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-200 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-bg)]"
                >
                    ← Kembali ke daftar berita
                </a>
            </aside>
        </div>
    </x-section>
@endsection

@push('head')
    {{-- Noindex untuk draft / unpublished --}}
    @if (method_exists($post, 'is_published') && ! $post->is_published)
        <meta name="robots" content="noindex,follow">
    @endif

    {{-- JSON-LD BlogPosting --}}
    @php
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => (string) $post->title,
            'datePublished' => optional($post->published_at)->toIso8601String(),
            'dateModified'  => optional($post->updated_at)->toIso8601String(),
            'author' => ['@type' => 'Person', 'name' => (string) ($post->author ?? "Tim D'Manduk")],
            'image' => [$coverUrl],
            'mainEntityOfPage' => route('news.show', $post),
            'articleSection' => (string) ($post->category ?? 'Berita'),
            'keywords' => implode(', ', $tags),
            'description' => (string) ($post->excerpt ?? Str::limit(strip_tags($post->body ?? ''), 160)),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
@endpush
