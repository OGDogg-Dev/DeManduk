<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Admin\Concerns\StoresMedia;
use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SlideController extends Controller
{
    use StoresMedia;

    public function index(): View
    {
        $slides = HomeSlide::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.home.slides.index', compact('slides'));
    }

    public function create(): View
    {
        return view('admin.home.slides.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request, false);
        $slide = new HomeSlide();
        $this->persistSlide($slide, $data, $request);

        return redirect()->route('admin.home.slides.index')
            ->with('status', 'Slide berhasil ditambahkan.');
    }

    public function edit(HomeSlide $slide): View
    {
        return view('admin.home.slides.edit', compact('slide'));
    }

    public function update(Request $request, HomeSlide $slide): RedirectResponse
    {
        $data = $this->validatedData($request, true);
        $this->persistSlide($slide, $data, $request);

        return redirect()->route('admin.home.slides.index')
            ->with('status', 'Slide berhasil diperbarui.');
    }

    public function destroy(HomeSlide $slide): RedirectResponse
    {
        $this->deleteStoredFile($slide->image_path);
        $slide->delete();

        return redirect()->route('admin.home.slides.index')
            ->with('status', 'Slide berhasil dihapus.');
    }

    private function validatedData(Request $request, bool $isUpdate): array
    {
        return $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cta_label' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => [$isUpdate ? 'nullable' : 'required', 'image', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
        ]);
    }

    private function persistSlide(HomeSlide $slide, array $data, Request $request): void
    {
        $removeImage = ! empty($data['remove_image']);
        unset($data['remove_image']);

        $imagePath = $slide->image_path;
        if ($removeImage && $imagePath) {
            $this->deleteStoredFile($imagePath);
            $imagePath = null;
        }

        if ($request->hasFile('image')) {
            $imagePath = $this->storeUploadedFile($request, 'image', 'home/slides', $slide->image_path);
        }

        unset($data['image']);

        $data['sort_order'] = isset($data['sort_order']) && $data['sort_order'] !== null
            ? (int) $data['sort_order']
            : 0;

        $slide->fill(array_merge(
            $data,
            ['image_path' => $imagePath]
        ));

        $slide->save();
    }
}
