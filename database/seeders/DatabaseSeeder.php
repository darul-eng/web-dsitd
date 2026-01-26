<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Roles
        $superadmin = Role::create(['name' => 'superadmin', 'label' => 'Super Administrator']);
        $admin = Role::create(['name' => 'admin', 'label' => 'Administrator']);
        Role::create(['name' => 'user', 'label' => 'Regular User']);

        // 2. Create Permissions
        $permissions = [
            'manage-users'      => 'Kelola Pengguna',
            'manage-roles'      => 'Kelola Role & Akses',
            'manage-news'       => 'Kelola Berita',
            'manage-pages'      => 'Kelola Halaman Statis',
            'manage-services'   => 'Kelola Layanan',
            'manage-faqs'       => 'Kelola FAQ',
            'manage-gallery'    => 'Kelola Galeri',
            'manage-documents'  => 'Kelola Dokumen',
            'manage-inbox'      => 'Kelola Kotak Masuk',
            'manage-links'      => 'Kelola Link Terkait',
        ];

        foreach ($permissions as $name => $label) {
            Permission::create([
                'name' => $name,
                'label' => $label,
            ]);
        }

        // 3. Assign Permissions to Roles
        // Admin gets content and inbox management
        $adminPermissions = [
            'manage-news',
            'manage-pages',
            'manage-services',
            'manage-faqs',
            'manage-gallery',
            'manage-documents',
            'manage-inbox',
            'manage-links',
        ];

        $admin->permissions()->attach(
            Permission::whereIn('name', $adminPermissions)->pluck('id')
        );

        // Superadmin gets everything (logic in trait also bypasses checks)
        $superadmin->permissions()->attach(
            Permission::all()->pluck('id')
        );

        // 4. Create Default Superadmin User
        $adminUser = User::factory()->create([
            'name' => 'Superadmin DSITD',
            'email' => 'admin@unhas.ac.id',
            'password' => Hash::make('password'),
        ]);

        // 5. Assign Role to User
        $adminUser->assignRole($superadmin);

        // 6. Content Categories
        $this->call([
            NewsCategorySeeder::class,
        ]);
    }
}
