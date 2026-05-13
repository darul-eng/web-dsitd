<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateLegacyData extends Command
{
    protected $signature = 'migrate:legacy-data';
    protected $description = 'Migrate data from legacy database to the new structure';

    public function handle()
    {
        $oldDb = DB::connection('mysql_old');
        $newDb = DB::connection('mysql');

        $this->info('Starting data migration from legacy database...');

        // 1. Users
        $this->info('Migrating users...');
        $oldDb->table('users')->orderBy('id')->chunk(100, function ($users) use ($newDb) {
            foreach ($users as $user) {
                $newDb->table('users')->updateOrInsert(
                    ['id' => $user->id],
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                        'email_verified_at' => $user->email_verified_at,
                        'password' => $user->password,
                        'remember_token' => $user->remember_token,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                    ]
                );
            }
        });

        // 2. News Categories (from information_categories)
        $this->info('Migrating news_categories...');
        $oldDb->table('information_categories')->orderBy('id')->chunk(100, function ($cats) use ($newDb) {
            foreach ($cats as $cat) {
                $newDb->table('news_categories')->updateOrInsert(
                    ['id' => $cat->id],
                    [
                        'name' => $cat->category,
                        'slug' => $cat->slug,
                        'created_at' => $cat->created_at,
                        'updated_at' => $cat->updated_at,
                    ]
                );
            }
        });

        // 3. News (from information)
        $this->info('Migrating news...');
        $oldDb->table('information')->orderBy('id')->chunk(100, function ($infos) use ($newDb) {
            foreach ($infos as $info) {
                $newDb->table('news')->updateOrInsert(
                    ['id' => $info->id],
                    [
                        'uuid' => $info->uuid ?: Str::uuid(),
                        'news_category_id' => $info->information_category_id,
                        'user_id' => $info->user_id,
                        'title' => $info->title,
                        'slug' => $info->slug,
                        'content' => $info->content,
                        'cover_image' => $info->cover ? 'news-covers/' . $info->cover : null,
                        'start_at' => $info->start_at,
                        'end_at' => $info->end_at,
                        'publish_at_legacy' => $info->publish_at,
                        'updated_by_legacy' => $info->update_by,
                        'status' => 'published',
                        'views_count' => $info->views ?? 0,
                        'created_at' => $info->created_at,
                        'updated_at' => $info->updated_at,
                    ]
                );
            }
        });

        // 4. Page Categories (from profile_categories)
        $this->info('Migrating page_categories...');
        $oldDb->table('profile_categories')->orderBy('id')->chunk(100, function ($cats) use ($newDb) {
            foreach ($cats as $cat) {
                $newDb->table('page_categories')->updateOrInsert(
                    ['id' => $cat->id],
                    [
                        'name' => $cat->category,
                        'slug' => $cat->slug,
                        'created_at' => $cat->created_at,
                        'updated_at' => $cat->updated_at,
                    ]
                );
            }
        });

        // 5. Pages (from profiles)
        $this->info('Migrating pages...');
        $oldDb->table('profiles')->orderBy('id')->chunk(100, function ($profiles) use ($newDb) {
            foreach ($profiles as $profile) {
                $newDb->table('pages')->updateOrInsert(
                    ['id' => $profile->id],
                    [
                        'uuid' => Str::uuid(),
                        'page_category_id' => $profile->profile_category_id,
                        'title' => $profile->title,
                        'slug' => $profile->slug,
                        'content' => $profile->content,
                        'is_published' => 1,
                        'created_at' => $profile->created_at,
                        'updated_at' => $profile->updated_at,
                    ]
                );
            }
        });

        $this->info('Migrating information_images to galleries and gallery_images...');
        
        // Ensure 'Kegiatan' category exists
        $kegiatanCat = $newDb->table('gallery_categories')->where('slug', 'kegiatan')->first();
        if (!$kegiatanCat) {
            $catId = $newDb->table('gallery_categories')->insertGetId([
                'name' => 'Kegiatan',
                'slug' => 'kegiatan',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $catId = $kegiatanCat->id;
        }

        // Group by title and information_id to handle both linked and standalone images
        $groups = $oldDb->table('information_images')
            ->select('information_id', 'title')
            ->groupBy('information_id', 'title')
            ->get();

        foreach ($groups as $group) {
            $title = $group->title ?: 'Dokumentasi Tanpa Judul';
            $infoId = $group->information_id;

            // Get all images for this specific group
            $query = $oldDb->table('information_images')->where('title', $group->title);
            if ($infoId) {
                $query->where('information_id', $infoId);
            } else {
                $query->whereNull('information_id');
            }
            $images = $query->get();
            
            if ($images->isEmpty()) continue;

            // Get original information for title/description if linked
            $info = $infoId ? $oldDb->table('information')->where('id', $infoId)->first() : null;
            $firstImg = $images->first();

            $galleryTitle = $info ? $info->title : $title;
            $slug = Str::slug($galleryTitle) . ($infoId ? '-' . $infoId : '-' . $firstImg->id);

            // Create/Update Gallery
            $newDb->table('galleries')->updateOrInsert(
                ['slug' => $slug],
                [
                    'uuid' => Str::uuid(),
                    'gallery_category_id' => $catId,
                    'title' => $galleryTitle,
                    'description' => $info ? $info->content : $firstImg->desc,
                    'cover_image' => 'galleries/covers/' . $firstImg->img,
                    'is_published' => 1,
                    'user_id' => $info ? $info->user_id : null,
                    'created_at' => $firstImg->created_at,
                    'updated_at' => $firstImg->updated_at,
                ]
            );
            
            $gallery = $newDb->table('galleries')->where('slug', $slug)->first();

            // Insert all images into gallery_images
            foreach ($images as $img) {
                $newDb->table('gallery_images')->updateOrInsert(
                    ['image_path' => 'galleries/photos/' . $img->img, 'gallery_id' => $gallery->id],
                    [
                        'uuid' => Str::uuid(),
                        'caption' => $img->title,
                        'created_at' => $img->created_at,
                        'updated_at' => $img->updated_at,
                    ]
                );
            }
        }

        // Other basic mappings
        $this->info('Migrating other tables (documents, faqs, services, jumbotrons, links, members)...');
        
        // Other categories
        $tables = [
            'document_categories' => ['name_col' => 'category'],
            'faq_categories' => ['name_col' => 'category'],
            'service_categories' => ['name_col' => 'category'],
        ];

        foreach ($tables as $oldTable => $config) {
            $this->info("Migrating {$oldTable}...");
            $oldDb->table($oldTable)->orderBy('id')->chunk(100, function ($rows) use ($newDb, $oldTable, $config) {
                foreach ($rows as $row) {
                    $newDb->table($oldTable)->updateOrInsert(
                        ['id' => $row->id],
                        [
                            'name' => $row->{$config['name_col']} ?? 'Uncategorized',
                            'slug' => $row->slug,
                            'created_at' => $row->created_at,
                            'updated_at' => $row->updated_at,
                        ]
                    );
                }
            });
        }

        // Services
        $this->info('Migrating services...');
        $oldDb->table('services')->orderBy('id')->chunk(100, function ($rows) use ($newDb) {
            foreach ($rows as $row) {
                $newDb->table('services')->updateOrInsert(
                    ['id' => $row->id],
                    [
                        'uuid' => Str::uuid(),
                        'service_category_id' => $row->service_category_id,
                        'title' => $row->title,
                        'slug' => $row->slug,
                        'content' => $row->content,
                        'icon' => $row->thumb, // mapping old thumb to icon or null
                        'external_link' => $row->link,
                        'is_active' => $row->status ?? 1,
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ]
                );
            }
        });

        // Jumbotrons
        $this->info('Migrating jumbotrons...');
        $oldDb->table('jumbotrons')->orderBy('id')->chunk(100, function ($rows) use ($newDb) {
            foreach ($rows as $row) {
                $newDb->table('jumbotrons')->updateOrInsert(
                    ['id' => $row->id],
                    [
                        'uuid' => Str::uuid(),
                        'title' => $row->title,
                        'description' => $row->desc,
                        'image_path' => $row->img ? 'banners/' . $row->img : null,
                        'is_active' => 1,
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ]
                );
            }
        });

        // Members
        $this->info('Migrating members...');
        $oldDb->table('members')->orderBy('id')->chunk(100, function ($rows) use ($newDb) {
            foreach ($rows as $row) {
                $newDb->table('members')->updateOrInsert(
                    ['id' => $row->id],
                    [
                        'uuid' => $row->uuid ?: Str::uuid(),
                        'fullname' => $row->fullname,
                        'address' => $row->address,
                        'gender' => $row->gender,
                        'place_of_birth' => $row->place_of_birth,
                        'date_of_birth' => $row->date_of_birth,
                        'position' => $row->position,
                        'religion' => $row->religion,
                        'email' => $row->email,
                        'image' => $row->img ? 'members/' . $row->img : null,
                        'order' => $row->level ?? 0,
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ]
                );
            }
        });

        // Links
        $this->info('Migrating links...');
        $oldDb->table('links')->orderBy('id')->chunk(100, function ($rows) use ($newDb) {
            foreach ($rows as $row) {
                $newDb->table('links')->updateOrInsert(
                    ['id' => $row->id],
                    [
                        'uuid' => $row->uuid ?? Str::uuid(),
                        'title' => $row->title,
                        'url' => $row->url ?? '#', // Provide default URL in case it's missing or named differently
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ]
                );
            }
        });

        // Documents
        $this->info('Migrating documents...');
        $oldDb->table('documents')->orderBy('id')->chunk(100, function ($rows) use ($newDb) {
            foreach ($rows as $row) {
                $newDb->table('documents')->updateOrInsert(
                    ['id' => $row->id],
                    [
                        'uuid' => $row->uuid ?? Str::uuid(),
                        'document_category_id' => $row->document_category_id,
                        'title' => $row->title,
                        'description' => $row->desc ?? null,
                        'file_path' => $row->content ? 'documents/' . $row->content : null,
                        'is_public' => 1,
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ]
                );
            }
        });

        // FAQs
        $this->info('Migrating faqs...');
        $oldDb->table('faqs')->orderBy('id')->chunk(100, function ($rows) use ($newDb) {
            foreach ($rows as $row) {
                $newDb->table('faqs')->updateOrInsert(
                    ['id' => $row->id],
                    [
                        'uuid' => Str::uuid(),
                        'faq_category_id' => $row->faq_category_id,
                        'question' => $row->question ?? $row->title ?? '',
                        'answer' => $row->answer ?? $row->content ?? '',
                        'is_active' => 1,
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ]
                );
            }
        });

        $this->info('Migration completed successfully!');
    }
}
