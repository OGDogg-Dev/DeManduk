<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Pages\SopDocumentController;
use App\Models\SopDocument;
use App\Models\SopObjective;
use App\Models\SopPartner;
use App\Models\SopStep;
use App\Models\SiteSetting;
use Illuminate\View\View;

class SopController extends Controller
{
    public function __invoke(): View
    {
        $steps = SopStep::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $objectives = SopObjective::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $partners = SopPartner::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $introParagraphs = json_decode(SiteSetting::getValue('sop.intro_paragraphs', '[]'), true);
        if (! is_array($introParagraphs)) {
            $introParagraphs = [];
        }

        // Get all SOP documents, ordered from oldest to newest for chronological display
        $allDocuments = SopDocument::query()
            ->orderBy('uploaded_at')
            ->orderBy('id')
            ->get();
        $latestDocument = $allDocuments->last(); // Still reference the newest item for highlights

        return view('public.sop', [
            'subtitle' => SiteSetting::getValue('sop.subtitle'),
            'introParagraphs' => $introParagraphs,
            'infoAlert' => [
                'variant' => SiteSetting::getValue('sop.info_alert_variant', 'info'),
                'title' => SiteSetting::getValue('sop.info_alert_title'),
                'body' => SiteSetting::getValue('sop.info_alert_body'),
            ],
            'steps' => $steps,
            'objectives' => $objectives,
            'partners' => $partners,
            'bottomAlert' => [
                'variant' => SiteSetting::getValue('sop.bottom_alert_variant', 'success'),
                'title' => SiteSetting::getValue('sop.bottom_alert_title'),
                'body' => SiteSetting::getValue('sop.bottom_alert_body'),
            ],
            'latestDocument' => $latestDocument,
            'allDocuments' => $allDocuments,
        ]);
    }

    public function download(SopDocument $sopDocument)
    {
        return app(SopDocumentController::class)->download($sopDocument);
    }
}
