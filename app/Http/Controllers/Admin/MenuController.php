<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::with('dish.category')->paginate(20);

        return view('admin.menus.index', compact('menus'));
    }

    public function create(): View
    {
        $dishes = Dish::with('category')->get();

        return view('admin.menus.create', compact('dishes'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        //
    }

    public function update(Request $request, Menu $menu)
    {
        //
    }

    public function destroy(Menu $menu)
    {
        //
    }
}
