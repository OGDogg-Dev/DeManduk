<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Support\Media;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __invoke(): View
    {
        $items = GalleryItem::query()
            ->published()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (GalleryItem $item) {
                return [
                    'title' => $item->title,
                    'caption' => $item->caption,
                    'image' => Media::url($item->image_path),
                ];
            })
            ->values()
            ->all();

        return view('public.galeri', [
            'galleryItems' => $items,
        ]);
    }
}

