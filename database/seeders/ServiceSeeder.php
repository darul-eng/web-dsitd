<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Clear existing data to ensure clean state
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Service::truncate();
        ServiceCategory::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Create Core Category
        $category = ServiceCategory::create([
            'name' => 'Layanan Utama',
            'slug' => 'layanan-utama',
        ]);

        // 3. Define Core Services from Image
        $coreServices = [
            [
                'title' => 'Layanan Microsoft Office 365',
                'content' => 'Akses penuh ke suite produktivitas Microsoft Office 365 termasuk Word, Excel, PowerPoint, dan Teams untuk seluruh sivitas akademika.',
            ],
            [
                'title' => 'Layanan Internet',
                'content' => 'Penyediaan akses internet pita lebar (broadband) yang stabil dan cepat di seluruh area kampus Universitas Hasanuddin.',
            ],
            [
                'title' => 'Layanan Domain Unhas',
                'content' => 'Pengelolaan dan pendaftaran subdomain resmi unhas.ac.id untuk unit kerja, lembaga, dan kegiatan akademik.',
            ],
            [
                'title' => 'Layanan Email Unhas',
                'content' => 'Layanan surat elektronik resmi dengan domain @unhas.ac.id untuk mahasiswa, dosen, dan staf sebagai identitas digital resmi.',
            ],
            [
                'title' => 'Layanan Neosia',
                'content' => 'Sistem Informasi Akademik Generasi Baru (NEOSIA) untuk pengelolaan data pendidikan dan kurikulum yang terintegrasi.',
            ],
            [
                'title' => 'Layanan Tanda Tangan Elektronik (TTE)',
                'content' => 'Implementasi sertifikat digital untuk penandatanganan dokumen resmi secara elektronik yang sah dan aman.',
            ],
            [
                'title' => 'Layanan E-Office',
                'content' => 'Sistem persuratan dan tata kelola administrasi perkantoran digital untuk meningkatkan efisiensi birokrasi kampus.',
            ],
            [
                'title' => 'Layanan Apps',
                'content' => 'Pengembangan dan pemeliharaan berbagai platform aplikasi pendukung kegiatan riset, pengabdian, dan manajemen internal.',
            ],
        ];

        foreach ($coreServices as $index => $s) {
            Service::create([
                'service_category_id' => $category->id,
                'title' => $s['title'],
                'slug' => Str::slug($s['title']),
                'content' => $s['content'],
                'is_active' => true,
                'order' => $index + 1,
                'icon' => null, // Icons will be uploaded via Admin Panel
            ]);
        }
    }
}
