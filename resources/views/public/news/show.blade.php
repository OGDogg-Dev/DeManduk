@extends('layouts.app')

@section('content')
    @php
        $dateLabel = optional($post->published_at)->translatedFormat('d F Y');
        $readTimeLabel = $post->read_time_minutes ? $post->read_time_minutes . ' menit baca' : null;
        $coverUrl = \App\Support\Media::url($post->cover_image);
    @endphp

    <x-section
        :title="$post->title"
        :subtitle="$post->excerpt"
    >
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr]">
            <article class="glass-card space-y-6 rounded-3xl p-8 text-slate-200 shadow-2xl">
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
                            loading="lazy"
                            class="w-full object-cover"
                        >
                    </figure>
                @endif

                <div class="prose prose-invert max-w-none">
                    {!! nl2br(e($post->body ?? 'Konten berita akan diperbarui segera.')) !!}
                </div>

                @if (! empty($post->tags))
                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->tags as $tag)
                            <x-blog.tag-chip :label="$tag" :href="route('news.index', ['tag' => $tag])" />
                        @endforeach
                    </div>
                @endif
            </article>

            <aside class="glass-card space-y-6 rounded-3xl p-6 text-slate-200 shadow-2xl">
                <h3 class="text-base font-semibold text-white">Informasi artikel</h3>
                <dl class="space-y-3 text-sm text-slate-200">
                    @if ($post->category)
                        <div>
                            <dt class="font-semibold text-white">Kategori</dt>
                            <dd>{{ $post->category }}</dd>
                        </div>
                    @endif
                    @if ($post->author)
                        <div>
                            <dt class="font-semibold text-white">Penulis</dt>
                            <dd>{{ $post->author }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="font-semibold text-white">Tanggal terbit</dt>
                        <dd>{{ $dateLabel ?? 'Segera diumumkan' }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-white">Durasi baca</dt>
                        <dd>{{ $readTimeLabel ?? 'sekitar 3 menit' }}</dd>
                    </div>
                </dl>

                <x-blog.share />

                @if ($relatedPosts->isNotEmpty())
                    <div class="space-y-3">
                        <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300">Artikel terkait</h3>
                        <ul class="space-y-2 text-sm text-amber-300">
                            @foreach ($relatedPosts as $related)
                                <li>
                                    <a href="{{ route('news.show', $related) }}" class="hover:underline">
                                        {{ $related->title }}
                                    </a>
                                    <span class="block text-xs text-slate-400">
                                        {{ optional($related->published_at)->translatedFormat('d F Y') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a
                    href="{{ route('news.index') }}"
                    class="inline-flex items-center gap-2 rounded-full bg-amber-400 px-4 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-[#021024] transition hover:bg-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-200 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]"
                >
                    <- Kembali ke daftar berita
                </a>
            </aside>
        </div>
    </x-section>
@endsection
