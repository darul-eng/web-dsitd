<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

use App\Traits\HasAssets;

class Member extends Model
{
    use HasFactory, HasAssets;

    protected $fillable = [
        'uuid',
        'parent_id',
        'fullname',
        'nip',
        'position',
        'position_group',
        'email',
        'phone',
        'address',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'religion',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            $member->uuid = (string) Str::uuid();
        });
    }

    // ─── Hierarchical relationships ───────────────────────────

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }
}
