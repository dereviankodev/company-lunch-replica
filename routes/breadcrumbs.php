<?php

use App\Models\Category;
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

Breadcrumbs::for('admin.categories.show', function (Crumbs $crumbs, Category $categories) {
    $crumbs->parent('admin.categories.index');
    $crumbs->push($categories->name, route('admin.categories.index', $categories));
});

Breadcrumbs::for('admin.categories.edit', function (Crumbs $crumbs, Category $categories) {
    $crumbs->parent('admin.categories.show', $categories);
    $crumbs->push('Edit', route('admin.categories.edit', $categories));
});