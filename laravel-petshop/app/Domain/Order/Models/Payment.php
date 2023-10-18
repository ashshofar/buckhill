<?php

namespace App\Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Payment extends Model
{
    const CREDIT_CARD = 'credit_card';
    const CASH_ON_DELIVERY = 'cash_on_delivery';
    const BANK_TRANSFER = 'bank_transfer';

    const PAYMENT_TYPE = [
        self::CREDIT_CARD,
        self::CASH_ON_DELIVERY,
        self::BANK_TRANSFER
    ];

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
     * Decode details column
     *
     * @param $value
     * @return mixed
     */
    public function getDetailsAttribute($value): mixed
    {
        return json_decode($value);
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
