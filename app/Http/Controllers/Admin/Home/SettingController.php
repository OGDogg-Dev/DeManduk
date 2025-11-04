<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Admin\Concerns\StoresMedia;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SettingController extends Controller
{
    use StoresMedia;

    public function edit(): View
    {
        return view('admin.home.settings.edit', [
            'siteTitle' => SiteSetting::getValue('site.title', "D'Manduk"),
            'logoPath' => SiteSetting::getValue('site.logo_path'),
            'aboutParagraphs' => SiteSetting::getValue('home.about_paragraphs', '[]'),
            'aboutImagePath' => SiteSetting::getValue('home.about_image'),
            'mapEmbedUrl' => SiteSetting::getValue('home.map_embed_url'),
            'mapLinkLabel' => SiteSetting::getValue('home.map_link_label'),
            'mapDirectionsUrl' => SiteSetting::getValue('home.map_directions_url'),

        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_title' => ['required', 'string', 'max:255'],
            'site_logo' => ['nullable', 'image', 'max:4096'],
            'remove_logo' => ['nullable', 'boolean'],
            'about_paragraphs' => ['nullable', 'string'],
            'about_image' => ['nullable', 'image', 'max:4096'],
            'remove_about_image' => ['nullable', 'boolean'],
            'map_embed_url' => ['nullable', 'string', 'max:2048'],
            'map_link_label' => ['nullable', 'string', 'max:255'],
            'map_directions_url' => ['nullable', 'string', 'max:2048'],

        ]);

        SiteSetting::setValue('site.title', $data['site_title']);

        $currentLogo = SiteSetting::getValue('site.logo_path');
        if (! empty($data['remove_logo'])) {
            $this->deleteStoredFile($currentLogo);
            SiteSetting::setValue('site.logo_path', null);
        }

        if ($request->hasFile('site_logo')) {
            $logoPath = $this->storeUploadedFile($request, 'site_logo', 'site', $currentLogo);
            SiteSetting::setValue('site.logo_path', $logoPath);
        }

        $paragraphs = Collection::make(preg_split("/\r?\n/", $data['about_paragraphs'] ?? ''))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
        SiteSetting::setValue(
            'home.about_paragraphs',
            json_encode($paragraphs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );

        $currentAboutImage = SiteSetting::getValue('home.about_image');
        if (! empty($data['remove_about_image'])) {
            $this->deleteStoredFile($currentAboutImage);
            SiteSetting::setValue('home.about_image', null);
            $currentAboutImage = null;
        }

        if ($request->hasFile('about_image')) {
            $aboutImagePath = $this->storeUploadedFile($request, 'about_image', 'home/about', $currentAboutImage);
            SiteSetting::setValue('home.about_image', $aboutImagePath);
        }

        SiteSetting::setValue('home.map_embed_url', $data['map_embed_url'] ?? null);
        SiteSetting::setValue('home.map_link_label', $data['map_link_label'] ?? null);
        SiteSetting::setValue('home.map_directions_url', $data['map_directions_url'] ?? null);



        return redirect()->route('admin.home.settings.edit')
            ->with('status', 'Pengaturan beranda berhasil diperbarui.');
    }
}
