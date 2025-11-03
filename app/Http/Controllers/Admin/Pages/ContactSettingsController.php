<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactSettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.pages.contact.settings', [
            'subtitle' => SiteSetting::getValue('contact.subtitle'),
            'address' => SiteSetting::getValue('contact.address'),
            'phone' => SiteSetting::getValue('contact.phone'),
            'email' => SiteSetting::getValue('contact.email'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'subtitle' => ['nullable', 'string', 'max:500'],
            'address' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        SiteSetting::setValue('contact.subtitle', $data['subtitle'] ?? null);
        SiteSetting::setValue('contact.address', $data['address'] ?? null);
        SiteSetting::setValue('contact.phone', $data['phone'] ?? null);
        SiteSetting::setValue('contact.email', $data['email'] ?? null);

        return redirect()
            ->route('admin.pages.contact.settings.edit')
            ->with('status', 'Pengaturan kontak berhasil diperbarui.');
    }
}

