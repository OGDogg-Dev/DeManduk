<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\ContactSupport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactSupportController extends Controller
{
    public function index(): View
    {
        $supports = ContactSupport::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.pages.contact.supports.index', compact('supports'));
    }

    public function create(): View
    {
        return view('admin.pages.contact.supports.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        ContactSupport::create($data);

        return redirect()
            ->route('admin.pages.contact.supports.index')
            ->with('status', 'Instansi pendukung berhasil ditambahkan.');
    }

    public function edit(ContactSupport $support): View
    {
        return view('admin.pages.contact.supports.edit', compact('support'));
    }

    public function update(Request $request, ContactSupport $support): RedirectResponse
    {
        $data = $this->validatedData($request);
        $support->update($data);

        return redirect()
            ->route('admin.pages.contact.supports.index')
            ->with('status', 'Instansi pendukung berhasil diperbarui.');
    }

    public function destroy(ContactSupport $support): RedirectResponse
    {
        $support->delete();

        return redirect()
            ->route('admin.pages.contact.supports.index')
            ->with('status', 'Instansi pendukung berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['phone'] = $this->normalizePhone($data['phone'] ?? null);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }

    private function normalizePhone(?string $phone): ?string
    {
        if ($phone === null) {
            return null;
        }

        $clean = trim(preg_replace('/\s+/', ' ', $phone));

        return $clean === '' ? null : $clean;
    }
}
