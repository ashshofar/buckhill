<?php

namespace App\Domain\File\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    protected $fillable = [
        'name',
        'path',
        'size',
        'type'
    ];

    protected $appends = [
      'url'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($file) {
            $file->uuid = (string) Str::uuid();
        });
    }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->path.'/'.$this->name);
    }
}
