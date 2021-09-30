<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menus\StoreRequest;
use App\Http\Requests\Admin\Menus\UpdateRequest;
use App\Models\Dish;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

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

    public function store(StoreRequest $request): RedirectResponse
    {
        $menu = Menu::create($request->only(['dish_id', 'price', 'actual_at']));

        return redirect()->route('admin.menus.show', $menu);
    }

    public function show(Menu $menu): View
    {
        return view('admin.menus.show', compact('menu'));
    }

    public function edit(Menu $menu): View
    {
        $dishes = Dish::with('category')->get();

        return view('admin.menus.edit', compact('menu', 'dishes'));
    }

    public function update(UpdateRequest $request, Menu $menu): RedirectResponse
    {
        $menu->update([
            'dish_id' => $request['dish_id'],
            'price' => $request['price'],
            'actual_at' => $request['actual_at']
        ]);

        return redirect()->route('admin.menus.show', $menu);
    }

    /**
     * @throws Throwable
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->deleteOrFail();

        return redirect()->route('admin.menus.index');
    }
}
