<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresMedia;
use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GalleryController extends Controller
{
    use StoresMedia;

    public function index(): View
    {
        $items = GalleryItem::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(12);

        return view('admin.gallery.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request, false);

        $galleryItem = new GalleryItem();
        $this->persistGalleryItem($galleryItem, $data, $request);

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Item galeri berhasil ditambahkan.');
    }

    public function edit(GalleryItem $galleryItem): View
    {
        return view('admin.gallery.edit', ['galleryItem' => $galleryItem]);
    }

    public function update(Request $request, GalleryItem $galleryItem): RedirectResponse
    {
        $data = $this->validatedData($request, true);
        $this->persistGalleryItem($galleryItem, $data, $request);

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Item galeri berhasil diperbarui.');
    }

    public function destroy(GalleryItem $galleryItem): RedirectResponse
    {
        $this->deleteStoredFile($galleryItem->image_path);
        $galleryItem->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Item galeri berhasil dihapus.');
    }

    private function validatedData(Request $request, bool $isUpdate): array
    {
        $statuses = implode(',', [
            GalleryItem::STATUS_DRAFT,
            GalleryItem::STATUS_SUBMITTED,
            GalleryItem::STATUS_PUBLISHED,
        ]);

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'caption' => ['nullable', 'string'],
            'status' => ['nullable', "in:{$statuses}"],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => [$isUpdate ? 'nullable' : 'required', 'image', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
        ]);
    }

    private function persistGalleryItem(GalleryItem $galleryItem, array $data, Request $request): void
    {
        $status = $data['status'] ?? GalleryItem::STATUS_PUBLISHED;
        $sortOrder = isset($data['sort_order']) && $data['sort_order'] !== ''
            ? (int) $data['sort_order']
            : 0;

        $imagePath = $galleryItem->image_path;
        if (! empty($data['remove_image'])) {
            $this->deleteStoredFile($imagePath);
            $imagePath = null;
        }

        if ($request->hasFile('image')) {
            $imagePath = $this->storeUploadedFile($request, 'image', 'gallery', $galleryItem->image_path);
        }

        $publishedAt = $galleryItem->published_at;
        if ($status === GalleryItem::STATUS_PUBLISHED) {
            $publishedAt = $publishedAt ?? now();
        } else {
            $publishedAt = null;
        }

        $galleryItem->fill([
            'title' => $data['title'],
            'caption' => $data['caption'] ?? null,
            'status' => $status,
            'sort_order' => $sortOrder,
            'published_at' => $publishedAt,
        ]);

        $galleryItem->image_path = $imagePath;

        if (! $galleryItem->exists) {
            $galleryItem->created_by = Auth::id();
        }
        $galleryItem->updated_by = Auth::id();

        $galleryItem->save();
    }
}
