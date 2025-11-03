@props([
    'categories' => [],
    'tags' => [],
    'recentPosts' => [],
    'searchAction' => null,
    'searchQuery' => null,
])

<aside class="space-y-8 text-slate-200">
    <div class="glass-card space-y-4 rounded-3xl p-6">
        <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300">Cari Artikel</h3>
        <x-blog.search-box :action="$searchAction ?? route('news.index')" :value="$searchQuery" />
    </div>
    <div class="glass-card space-y-4 rounded-3xl p-6">
        <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300">Kategori</h3>
        <div class="flex flex-wrap gap-2">
            @forelse ($categories as $category)
                <x-blog.category-chip :label="$category['label']" :href="$category['href'] ?? '#'" :active="$category['active'] ?? false" />
            @empty
                <p class="text-sm text-slate-400">Kategori akan ditampilkan di sini.</p>
            @endforelse
        </div>
    </div>
    <div class="glass-card space-y-4 rounded-3xl p-6">
        <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300">Tag Populer</h3>
        <div class="flex flex-wrap gap-2">
            @forelse ($tags as $tag)
                <x-blog.tag-chip :label="$tag['label'] ?? $tag" :href="$tag['href'] ?? '#'" />
            @empty
                <p class="text-sm text-slate-400">Tag akan diperbarui setelah CMS aktif.</p>
            @endforelse
        </div>
    </div>
    <div class="glass-card space-y-4 rounded-3xl p-6">
        <h3 class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300">Artikel Terbaru</h3>
        <ul class="space-y-4">
            @forelse ($recentPosts as $post)
                <li class="flex gap-3">
                    <div class="aspect-square h-16 w-16 overflow-hidden rounded-xl border border-white/10 bg-[#041f45]">
                        <img
                            src="{{ $post['image'] ?? Vite::asset('resources/images/blog-placeholder.svg') }}"
                            alt="{{ $post['title'] ?? 'Artikel Waduk Manduk' }}"
                            class="h-full w-full object-cover"
                            loading="lazy"
                        >
                    </div>
                    <div>
                        <a
                            href="{{ isset($post['slug']) ? route('news.show', $post['slug']) : ($post['href'] ?? '#') }}"
                            class="text-sm font-semibold text-white transition hover:text-amber-300"
                        >
                            {{ $post['title'] ?? 'Judul artikel' }}
                        </a>
                        <p class="text-xs text-slate-400">
                            {{ $post['date'] ?? 'Segera hadir' }}
                        </p>
                    </div>
                </li>
            @empty
                <p class="text-sm text-slate-400">Belum ada artikel terbaru.</p>
            @endforelse
        </ul>
    </div>
</aside>
