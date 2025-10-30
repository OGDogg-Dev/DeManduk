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

<article class="flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
    <div class="aspect-[16/9] bg-slate-200">
        <img
            src="{{ $image }}"
            alt="{{ $title }}"
            loading="lazy"
            class="h-full w-full object-cover transition group-hover:scale-105"
        >
    </div>
    <div class="flex flex-1 flex-col gap-4 p-6">
        <div class="flex flex-wrap items-center gap-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
            @if ($category)
                <x-blog.category-chip :label="$category" :href="$href" />
            @endif
            <x-blog.post-meta :date="$date" :read-time="$readTime" :author="$author" />
        </div>
        <h3 class="text-2xl font-semibold text-slate-900">
            <a href="{{ $href }}" class="hover:text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                {{ $title }}
            </a>
        </h3>
        @if ($excerpt)
            <p class="text-sm leading-relaxed text-slate-600">
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
                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 transition hover:text-blue-700"
            >
                Baca selengkapnya
                <span aria-hidden="true">-></span>
            </a>
        </div>
    </div>
</article>
