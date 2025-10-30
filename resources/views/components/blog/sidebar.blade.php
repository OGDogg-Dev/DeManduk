@props([
    'categories' => [],
    'tags' => [],
    'recentPosts' => [],
])

<aside class="space-y-10">
    <div class="space-y-4">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Cari Artikel</h3>
        <x-blog.search-box />
    </div>
    <div class="space-y-4">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Kategori</h3>
        <div class="flex flex-wrap gap-2">
            @forelse ($categories as $category)
                <x-blog.category-chip :label="$category['label']" :href="$category['href'] ?? '#'" :active="$category['active'] ?? false" />
            @empty
                <p class="text-sm text-slate-500">Kategori akan ditampilkan di sini.</p>
            @endforelse
        </div>
    </div>
    <div class="space-y-4">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Tag Populer</h3>
        <div class="flex flex-wrap gap-2">
            @forelse ($tags as $tag)
                <x-blog.tag-chip :label="$tag['label'] ?? $tag" :href="$tag['href'] ?? '#'" />
            @empty
                <p class="text-sm text-slate-500">Tag akan diperbarui setelah CMS aktif.</p>
            @endforelse
        </div>
    </div>
    <div class="space-y-4">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Artikel Terbaru</h3>
        <ul class="space-y-4">
            @forelse ($recentPosts as $post)
                <li class="flex gap-3">
                    <div class="aspect-square h-16 w-16 overflow-hidden rounded-xl bg-slate-200">
                        <img
                            src="{{ $post['image'] ?? Vite::asset('resources/images/blog-placeholder.svg') }}"
                            alt="{{ $post['title'] ?? 'Artikel Waduk Manduk' }}"
                            class="h-full w-full object-cover"
                            loading="lazy"
                        >
                    </div>
                    <div>
                        <a
                            href="{{ isset($post['slug']) ? route('blog.show', $post['slug']) : ($post['href'] ?? '#') }}"
                            class="text-sm font-semibold text-slate-800 transition hover:text-blue-600"
                        >
                            {{ $post['title'] ?? 'Judul artikel' }}
                        </a>
                        <p class="text-xs text-slate-500">
                            {{ $post['date'] ?? 'Segera hadir' }}
                        </p>
                    </div>
                </li>
            @empty
                <p class="text-sm text-slate-500">Belum ada artikel terbaru.</p>
            @endforelse
        </ul>
    </div>
</aside>
