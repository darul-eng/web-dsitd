<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Akun & Akses',
            'Layanan Jaringan',
            'Sistem Informasi',
        ];

        foreach ($categories as $catName) {
            $category = FaqCategory::create(['name' => $catName]);

            if ($catName === 'Akun & Akses') {
                Faq::create([
                    'faq_category_id' => $category->id,
                    'question' => 'Bagaimana cara reset password email UNHAS?',
                    'answer' => 'Anda dapat melakukan reset password secara mandiri melalui laman SSO atau mendatangi loket layanan DSITD dengan membawa kartu identitas.',
                    'order' => 1,
                    'is_published' => true,
                ]);
            }
        }
    }
}
