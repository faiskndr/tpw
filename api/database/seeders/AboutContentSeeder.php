<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            [
                'section' => 'hero',
                'title' => 'Tentang Kami',
                'body' => 'Kami adalah platform perjalanan wisata terpercaya yang menghubungkan wisatawan dengan pengalaman tak terlupakan di seluruh Indonesia.',
                'image_url' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800',
            ],
            [
                'section' => 'visi',
                'title' => 'Visi Kami',
                'body' => 'Menjadi platform wisata terdepan yang menginspirasi setiap orang untuk menjelajahi keindahan nusantara.',
                'image_url' => null,
            ],
            [
                'section' => 'misi',
                'title' => 'Misi Kami',
                'body' => 'Menyediakan paket wisata berkualitas, terjangkau, dan aman untuk semua kalangan dengan layanan terbaik.',
                'image_url' => null,
            ],
            [
                'section' => 'tim',
                'title' => 'Tim Kami',
                'body' => 'Didukung oleh tim profesional berpengalaman di bidang pariwisata yang berdedikasi melayani setiap pelanggan.',
                'image_url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800',
            ],
        ];

        foreach ($contents as $content) {
            AboutContent::create($content);
        }
    }
}
