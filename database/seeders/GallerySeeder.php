<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        GalleryItem::query()->delete();

        $items = [
            [
                'title' => 'Panorama Senja Waduk Manduk',
                'caption' => 'Langit jingga memantul di permukaan waduk, favorit pengunjung untuk menikmati sore hari.',
                'image_path' => 'images/gallery/gallery-1.svg',
                'sort_order' => 1,
            ],
            [
                'title' => 'Dermaga Perahu Wisata',
                'caption' => 'Dermaga kayu dengan perahu wisata siap membawa rombongan berkeliling.',
                'image_path' => 'images/gallery/gallery-2.svg',
                'sort_order' => 2,
            ],
            [
                'title' => 'Lampion Night Market',
                'caption' => 'Suasana pasar malam tematik dengan dekorasi lampion mendampingi UMKM lokal.',
                'image_path' => 'images/gallery/gallery-3.svg',
                'sort_order' => 3,
            ],
            [
                'title' => 'Fun Paddle Komunitas',
                'caption' => 'Komunitas kano dan paddle board menjalani latihan rutin sekaligus pembersihan waduk.',
                'image_path' => 'images/gallery/gallery-4.svg',
                'sort_order' => 4,
            ],
            [
                'title' => 'Sentra Kuliner Manduk',
                'caption' => 'Deretan kios kuliner halal yang menyajikan menu khas desa Jatirejo.',
                'image_path' => 'images/gallery/gallery-5.svg',
                'sort_order' => 5,
            ],
            [
                'title' => 'Sky Deck Manduk',
                'caption' => 'Pengunjung menikmati panorama 360 derajat dari sky deck utama.',
                'image_path' => 'images/gallery/gallery-6.svg',
                'sort_order' => 6,
            ],
        ];

        foreach ($items as $item) {
            GalleryItem::query()->create([
                'title' => $item['title'],
                'caption' => $item['caption'],
                'image_path' => $item['image_path'],
                'status' => GalleryItem::STATUS_PUBLISHED,
                'sort_order' => $item['sort_order'],
                'published_at' => now(),
            ]);
        }
    }
}
