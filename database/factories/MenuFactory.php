<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Menu;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    /**
     * @throws Exception
     */
    public function definition(): array
    {
        $dishesIdArray = Dish::all('id')->pluck('id')->toArray();

        return [
            'dish_id' => $this->faker->randomElement($dishesIdArray),
            'price' => random_int(7, 245),
            'actual_at' => $this->faker->dateTimeBetween('-1 day', '+25 day'),
        ];
    }
}
