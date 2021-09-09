<?php

namespace Database\Factories;

use App\Models\Dish;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dish::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->unique()->words(random_int(1, 3), true)),
            'ingredients' => str_replace(' ', ', ', $this->faker->words(random_int(3, 9), true)),
            'weight' => random_int(65, 650)
        ];
    }
}
