<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Admin\Concerns\StoresMedia;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QrisSettingsController extends Controller
{
    use StoresMedia;

    public function edit(): View
    {
        return view('admin.pages.qris.settings', [
            'subtitle' => SiteSetting::getValue('qris.subtitle'),
            'primaryAlert' => [
                'variant' => SiteSetting::getValue('qris.primary_alert_variant', 'info'),
                'title' => SiteSetting::getValue('qris.primary_alert_title'),
                'body' => SiteSetting::getValue('qris.primary_alert_body'),
            ],
            'posterPath' => SiteSetting::getValue('qris.poster_path'),
            'posterFormats' => SiteSetting::getValue('qris.poster_formats'),
            'bottomAlert' => [
                'variant' => SiteSetting::getValue('qris.bottom_alert_variant', 'warning'),
                'title' => SiteSetting::getValue('qris.bottom_alert_title'),
                'body' => SiteSetting::getValue('qris.bottom_alert_body'),
            ],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'subtitle' => ['nullable', 'string', 'max:500'],
            'primary_alert_variant' => ['required', 'string', 'in:info,success,warning,danger'],
            'primary_alert_title' => ['required', 'string', 'max:255'],
            'primary_alert_body' => ['nullable', 'string'],
            'poster' => ['nullable', 'image', 'max:4096'],
            'poster_formats' => ['nullable', 'string', 'max:255'],
            'remove_poster' => ['nullable', 'boolean'],
            'bottom_alert_variant' => ['required', 'string', 'in:info,success,warning,danger'],
            'bottom_alert_title' => ['required', 'string', 'max:255'],
            'bottom_alert_body' => ['nullable', 'string'],
        ]);

        SiteSetting::setValue('qris.subtitle', $data['subtitle'] ?? null);
        SiteSetting::setValue('qris.primary_alert_variant', $data['primary_alert_variant']);
        SiteSetting::setValue('qris.primary_alert_title', $data['primary_alert_title']);
        SiteSetting::setValue('qris.primary_alert_body', $data['primary_alert_body'] ?? null);
        SiteSetting::setValue('qris.poster_formats', $data['poster_formats'] ?? null);
        SiteSetting::setValue('qris.bottom_alert_variant', $data['bottom_alert_variant']);
        SiteSetting::setValue('qris.bottom_alert_title', $data['bottom_alert_title']);
        SiteSetting::setValue('qris.bottom_alert_body', $data['bottom_alert_body'] ?? null);

        $currentPoster = SiteSetting::getValue('qris.poster_path');

        if (! empty($data['remove_poster']) && $currentPoster) {
            $this->deleteStoredFile($currentPoster);
            SiteSetting::setValue('qris.poster_path', null);
            $currentPoster = null;
        }

        if ($request->hasFile('poster')) {
            $posterPath = $this->storeUploadedFile($request, 'poster', 'qris', $currentPoster);
            SiteSetting::setValue('qris.poster_path', $posterPath);
        }

        return redirect()
            ->route('admin.pages.qris.settings.edit')
            ->with('status', 'Pengaturan QRIS berhasil diperbarui.');
    }
}

