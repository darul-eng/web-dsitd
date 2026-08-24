<?php

namespace Database\Seeders;

use App\Models\Jumbotron;
use Illuminate\Database\Seeder;

class JumbotronSeeder extends Seeder
{
    public function run(): void
    {
        Jumbotron::create([
            'title' => 'Transformasi Digital Menuju World Class University',
            'description' => 'LTDKA berkomitmen menyediakan infrastruktur teknologi terbaik untuk mendukung visi Universitas Hasanuddin.',
            'image_path' => null, // Simplified for seeder
            'order' => 1,
            'is_active' => true,
        ]);

        Jumbotron::create([
            'title' => 'Layanan Cloud Terintegrasi',
            'description' => 'Nikmati kolaborasi tanpa batas dengan ekosistem digital UNHAS.',
            'image_path' => null,
            'order' => 2,
            'is_active' => true,
        ]);
    }
}
