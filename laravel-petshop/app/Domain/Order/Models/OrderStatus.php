<?php

namespace App\Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderStatus extends Model
{
    protected $fillable = [
        'title'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($orderStatus) {
            $orderStatus->uuid = (string) Str::uuid();
        });
    }
}
