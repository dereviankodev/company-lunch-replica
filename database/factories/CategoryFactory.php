<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $filePath = storage_path('app/public/images/category');
        return [
            'name' => ucfirst($this->faker->unique()->words(2, true)),
            'img_path' => 'images/category/'.$this->faker->image($filePath, 765, 70, 'menu', false)
        ];
    }
}
