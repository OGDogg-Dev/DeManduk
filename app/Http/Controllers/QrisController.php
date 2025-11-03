<?php

namespace App\Http\Controllers;

use App\Models\QrisFaq;
use App\Models\QrisNote;
use App\Models\QrisStep;
use App\Models\SiteSetting;
use App\Support\Media;
use Illuminate\View\View;

class QrisController extends Controller
{
    public function __invoke(): View
    {
        $steps = QrisStep::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $notes = QrisNote::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $faqs = QrisFaq::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $posterPath = SiteSetting::getValue('qris.poster_path');

        $posterUrl = Media::url($posterPath);
        $posterFormat = null;
        if ($posterPath) {
            $extension = strtoupper(pathinfo($posterPath, PATHINFO_EXTENSION) ?: '');
            $posterFormat = $extension !== '' ? $extension : 'Unduh';
        }

        return view('public.qris', [
            'subtitle' => SiteSetting::getValue('qris.subtitle'),
            'primaryAlert' => [
                'variant' => SiteSetting::getValue('qris.primary_alert_variant', 'info'),
                'title' => SiteSetting::getValue('qris.primary_alert_title'),
                'body' => SiteSetting::getValue('qris.primary_alert_body'),
            ],
            'poster' => [
                'download' => $posterUrl,
                'formats' => SiteSetting::getValue('qris.poster_formats'),
                'format' => $posterFormat,
            ],
            'steps' => $steps,
            'notes' => $notes,
            'faqs' => $faqs,
            'bottomAlert' => [
                'variant' => SiteSetting::getValue('qris.bottom_alert_variant', 'warning'),
                'title' => SiteSetting::getValue('qris.bottom_alert_title'),
                'body' => SiteSetting::getValue('qris.bottom_alert_body'),
            ],
        ]);
    }
}
