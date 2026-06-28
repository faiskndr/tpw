<?php

namespace Database\Seeders;

use App\Models\TourPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'destination_id' => 1,
                'title' => 'Open Trip Labuan Bajo 3D2N',
                'type' => 'open_trip',
                'price' => 850000,
                'price_original' => 1200000,
                'duration_days' => 3,
                'description' => 'Jelajahi keindahan Labuan Bajo bersama group trip yang seru!',
                'rating' => 5.0,
                'review_count' => 349,
            ],
            [
                'destination_id' => 1,
                'title' => 'Private Tur Komodo Island',
                'type' => 'private_tour',
                'price' => 2500000,
                'price_original' => 3000000,
                'duration_days' => 4,
                'description' => 'Nikmati keindahan Komodo secara privat bersama keluarga.',
                'rating' => 5.0,
                'review_count' => 128,
            ],
            [
                'destination_id' => 2,
                'title' => 'Open Trip Raja Ampat 4D3N',
                'type' => 'open_trip',
                'price' => 1500000,
                'price_original' => 2000000,
                'duration_days' => 4,
                'description' => 'Selami keindahan bawah laut Raja Ampat yang memukau.',
                'rating' => 5.0,
                'review_count' => 217,
            ],
            [
                'destination_id' => 3,
                'title' => 'Open Trip Bromo Sunrise',
                'type' => 'open_trip',
                'price' => 350000,
                'price_original' => 500000,
                'duration_days' => 2,
                'description' => 'Saksikan sunrise spektakuler dari puncak Bromo.',
                'rating' => 4.9,
                'review_count' => 421,
            ],
            [
                'destination_id' => 4,
                'title' => 'Open Trip Derawan Island',
                'type' => 'open_trip',
                'price' => 600000,
                'price_original' => 800000,
                'duration_days' => 3,
                'description' => 'Snorkeling bersama penyu dan ubur-ubur di Derawan.',
                'rating' => 5.0,
                'review_count' => 183,
            ],
        ];

        foreach ($packages as $package) {
            TourPackage::create($package);
        }
    }
}
