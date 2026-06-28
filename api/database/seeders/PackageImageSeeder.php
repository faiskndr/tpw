<?php

namespace Database\Seeders;

use App\Models\PackageImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            // Labuan Bajo Open Trip
            [
                'tour_package_id' => 1,
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800',
                'is_cover' => true,
                'sort_order' => 1,
            ],
            [
                'tour_package_id' => 1,
                'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=800',
                'is_cover' => false,
                'sort_order' => 2,
            ],
            // Private Tur Komodo
            [
                'tour_package_id' => 2,
                'image_url' => 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=800',
                'is_cover' => true,
                'sort_order' => 1,
            ],
            // Raja Ampat
            [
                'tour_package_id' => 3,
                'image_url' => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?w=800',
                'is_cover' => true,
                'sort_order' => 1,
            ],
            // Bromo
            [
                'tour_package_id' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=800',
                'is_cover' => true,
                'sort_order' => 1,
            ],
            // Derawan
            [
                'tour_package_id' => 5,
                'image_url' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800',
                'is_cover' => true,
                'sort_order' => 1,
            ],
        ];

        foreach ($images as $image) {
            PackageImage::create($image);
        }
    }
}
