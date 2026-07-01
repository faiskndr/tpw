<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Labuan Bajo',
                'province' => 'Nusa Tenggara Timur',
                'type' => 'island',
                'description' => 'Surga tersembunyi di ujung barat Flores dengan komodo dan pantai eksotis.',
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800',
            ],
            [
                'name' => 'Raja Ampat',
                'province' => 'Papua Barat',
                'type' => 'island',
                'description' => 'Kepulauan dengan biodiversitas laut tertinggi di dunia.',
                'image_url' => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?w=800',
            ],
            [
                'name' => 'Bromo',
                'province' => 'Jawa Timur',
                'type' => 'mountain',
                'description' => 'Gunung berapi aktif dengan pemandangan sunrise paling spektakuler.',
                'image_url' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=800',
            ],
            [
                'name' => 'Derawan',
                'province' => 'Kalimantan Timur',
                'type' => 'island',
                'description' => 'Surga snorkeling dengan penyu hijau dan ubur-ubur tanpa sengat.',
                'image_url' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800',
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }
}
