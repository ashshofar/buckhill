<?php

namespace Database\Factories\Domain\File\Models;

use App\Domain\File\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory
 */
class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $images = [
            'https://images.pexels.com/photos/1643457/pexels-photo-1643457.jpeg',
            'https://images.pexels.com/photos/1828875/pexels-photo-1828875.jpeg',
            'https://images.pexels.com/photos/1741206/pexels-photo-1741206.jpeg',
            'https://images.pexels.com/photos/3361739/pexels-photo-3361739.jpeg',
            'https://images.pexels.com/photos/2523934/pexels-photo-2523934.jpeg',
            'https://images.pexels.com/photos/1458926/pexels-photo-1458926.jpeg'
        ];

        $pathStorage = File::PATH_IMAGE;
        $imageUrl = $images[rand(0, 5)];
        $file = file_get_contents($imageUrl);
        $name = substr($imageUrl, strrpos($imageUrl, '/') + 1);
        Storage::put("public/${pathStorage}/${name}", $file);

        return [
            'name' => $name,
            'path' => $pathStorage,
            'size' => strlen($file),
            'type' => 'image/jpeg'
        ];
    }
}
