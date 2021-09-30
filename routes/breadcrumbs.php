<?php

use App\Models\Category;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as Crumbs;

// Admin

Breadcrumbs::for('admin.home', function (Crumbs $crumbs) {
    $crumbs->push('Admin', route('admin.home'));
});

// Users

Breadcrumbs::for('admin.users.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Users', route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push('Create', route('admin.users.create'));
});

Breadcrumbs::for('admin.users.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push($user->name, route('admin.users.index', $user));
});

Breadcrumbs::for('admin.users.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push('Edit', route('admin.users.edit', $user));
});

// Categories

Breadcrumbs::for('admin.categories.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Categories', route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.categories.index');
    $crumbs->push('Create', route('admin.categories.create'));
});

Breadcrumbs::for('admin.categories.show', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.categories.index');
    $crumbs->push($category->name, route('admin.categories.index', $category));
});

Breadcrumbs::for('admin.categories.edit', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.categories.show', $category);
    $crumbs->push('Edit', route('admin.categories.edit', $category));
});

// Dishes

Breadcrumbs::for('admin.dishes.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Dishes', route('admin.dishes.index'));
});

Breadcrumbs::for('admin.dishes.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.dishes.index');
    $crumbs->push('Create', route('admin.dishes.create'));
});

Breadcrumbs::for('admin.dishes.show', function (Crumbs $crumbs, Dish $dish) {
    $crumbs->parent('admin.dishes.index');
    $crumbs->push($dish->name, route('admin.dishes.index', $dish));
});

Breadcrumbs::for('admin.dishes.edit', function (Crumbs $crumbs, Dish $dish) {
    $crumbs->parent('admin.dishes.show', $dish);
    $crumbs->push('Edit', route('admin.dishes.edit', $dish));
});

// Menus

Breadcrumbs::for('admin.menus.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Menus', route('admin.menus.index'));
});

Breadcrumbs::for('admin.menus.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.menus.index');
    $crumbs->push('Create', route('admin.menus.create'));
});

Breadcrumbs::for('admin.menus.show', function (Crumbs $crumbs, Menu $menu) {
    $crumbs->parent('admin.menus.index');
    $crumbs->push($menu->dish->name.' - '.$menu->actual_at->format('Y-m-d'), route('admin.menus.index', $menu));
});

Breadcrumbs::for('admin.menus.edit', function (Crumbs $crumbs, Menu $menu) {
    $crumbs->parent('admin.menus.show', $menu);
    $crumbs->push('Edit', route('admin.menus.edit', $menu));
});