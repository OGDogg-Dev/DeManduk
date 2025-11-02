<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeFeature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeatureController extends Controller
{
    public function index(): View
    {
        $features = HomeFeature::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.home.features.index', compact('features'));
    }

    public function create(): View
    {
        return view('admin.home.features.create');
    }

    public function store(Request $request): RedirectResponse
    {
        HomeFeature::create($this->validatedData($request));

        return redirect()->route('admin.home.features.index')
            ->with('status', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(HomeFeature $feature): View
    {
        return view('admin.home.features.edit', compact('feature'));
    }

    public function update(Request $request, HomeFeature $feature): RedirectResponse
    {
        $feature->update($this->validatedData($request));

        return redirect()->route('admin.home.features.index')
            ->with('status', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(HomeFeature $feature): RedirectResponse
    {
        $feature->delete();

        return redirect()->route('admin.home.features.index')
            ->with('status', 'Fasilitas berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}
