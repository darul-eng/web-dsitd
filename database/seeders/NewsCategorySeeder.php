<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Berita Utama',
                'description' => 'Kumpulan berita utama dan terkini dari LTDKA.',
            ],
            [
                'name' => 'Pengumuman',
                'description' => 'Informasi resmi dan pengumuman penting.',
            ],
            [
                'name' => 'Kegiatan',
                'description' => 'Dokumentasi kegiatan dan agenda direktorat.',
            ],
            [
                'name' => 'Artikel & Edukasi',
                'description' => 'Artikel informatif seputar teknologi digital dan sistem informasi.',
            ],
        ];

        foreach ($categories as $category) {
            NewsCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                ]
            );
        }
    }
}
