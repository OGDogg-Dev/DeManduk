<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\ContactAlert;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactAlertController extends Controller
{
    public function index(): View
    {
        $alerts = ContactAlert::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.pages.contact.alerts.index', compact('alerts'));
    }

    public function create(): View
    {
        return view('admin.pages.contact.alerts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        ContactAlert::create($data);

        return redirect()
            ->route('admin.pages.contact.alerts.index')
            ->with('status', 'Peringatan kontak berhasil ditambahkan.');
    }

    public function edit(ContactAlert $alert): View
    {
        return view('admin.pages.contact.alerts.edit', compact('alert'));
    }

    public function update(Request $request, ContactAlert $alert): RedirectResponse
    {
        $data = $this->validatedData($request);
        $alert->update($data);

        return redirect()
            ->route('admin.pages.contact.alerts.index')
            ->with('status', 'Peringatan kontak berhasil diperbarui.');
    }

    public function destroy(ContactAlert $alert): RedirectResponse
    {
        $alert->delete();

        return redirect()
            ->route('admin.pages.contact.alerts.index')
            ->with('status', 'Peringatan kontak berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'variant' => ['required', 'string', 'in:info,success,warning,danger'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}

