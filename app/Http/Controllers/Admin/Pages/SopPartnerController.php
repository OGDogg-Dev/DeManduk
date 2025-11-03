<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SopPartner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SopPartnerController extends Controller
{
    public function index(): View
    {
        $partners = SopPartner::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.pages.sop.partners.index', compact('partners'));
    }

    public function create(): View
    {
        return view('admin.pages.sop.partners.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        SopPartner::create($data);

        return redirect()
            ->route('admin.pages.sop.partners.index')
            ->with('status', 'Instansi pendukung SOP berhasil ditambahkan.');
    }

    public function edit(SopPartner $partner): View
    {
        return view('admin.pages.sop.partners.edit', compact('partner'));
    }

    public function update(Request $request, SopPartner $partner): RedirectResponse
    {
        $data = $this->validatedData($request);
        $partner->update($data);

        return redirect()
            ->route('admin.pages.sop.partners.index')
            ->with('status', 'Instansi pendukung SOP berhasil diperbarui.');
    }

    public function destroy(SopPartner $partner): RedirectResponse
    {
        $partner->delete();

        return redirect()
            ->route('admin.pages.sop.partners.index')
            ->with('status', 'Instansi pendukung SOP berhasil dihapus.');
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

