<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeStat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatController extends Controller
{
    public function index(): View
    {
        $stats = HomeStat::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.home.stats.index', compact('stats'));
    }

    public function create(): View
    {
        return view('admin.home.stats.create');
    }

    public function store(Request $request): RedirectResponse
    {
        HomeStat::create($this->validatedData($request));

        return redirect()->route('admin.home.stats.index')
            ->with('status', 'Statistik berhasil ditambahkan.');
    }

    public function edit(HomeStat $stat): View
    {
        return view('admin.home.stats.edit', compact('stat'));
    }

    public function update(Request $request, HomeStat $stat): RedirectResponse
    {
        $stat->update($this->validatedData($request));

        return redirect()->route('admin.home.stats.index')
            ->with('status', 'Statistik berhasil diperbarui.');
    }

    public function destroy(HomeStat $stat): RedirectResponse
    {
        $stat->delete();

        return redirect()->route('admin.home.stats.index')
            ->with('status', 'Statistik berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}
