<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'page_category_id',
        'title',
        'slug',
        'content',
        'cover_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_published',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            $page->uuid = (string) Str::uuid();
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PageCategory::class, 'page_category_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
