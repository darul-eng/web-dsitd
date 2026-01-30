<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $category = PageCategory::create([
            'name' => 'Profil',
            'slug' => 'profil',
        ]);

        Page::create([
            'page_category_id' => $category->id,
            'title' => 'Sejarah DSITD',
            'slug' => 'sejarah-dsitd',
            'content' => '<p>Direktorat Sistem Teknologi Informasi dan Digitalisasi (DSITD) Universitas Hasanuddin didirikan untuk mengelola seluruh ekosistem TI...</p>',
            'is_published' => true,
        ]);

        Page::create([
            'page_category_id' => $category->id,
            'title' => 'Visi & Misi',
            'slug' => 'visi-misi',
            'content' => '<p>Menjadi pusat penggerak transformasi digital universitas tingkat dunia...</p>',
            'is_published' => true,
        ]);
    }
}
