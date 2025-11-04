<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialMediaSettingsController extends Controller
{
    public function edit(): View
    {
        $socialMedia = [
            'facebook' => SiteSetting::getValue('social.facebook', ''),
            'instagram' => SiteSetting::getValue('social.instagram', ''),
            'twitter' => SiteSetting::getValue('social.twitter', ''),
            'youtube' => SiteSetting::getValue('social.youtube', ''),
        ];

        return view('admin.pages.social-media.settings', compact('socialMedia'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_youtube' => 'nullable|url',
        ]);

        SiteSetting::setValue('social.facebook', $request->social_facebook);
        SiteSetting::setValue('social.instagram', $request->social_instagram);
        SiteSetting::setValue('social.twitter', $request->social_twitter);
        SiteSetting::setValue('social.youtube', $request->social_youtube);

        return redirect()->route('admin.pages.social-media.settings.edit')
            ->with('success', 'Pengaturan media sosial berhasil diperbarui.');
    }
}