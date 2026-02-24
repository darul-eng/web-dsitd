<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

use App\Traits\HasAssets;

class Document extends Model
{
    use HasFactory, HasAssets;

    protected $fillable = [
        'uuid',
        'document_category_id',
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'downloads_count',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'downloads_count' => 'integer',
        'file_size' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($doc) {
            $doc->uuid = (string) Str::uuid();
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id');
    }
}
