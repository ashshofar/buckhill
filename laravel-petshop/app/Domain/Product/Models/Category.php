<?php

namespace App\Domain\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasSlug;
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->uuid = (string) Str::uuid();
        });
    }

    /**
     * Get options for generating the slug
     *
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
