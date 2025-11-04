@props([
    'categories'   => [],
    'tags'         => [],
    'recentPosts'  => [],
    'searchAction' => null,
    'searchQuery'  => null,
])

@php
  $searchAction = $searchAction ?? route('news.index');

  // Normalisasi recent posts: dukung {slug|href,title,image,date}
  $posts = collect($recentPosts)->map(function ($p) {
      $title = $p['title'] ?? 'Judul artikel';
      $img   = $p['image'] ?? Vite::asset('resources/images/blog-placeholder.svg');
      $date  = $p['date'] ?? null;
      $href  = isset($p['slug']) ? route('news.show', $p['slug']) : ($p['href'] ?? '#');
      return compact('title','img','date','href');
  })->all();
@endphp

<aside class="space-y-8" aria-label="Sidebar blog">
  {{-- Cari Artikel --}}
  <section class="card ring-subtle rounded-[20px] p-6 space-y-4">
    <h3 class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">
      Cari Artikel
    </h3>
    <x-blog.search-box :action="$searchAction" :value="$searchQuery" />
  </section>

  {{-- Kategori --}}
  <section class="card ring-subtle rounded-[20px] p-6 space-y-4">
    <h3 class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">
      Kategori
    </h3>
    <div class="flex flex-wrap gap-2">
      @forelse ($categories as $category)
        @php
          $label  = is_array($category) ? ($category['label'] ?? $category['name'] ?? '') : $category;
          $href   = is_array($category) ? ($category['href'] ?? '#') : '#';
          $active = is_array($category) ? (bool)($category['active'] ?? false) : false;
        @endphp
        <x-blog.category-chip :label="$label" :href="$href" :active="$active" />
      @empty
        <p class="text-sm text-[var(--color-muted)]">Kategori akan ditampilkan di sini.</p>
      @endforelse
    </div>
  </section>

  {{-- Tag Populer --}}
  <section class="card ring-subtle rounded-[20px] p-6 space-y-4">
    <h3 class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">
      Tag Populer
    </h3>
    <div class="flex flex-wrap gap-2">
      @forelse ($tags as $tag)
        @php
          $tLabel = is_array($tag) ? ($tag['label'] ?? $tag['name'] ?? '') : $tag;
          $tHref  = is_array($tag) ? ($tag['href'] ?? '#') : '#';
        @endphp
        <x-blog.tag-chip :label="$tLabel" :href="$tHref" />
      @empty
        <p class="text-sm text-[var(--color-muted)]">Tag akan diperbarui setelah CMS aktif.</p>
      @endforelse
    </div>
  </section>

  {{-- Artikel Terbaru --}}
  <section class="card ring-subtle rounded-[20px] p-6 space-y-4">
    <h3 class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--color-muted)]">
      Artikel Terbaru
    </h3>
    <ul class="space-y-4">
      @forelse ($posts as $post)
        <li class="flex gap-3">
          <figure class="aspect-square h-16 w-16 overflow-hidden rounded-xl ring-1 ring-[var(--color-border)] bg-slate-100">
            <img
              src="{{ $post['img'] }}"
              alt="{{ $post['title'] }}"
              class="h-full w-full object-cover"
              loading="lazy"
            >
          </figure>
          <div>
            <a
              href="{{ $post['href'] }}"
              class="text-sm font-semibold text-[var(--color-ink)] hover:text-[var(--color-primary)]"
            >
              {{ $post['title'] }}
            </a>
            @if ($post['date'])
              <p class="text-xs text-[var(--color-muted)]">{{ $post['date'] }}</p>
            @endif
          </div>
        </li>
      @empty
        <p class="text-sm text-[var(--color-muted)]">Belum ada artikel terbaru.</p>
      @endforelse
    </ul>
  </section>
</aside>
