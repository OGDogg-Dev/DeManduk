<?php

namespace App\Http\Controllers;

use App\Models\HomeFeature;
use App\Models\HomeGuide;
use App\Models\HomeOpeningHour;
use App\Models\HomePricingRow;
use App\Models\HomeProcedure;
use App\Models\HomeProject;
use App\Models\HomeSlide;
use App\Models\HomeStat;
use App\Models\SiteSetting;
use App\Support\Media;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $slides = HomeSlide::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (HomeSlide $slide) {
                return [
                    'eyebrow' => $slide->eyebrow,
                    'title' => $slide->title,
                    'description' => $slide->description,
                    'image' => Media::url($slide->image_path),
                    'cta' => array_filter([
                        'label' => $slide->cta_label,
                        'href' => $slide->cta_url,
                    ]),
                ];
            })
            ->values()
            ->all();

        $projects = HomeProject::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (HomeProject $project) {
                return [
                    'title' => $project->title,
                    'description' => $project->description,
                    'image' => Media::url($project->image_path),
                ];
            })
            ->values()
            ->all();

        $features = HomeFeature::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (HomeFeature $feature) {
                return [
                    'title' => $feature->title,
                    'description' => $feature->description,
                ];
            })
            ->values()
            ->all();

        $pricing = HomePricingRow::query()
            ->orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->groupBy('category')
            ->map(function ($rows) {
                return $rows->map(function (HomePricingRow $row) {
                    return [
                        $row->label,
                        $row->price,
                        $row->description,
                    ];
                })->values()->all();
            });

        $openingRows = HomeOpeningHour::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (HomeOpeningHour $row) {
                return [
                    $row->label,
                    $row->hours,
                    $row->note,
                ];
            })
            ->values()
            ->all();

        $stats = HomeStat::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (HomeStat $stat) {
                return [
                    'label' => $stat->label,
                    'value' => $stat->value,
                ];
            })
            ->values()
            ->all();

        $procedures = HomeProcedure::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (HomeProcedure $procedure) {
                return [
                    'title' => $procedure->title,
                    'description' => $procedure->description,
                ];
            })
            ->values()
            ->all();

        $guides = HomeGuide::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (HomeGuide $guide) {
                $items = $guide->items ?? [];

                if (! is_array($items)) {
                    $items = [];
                }

                return [
                    'title' => $guide->title,
                    'items' => array_values($items),
                ];
            })
            ->values()
            ->all();

        $aboutParagraphs = json_decode(
            SiteSetting::getValue('home.about_paragraphs', '[]'),
            true
        );

        if (! is_array($aboutParagraphs)) {
            $aboutParagraphs = [];
        }

        $aboutImage = Media::url(
            SiteSetting::getValue('home.about_image')
        );

        $mapSettings = [
            'mapsUrl' => SiteSetting::getValue(
                'home.map_embed_url',
                'https://maps.google.com/maps?q=Waduk%20Manduk&t=&z=15&ie=UTF8&iwloc=&output=embed'
            ),
            'linkLabel' => SiteSetting::getValue(
                'home.map_link_label',
                'Buka di Google Maps'
            ),
            'directionsUrl' => SiteSetting::getValue(
                'home.map_directions_url',
                'https://maps.app.goo.gl/ktGvAEF1vqdjDKXQ7'
            ),
        ];

        $institutions = json_decode(
            SiteSetting::getValue('home.supporting_institutions', '[]'),
            true
        );

        if (! is_array($institutions)) {
            $institutions = [];
        }

        $institutions = collect($institutions)
            ->map(function ($item) {
                return [
                    'title' => $item['title'] ?? '',
                    'description' => $item['description'] ?? '',
                ];
            })
            ->filter(fn ($item) => $item['title'] !== '' || $item['description'] !== '')
            ->values()
            ->all();

        $sections = [
            ['#about', 'Tentang'],
            ['#project', 'Agenda'],
            ['#service', 'Fasilitas'],
            ['#pricing', 'Harga'],
            ['#hours', 'Jam'],
            ['#map', 'Peta'],
            ['#sop-overview', 'SOP'],
            ['#sop-detail', 'Panduan'],
        ];

        return view('public.home', [
            'slides' => $slides,
            'projects' => $projects,
            'features' => $features,
            'ticketRows' => $pricing->get('ticket', []) ?? [],
            'facilityRows' => $pricing->get('facility', []) ?? [],
            'openingRows' => $openingRows,
            'stats' => $stats,
            'procedures' => $procedures,
            'guides' => $guides,
            'institutions' => $institutions,
            'about' => [
                'paragraphs' => $aboutParagraphs,
                'image' => $aboutImage,
            ],
            'map' => $mapSettings,
            'sections' => $sections,
        ]);
    }
}
