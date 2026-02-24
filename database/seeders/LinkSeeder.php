<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    public function run(): void
    {
        Link::create([
            'title' => 'Portal UNHAS',
            'url' => 'https://unhas.ac.id',
            'order' => 1,
            'is_active' => true,
        ]);

        Link::create([
            'title' => 'SSO UNHAS',
            'url' => 'https://sso.unhas.ac.id',
            'order' => 2,
            'is_active' => true,
        ]);
    }
}
