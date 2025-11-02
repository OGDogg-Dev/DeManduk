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
        $data = $this->validatedData($request);
        $data['image_path'] = $this->storeUploadedFile($request, 'image', 'home/slides');

        HomeSlide::create($data);

        return redirect()->route('admin.home.slides.index')
            ->with('status', 'Slide berhasil ditambahkan.');
    }

    public function edit(HomeSlide $slide): View
    {
        return view('admin.home.slides.edit', compact('slide'));
    }

    public function update(Request $request, HomeSlide $slide): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['image_path'] = $this->storeUploadedFile($request, 'image', 'home/slides', $slide->image_path);

        $slide->update($data);

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

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cta_label' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        unset($data['image']);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}
