<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomePricingRow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PricingRowController extends Controller
{
    public function index(): View
    {
        $pricing = HomePricingRow::query()
            ->orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.home.pricing.index', compact('pricing'));
    }

    public function create(): View
    {
        return view('admin.home.pricing.create');
    }

    public function store(Request $request): RedirectResponse
    {
        HomePricingRow::create($this->validatedData($request));

        return redirect()->route('admin.home.pricing.index')
            ->with('status', 'Data harga berhasil ditambahkan.');
    }

    public function edit(HomePricingRow $pricing): View
    {
        return view('admin.home.pricing.edit', compact('pricing'));
    }

    public function update(Request $request, HomePricingRow $pricing): RedirectResponse
    {
        $pricing->update($this->validatedData($request));

        return redirect()->route('admin.home.pricing.index')
            ->with('status', 'Data harga berhasil diperbarui.');
    }

    public function destroy(HomePricingRow $pricing): RedirectResponse
    {
        $pricing->delete();

        return redirect()->route('admin.home.pricing.index')
            ->with('status', 'Data harga berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'category' => ['required', 'in:ticket,facility'],
            'label' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}
