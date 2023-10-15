<?php

namespace Database\Seeders;

use App\Domain\Order\Models\OrderStatus;
use App\Domain\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatus::create(['title' => 'canceled']);
        OrderStatus::create(['title' => 'shipped']);
        OrderStatus::create(['title' => 'paid']);
        OrderStatus::create(['title' => 'pending payment']);
    }
}
