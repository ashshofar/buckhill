<?php

namespace Database\Seeders;

use App\Domain\Product\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(10)->create();
    }
}
