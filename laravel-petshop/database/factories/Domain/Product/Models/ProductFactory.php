<?php

namespace Database\Factories\Domain\Product\Models;

use App\Domain\File\Models\File;
use App\Domain\Product\Models\Brand;
use App\Domain\Product\Models\Category;
use App\Domain\Product\Models\Product;
use App\Domain\Product\DTO\MetadataDTO;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_uuid' => $this->getCategories()->uuid,
            'title' => fake()->word,
            'price' => fake()->numberBetween(100, 500),
            'description' => fake()->text,
            'metadata' => MetadataDTO::from([
                'brand' => $this->getBrands()->uuid,
                'image' => $this->getFiles()->uuid
            ])
        ];
    }

    /**
     * Find random brands
     *
     * @return mixed
     */
    public function getBrands(): mixed
    {
        return Brand::limit(5)->get()->random(1)->first();
    }

    /**
     * Find random files
     *
     * @return mixed
     */
    public function getFiles(): mixed
    {
        return File::limit(5)->get()->random(1)->first();
    }

    /**
     * Find random category
     *
     * @return mixed
     */
    public function getCategories(): mixed
    {
        return Category::limit(5)->get()->random(1)->first();
    }

}
