@props([
    'title',
    'excerpt'   => null,
    'href'      => '#',
    'image'     => asset('images/blog-placeholder.svg'),
    'date'      => null,
    'readTime'  => null,
    'author'    => null,
    'category'  => null,
    'tags'      => [],
])

@php
    $img = $image ?: asset('images/blog-placeholder.svg');
    $titleId = 'post-'.\Illuminate\Support\Str::slug($title ?? 'artikel').'-'.substr(md5(($href ?? '').($title ?? '')), 0, 6);
@endphp

<article
  class="group card ring-subtle overflow-hidden flex flex-col transition hover:-translate-y-0.5 hover:shadow-lg"
  aria-labelledby="{{ $titleId }}"
>
  {{-- Cover --}}
  <a href="{{ $href }}" class="relative block aspect-[16/9] bg-slate-100">
    <img
      src="{{ $img }}"
      alt="{{ $title ?? 'Gambar artikel' }}"
      loading="lazy"
      class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]"
    >
    <span class="sr-only">Buka artikel: {{ $title }}</span>
  </a>

  {{-- Body --}}
  <div class="flex flex-1 flex-col gap-3 p-5 sm:p-6">
    <div class="flex flex-wrap items-center gap-3 text-xs">
      @if ($category)
        <x-blog.category-chip :label="$category" :href="$href" />
      @endif
      <x-blog.post-meta :date="$date" :read-time="$readTime" :author="$author" />
    </div>

    <h3 id="{{ $titleId }}" class="text-xl sm:text-2xl font-semibold leading-snug text-[var(--color-ink)]">
      <a
        href="{{ $href }}"
        class="transition-colors hover:text-[var(--color-primary)] focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-surface)]"
      >
        {{ $title }}
      </a>
    </h3>

    @if ($excerpt)
      <p class="text-sm leading-7 text-[var(--color-muted)]">
        {{ $excerpt }}
      </p>
    @endif

    @if (!empty($tags))
      <div class="flex flex-wrap gap-2 pt-1">
        @foreach ($tags as $tag)
          @php
            $tLabel = is_array($tag) ? ($tag['label'] ?? $tag['name'] ?? '') : $tag;
            $tHref  = is_array($tag) ? ($tag['href'] ?? $href) : $href;
          @endphp
          <x-blog.tag-chip :label="$tLabel" :href="$tHref" />
        @endforeach
      </div>
    @endif

    <div class="mt-auto pt-3">
      <a href="{{ $href }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-[var(--color-primary)] hover:underline">
        Baca selengkapnya
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M5 12h14M13 5l7 7-7 7"/>
        </svg>
      </a>
    </div>
  </div>
</article>
