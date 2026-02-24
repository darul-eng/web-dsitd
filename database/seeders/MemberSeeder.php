<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        Member::create([
            'fullname' => 'Direktur SITD',
            'position' => 'Direktur',
            'order' => 1,
            'is_active' => true,
        ]);

        Member::create([
            'fullname' => 'Sekretaris SITD',
            'position' => 'Sekretaris',
            'order' => 2,
            'is_active' => true,
        ]);
    }
}
