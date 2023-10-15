<?php

namespace App\Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $fillable = [
        'title'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $payment->uuid = (string) Str::uuid();
        });
    }

    /**
     * Order relations
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
