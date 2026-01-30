<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $category = GalleryCategory::create(['name' => 'Kegiatan']);

        Gallery::create([
            'gallery_category_id' => $category->id,
            'title' => 'Workshop Transformasi Digital 2024',
            'slug' => Str::slug('Workshop Transformasi Digital 2024'),
            'description' => 'Dokumentasi kegiatan workshop TI tingkat universitas.',
            'cover_image' => null,
            'is_published' => true,
            'user_id' => 1,
        ]);
    }
}
