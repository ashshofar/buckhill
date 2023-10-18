<?php

namespace App\Domain\Order\Models;

use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Order extends Model
{
    const MIN_AMOUNT_TOTAL = 500;
    const DELIVERY_FEE = 15;

    protected $fillable = [
        'user_id',
        'order_status_id',
        'payment_id',
        'products',
        'address',
        'delivery_fee',
        'amount',
        'shipped_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->uuid = (string) Str::uuid();
        });
    }

    /**
     * Decode products column
     *
     * @param $value
     * @return mixed
     */
    public function getProductsAttribute($value): mixed
    {
        return json_decode($value);
    }

    /**
     * Decode address column
     *
     * @param $value
     * @return mixed
     */
    public function getAddressAttribute($value): mixed
    {
        return json_decode($value);
    }

    /**
     * User relations
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Order status relations
     *
     * @return BelongsTo
     */
    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * Payment relations
     *
     * @return BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
