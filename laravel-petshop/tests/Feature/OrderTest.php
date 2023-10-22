<?php

namespace Tests\Feature;

use App\Domain\File\Models\File;
use App\Domain\Order\Models\OrderStatus;
use App\Domain\Order\Models\Payment;
use App\Domain\Product\Models\Brand;
use App\Domain\Product\Models\Category;
use App\Domain\Product\Models\Product;
use App\Domain\User\BLL\Auth\AuthBLL;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $authBLL = app()->make(AuthBLL::class);

        // Create a user using factory or a real user from your database.
        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);

        // Authenticate the user and obtain a Bearer token.
        $this->token = $authBLL->createToken($user);

        File::factory()->count(10)->create();
        Brand::factory()->count(10)->create();
        Category::factory()->count(10)->create();
    }

    public function test_unauthenticated_user_cannot_create_order()
    {
        // Send a POST request to a protected API route without a token.
        $response = $this->json('POST', '/api/v1/order/create');

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_create_order()
    {
        $product = Product::factory()->create();
        $orderStatus = OrderStatus::create(['title' => 'open']);
        $payment = Payment::factory()->create();

        // Send a POST request to create order
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                    ->json('POST', '/api/v1/order/create', [
                        "order_status_uuid" => $orderStatus->uuid,
                        'payment_uuid' => $payment->uuid,
                        'products' => [
                            [
                                "uuid" => $product->uuid,
                                "quantity" => 1
                            ]
                        ],
                        'address' => [
                            'billing' => $this->faker->address,
                            'shipping' => $this->faker->address
                        ]
                    ]);

        $response->assertStatus(200);
    }

    public function test_user_cannot_create_invalid_order()
    {
        // Send a POST request to create order
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                    ->json('POST', '/api/v1/order/create', [
                        "order_status_uuid" => 'wrong_uuid',
                        'payment_uuid' => 'wrong_uuid',
                        'products' => [
                            [
                                "uuid" => 'wrong_uuid',
                                "quantity" => 1
                            ]
                        ],
                        'address' => [
                            'billing' => $this->faker->address,
                            'shipping' => $this->faker->address
                        ]
                    ]);

        $response->assertStatus(422);
    }
}
