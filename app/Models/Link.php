<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'url',
        'category',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($link) {
            $link->uuid = (string) Str::uuid();
        });
    }
}
