<?php

namespace Database\Factories\Domain\Order\Models;

use App\Domain\Order\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'cash_on_delivery',
            'details' => json_encode([
                "address" => fake()->address,
                "last_name" => fake()->firstName,
                "first_name" => fake()->lastName
            ])
        ];
    }
}
