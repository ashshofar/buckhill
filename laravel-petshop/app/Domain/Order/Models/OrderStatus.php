<?php

namespace App\Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class OrderStatus extends Model
{

    const SORT_FIELD = [
        'title'
    ];

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

    /**
     * Orders relations
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
