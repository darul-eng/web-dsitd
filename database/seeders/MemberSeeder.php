<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Helper function for dummy images
        $getImg = fn($id) => "https://i.pravatar.cc/150?u=ltdka_{$id}";

        // ── Level 0: Direktur (Sun) ──────────────────────────
        $direktur = Member::create([
            'fullname'       => 'Prof. Dr. Ahmad Rizal, M.T.',
            'position'       => 'Direktur',
            'position_group' => 'direktur',
            'image'          => $getImg('dir'),
            'order'          => 1,
            'is_active'      => true,
        ]);

        // ── Level 1: Kasubdit (Planets) ──────────────────────
        $kasubditInfra = Member::create([
            'parent_id'      => $direktur->id,
            'fullname'       => $faker->name,
            'position'       => 'Kasubdit Infrastruktur',
            'position_group' => 'kasubdit',
            'image'          => $getImg('infra'),
            'order'          => 2,
            'is_active'      => true,
        ]);

        $kasubditSI = Member::create([
            'parent_id'      => $direktur->id,
            'fullname'       => $faker->name,
            'position'       => 'Kasubdit Sistem Informasi',
            'position_group' => 'kasubdit',
            'image'          => $getImg('si'),
            'order'          => 3,
            'is_active'      => true,
        ]);

        // ── Level 2: Kepala Seksi & Helpdesk (Moons) ──────────
        $kasiJaringan = Member::create([
            'parent_id'      => $kasubditInfra->id,
            'fullname'       => $faker->name,
            'position'       => 'Kepala Seksi Jaringan',
            'position_group' => 'kepala-seksi',
            'image'          => $getImg('kasi_jar'),
            'order'          => 4,
            'is_active'      => true,
        ]);

        // Helpdesk (4 orang) di bawah Kasubdit Infrastruktur
        for ($i = 1; $i <= 4; $i++) {
            Member::create([
                'parent_id'      => $kasubditInfra->id,
                'fullname'       => $faker->name,
                'position'       => 'Helpdesk',
                'position_group' => 'tim-helpdesk',
                'image'          => $getImg("hd_{$i}"),
                'order'          => 4 + $i,
                'is_active'      => true,
            ]);
        }

        // Programmer (3 orang) di bawah Kasubdit SI
        for ($i = 1; $i <= 3; $i++) {
            Member::create([
                'parent_id'      => $kasubditSI->id,
                'fullname'       => $faker->name,
                'position'       => 'Programmer',
                'position_group' => 'tim-programmer',
                'image'          => $getImg("prog_{$i}"),
                'order'          => 8 + $i,
                'is_active'      => true,
            ]);
        }

        // ── Level 3: Teknisi Jaringan (Sub-Moons) ──────────────
        // 13 orang di bawah Kepala Seksi Jaringan
        for ($i = 1; $i <= 13; $i++) {
            Member::create([
                'parent_id'      => $kasiJaringan->id,
                'fullname'       => $faker->name,
                'position'       => 'Teknisi Jaringan',
                'position_group' => 'tim-jaringan',
                'image'          => $getImg("teknisi_{$i}"),
                'order'          => 11 + $i,
                'is_active'      => true,
            ]);
        }
    }
}
