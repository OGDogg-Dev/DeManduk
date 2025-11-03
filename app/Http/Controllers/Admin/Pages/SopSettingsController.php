<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SopSettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.pages.sop.settings', [
            'subtitle' => SiteSetting::getValue('sop.subtitle'),
            'introParagraphs' => SiteSetting::getValue('sop.intro_paragraphs', '[]'),
            'infoAlert' => [
                'variant' => SiteSetting::getValue('sop.info_alert_variant', 'info'),
                'title' => SiteSetting::getValue('sop.info_alert_title'),
                'body' => SiteSetting::getValue('sop.info_alert_body'),
            ],
            'bottomAlert' => [
                'variant' => SiteSetting::getValue('sop.bottom_alert_variant', 'success'),
                'title' => SiteSetting::getValue('sop.bottom_alert_title'),
                'body' => SiteSetting::getValue('sop.bottom_alert_body'),
            ],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'subtitle' => ['nullable', 'string', 'max:500'],
            'intro_paragraphs' => ['nullable', 'string'],
            'info_alert_variant' => ['required', 'string', 'in:info,success,warning,danger'],
            'info_alert_title' => ['required', 'string', 'max:255'],
            'info_alert_body' => ['nullable', 'string'],
            'bottom_alert_variant' => ['required', 'string', 'in:info,success,warning,danger'],
            'bottom_alert_title' => ['required', 'string', 'max:255'],
            'bottom_alert_body' => ['nullable', 'string'],
        ]);

        SiteSetting::setValue('sop.subtitle', $data['subtitle'] ?? null);

        $paragraphs = Collection::make(preg_split("/\r?\n/", $data['intro_paragraphs'] ?? ''))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        SiteSetting::setValue(
            'sop.intro_paragraphs',
            json_encode($paragraphs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );

        SiteSetting::setValue('sop.info_alert_variant', $data['info_alert_variant']);
        SiteSetting::setValue('sop.info_alert_title', $data['info_alert_title']);
        SiteSetting::setValue('sop.info_alert_body', $data['info_alert_body'] ?? null);

        SiteSetting::setValue('sop.bottom_alert_variant', $data['bottom_alert_variant']);
        SiteSetting::setValue('sop.bottom_alert_title', $data['bottom_alert_title']);
        SiteSetting::setValue('sop.bottom_alert_body', $data['bottom_alert_body'] ?? null);

        return redirect()
            ->route('admin.pages.sop.settings.edit')
            ->with('status', 'Pengaturan SOP berhasil diperbarui.');
    }
}

