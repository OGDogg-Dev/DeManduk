<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeGuide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class GuideController extends Controller
{
    public function index(): View
    {
        $guides = HomeGuide::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.home.guides.index', compact('guides'));
    }

    public function create(): View
    {
        return view('admin.home.guides.create');
    }

    public function store(Request $request): RedirectResponse
    {
        HomeGuide::create($this->validatedData($request));

        return redirect()->route('admin.home.guides.index')
            ->with('status', 'Panduan SOP berhasil ditambahkan.');
    }

    public function edit(HomeGuide $guide): View
    {
        return view('admin.home.guides.edit', compact('guide'));
    }

    public function update(Request $request, HomeGuide $guide): RedirectResponse
    {
        $guide->update($this->validatedData($request));

        return redirect()->route('admin.home.guides.index')
            ->with('status', 'Panduan SOP berhasil diperbarui.');
    }

    public function destroy(HomeGuide $guide): RedirectResponse
    {
        $guide->delete();

        return redirect()->route('admin.home.guides.index')
            ->with('status', 'Panduan SOP berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'items_text' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $items = Collection::make(preg_split("/\r?\n/", $data['items_text'] ?? ''))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();

        unset($data['items_text']);
        $data['items'] = $items;

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}
