<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Support\Media;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $query = NewsPost::query()->published();

        $category = trim((string) $request->query('category', ''));
        $tag = trim((string) $request->query('tag', ''));
        $search = trim((string) $request->query('q', ''));

        if ($category !== '') {
            $query->where('category', $category);
        }

        if ($tag !== '') {
            $query->whereJsonContains('tags', $tag);
        }

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $posts = $query
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(9)
            ->withQueryString();

        $publishedQuery = NewsPost::published()->orderByDesc('published_at');

        $categories = (clone $publishedQuery)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        $allTags = (clone $publishedQuery)
            ->pluck('tags')
            ->filter()
            ->flatMap(function ($tags) {
                return collect($tags ?? []);
            })
            ->map(fn ($tag) => trim($tag))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $recentPosts = (clone $publishedQuery)
            ->limit(4)
            ->get()
            ->map(function (NewsPost $post) {
                return [
                    'title' => $post->title,
                    'date' => optional($post->published_at)->translatedFormat('d F Y'),
                    'slug' => $post->slug,
                    'image' => Media::url($post->cover_image),
                ];
            })
            ->values()
            ->all();

        $categoryFilters = collect([
            [
                'label' => 'Semua',
                'href' => route('news.index', array_filter([
                    'tag' => $tag ?: null,
                    'q' => $search ?: null,
                ])),
                'active' => $category === '',
            ],
        ])->merge($categories->map(function ($item) use ($tag, $search, $category) {
            return [
                'label' => $item,
                'href' => route('news.index', array_filter([
                    'category' => $item,
                    'tag' => $tag ?: null,
                    'q' => $search ?: null,
                ])),
                'active' => $category === $item,
            ];
        }))->all();

        $tagFilters = $allTags->map(function ($item) use ($category, $search) {
            return [
                'label' => $item,
                'href' => route('news.index', array_filter([
                    'tag' => $item,
                    'category' => $category ?: null,
                    'q' => $search ?: null,
                ])),
            ];
        })->all();

        return view('public.news.index', [
            'posts' => $posts,
            'categoryFilters' => $categoryFilters,
            'tagFilters' => $tagFilters,
            'recentPosts' => $recentPosts,
            'searchQuery' => $search,
            'activeCategory' => $category,
            'activeTag' => $tag,
        ]);
    }

    public function show(NewsPost $news): View
    {
        abort_unless($news->published_at, 404);

        $relatedQuery = NewsPost::published()
            ->where('id', '!=', $news->id);

        if ($news->category) {
            $relatedQuery->where('category', $news->category);
        }

        $related = $relatedQuery
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('public.news.show', [
            'post' => $news,
            'relatedPosts' => $related,
        ]);
    }
}
