<?php

namespace Database\Seeders;

use App\Domain\File\Models\File;
use Illuminate\Database\Seeder;

class FileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::factory()->count(10)->create();
    }
}
