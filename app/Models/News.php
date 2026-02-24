<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

use App\Traits\HasAssets;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory, HasAssets;

    protected $fillable = [
        'uuid',
        'news_category_id',
        'user_id',
        'title',
        'slug',
        'content',
        'cover_image',
        'status',
        'published_at',
        'views_count',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'updated_by',
        'start_at',
        'end_at',
        'publish_at_legacy',
        'updated_by_legacy',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            $news->uuid = (string) Str::uuid();
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    /**
     * Get the category that owns the news.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    /**
     * Get the author (user) of the news.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope a query to only include published news.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
