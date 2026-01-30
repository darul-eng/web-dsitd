<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'gallery_id',
        'image_path',
        'caption',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($img) {
            $img->uuid = (string) Str::uuid();
        });
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
