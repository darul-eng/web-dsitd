<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $category = DocumentCategory::create([
            'name' => 'Panduan Pengguna',
            'slug' => 'panduan-pengguna',
        ]);

        Document::create([
            'document_category_id' => $category->id,
            'title' => 'Panduan Aktivasi Email UNHAS',
            'description' => 'Langkah-langkah aktivasi akun bagi mahasiswa baru.',
            'file_path' => 'documents/guide-email.pdf',
            'file_type' => 'PDF',
            'file_size' => 1024,
            'is_public' => true,
        ]);
    }
}
