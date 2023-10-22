<?php

namespace Database\Seeders;

use App\Domain\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' =>  'admin@buckhill.co.uk',
            'password' => Hash::make('admin'),
            'first_name' => 'admin',
            'last_name' => 'admin',
            'is_admin' => true,
            'address' => 'Bandung',
            'phone_number' => '123'
        ]);
    }
}
