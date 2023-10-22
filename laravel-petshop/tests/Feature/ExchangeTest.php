<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExchangeTest extends TestCase
{
    public function test_user_can_exchange_currency()
    {
        $response = $this->json('GET', '/api/exchange', [
            'amount' => 10,
            'currency' => 'idr',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['success', 'data']);
    }

    public function test_user_cannot_exchange_currency_with_invalid_currency()
    {
        $response = $this->json('GET', '/api/exchange', [
            'amount' => 3343545,
            'currency' => 'invalid currency',
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('Invalid currency');
        $response->assertJsonStructure(['success', 'data']);
    }

    public function test_user_cannot_exchange_currency_without_parameter()
    {
        $response = $this->json('GET', '/api/exchange');

        $response->assertStatus(422);
    }
}
