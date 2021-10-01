<?php

namespace App\Providers;
use App\Models\{
    Cart,
    Category,
    Dish,
    Menu,
    Order,
    OrderItem,
    User
};
use App\Policies\{CartPolicy, CategoryPolicy, DishPolicy, MenuPolicy, OrderItemPolicy, OrderPolicy, UserPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
         User::class => UserPolicy::class,
         Category::class => CategoryPolicy::class,
         Dish::class => DishPolicy::class,
         Menu::class => MenuPolicy::class,
         Order::class => OrderPolicy::class,
         OrderItem::class => OrderItemPolicy::class,
         Cart::class => CartPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
