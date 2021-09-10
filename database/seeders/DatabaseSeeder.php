<?php

namespace Database\Seeders;

use App\Models\{
    Category,
    Dish,
    Menu,
    User
};
use Exception;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        User::factory(130)->create();
        Category::factory(10)
            ->has(Dish::factory()->count(random_int(6, 27)))
            ->create();
        Menu::factory(random_int(90, 270))->create();
    }
}
