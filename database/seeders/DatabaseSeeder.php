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
    public function run()
    {
        User::factory(30)->create();

        Category::factory(10)
            ->has(Dish::factory()->count(random_int(6, 27)))
            ->create();

        $menus = Menu::factory(random_int(250, 500))->make();
        foreach ($menus as $menu) {
            repeat:
            try {
                $menu->save();
            } catch (\Illuminate\Database\QueryException $e) {
                $menus = Menu::factory()->make();
                goto repeat;
            }
        }
    }
}
