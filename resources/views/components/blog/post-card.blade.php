@props([
    'title',
    'excerpt' => null,
    'href' => '#',
    'image' => Vite::asset('resources/images/blog-placeholder.svg'),
    'date' => null,
    'readTime' => null,
    'author' => null,
    'category' => null,
    'tags' => [],
])

<article class="group flex flex-col overflow-hidden rounded-3xl border border-white/15 bg-[#031838]/80 shadow-[0_26px_60px_-28px_rgba(5,23,63,0.8)] backdrop-blur transition hover:-translate-y-1 hover:shadow-2xl">
    <div class="aspect-[16/9] bg-[#041f45]">
        <img
            src="{{ $image }}"
            alt="{{ $title }}"
            loading="lazy"
            class="h-full w-full object-cover transition duration-500 group-hover:scale-105 group-hover:opacity-90"
        >
    </div>
    <div class="flex flex-1 flex-col gap-4 p-6">
        <div class="flex flex-wrap items-center gap-3 text-xs font-semibold uppercase tracking-[0.3em] text-slate-300">
            @if ($category)
                <x-blog.category-chip :label="$category" :href="$href" />
            @endif
            <x-blog.post-meta :date="$date" :read-time="$readTime" :author="$author" />
        </div>
        <h3 class="text-2xl font-semibold text-white">
            <a href="{{ $href }}" class="hover:text-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#031838]">
                {{ $title }}
            </a>
        </h3>
        @if ($excerpt)
            <p class="text-sm leading-relaxed text-slate-300">
                {{ $excerpt }}
            </p>
        @endif
        @if ($tags)
            <div class="flex flex-wrap gap-2">
                @foreach ($tags as $tag)
                    <x-blog.tag-chip :label="$tag" :href="$href" />
                @endforeach
            </div>
        @endif
        <div class="mt-auto pt-4">
            <a
                href="{{ $href }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-amber-300 transition hover:text-amber-200"
            >
                Baca selengkapnya
                <span aria-hidden="true">-></span>
            </a>
        </div>
    </div>
</article>
