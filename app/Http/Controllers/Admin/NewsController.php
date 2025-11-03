<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresMedia;
use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    use StoresMedia;

    public function index(): View
    {
        $posts = NewsPost::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('admin.news.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $post = new NewsPost();
        $data = $this->validatedData($request, $post);
        $this->persistPost($post, $data, $request);

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'Berita berhasil diterbitkan.');
    }

    public function edit(NewsPost $news): View
    {
        return view('admin.news.edit', ['post' => $news]);
    }

    public function update(Request $request, NewsPost $news): RedirectResponse
    {
        $data = $this->validatedData($request, $news);
        $this->persistPost($news, $data, $request);

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'Berita berhasil diperbarui.');
    }

    public function destroy(NewsPost $news): RedirectResponse
    {
        $this->deleteStoredFile($news->cover_image);
        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'Berita berhasil dihapus.');
    }

    private function validatedData(Request $request, ?NewsPost $post = null): array
    {
        if ($request->has('read_time_minutes') && $request->input('read_time_minutes') === '') {
            $request->merge(['read_time_minutes' => null]);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash'],
            'author' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'read_time_minutes' => ['nullable', 'integer', 'min:1', 'max:240'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'tags' => ['nullable', 'string'],
            'published_toggle' => ['nullable', 'boolean'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'remove_cover_image' => ['nullable', 'boolean'],
        ]);

        $slugSource = $data['slug'] ?? $data['title'];
        $data['slug'] = Str::slug($slugSource);

        $slugQuery = NewsPost::where('slug', $data['slug']);
        if ($post?->exists) {
            $slugQuery->where('id', '!=', $post->id);
        }
        if ($slugQuery->exists()) {
            $data['slug'] = Str::slug($data['slug'] . '-' . Str::random(4));
        }

        if (! empty($data['published_toggle'])) {
            $data['published_at'] = $post?->published_at ?? now();
        } else {
            $data['published_at'] = null;
        }

        $data['tags'] = Collection::make(explode(',', $data['tags'] ?? ''))
            ->map(fn ($tag) => trim($tag))
            ->filter()
            ->values()
            ->all();

        $data['remove_cover_image'] = ! empty($data['remove_cover_image']);

        unset($data['published_toggle']);

        return $data;
    }

    private function persistPost(NewsPost $post, array $data, Request $request): void
    {
        $coverImage = $post->cover_image;

        if ($data['remove_cover_image'] && $coverImage) {
            $this->deleteStoredFile($coverImage);
            $coverImage = null;
        }

        if ($request->hasFile('cover_image')) {
            $coverImage = $this->storeUploadedFile($request, 'cover_image', 'news', $post->cover_image);
        }

        unset($data['cover_image'], $data['remove_cover_image']);

        $post->fill($data + [
            'cover_image' => $coverImage,
        ]);

        if (! $post->exists) {
            $post->created_by = Auth::id();
        }
        $post->updated_by = Auth::id();

        $post->save();
    }
}
