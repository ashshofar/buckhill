<?php

namespace Database\Seeders;

use App\Domain\Order\BLL\Order\OrderBLLInterface;
use App\Domain\Order\DTO\Order\OrderDTO;
use App\Domain\Order\Models\OrderStatus;
use App\Domain\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTableSeeder extends Seeder
{
    public function __construct(public OrderBLLInterface $orderBLL)
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('is_admin', 0)->limit(5)->get();
        $orderStatus = DB::table('order_statuses')->inRandomOrder()->first();
        $payment = DB::table('payments')->inRandomOrder()->first();

        foreach ($users as $user) {
            for ($i=0;$i<=10;$i++) {

                $orderDTO = OrderDTO::from([
                    'order_status_uuid' => $orderStatus->uuid,
                    'payment_uuid' => $payment->uuid,
                    'products' => [
                        [
                            'uuid' => DB::table('products')->inRandomOrder()->first()->uuid,
                            'quantity' => fake()->numberBetween(1, 10)
                        ], [
                            'uuid' => DB::table('products')->inRandomOrder()->first()->uuid,
                            'quantity' => fake()->numberBetween(1, 10)
                        ], [
                            'uuid' => DB::table('products')->inRandomOrder()->first()->uuid,
                            'quantity' => fake()->numberBetween(1, 10)
                        ],
                    ],
                    'address' => [
                        'billing' => fake()->address,
                        'shipping' => fake()->address
                    ],
                ]);

                $this->orderBLL->createOrder($orderDTO, $user->id);
            }
        }
    }
}
