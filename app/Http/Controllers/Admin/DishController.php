<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Dishes\StoreRequest;
use App\Http\Requests\Admin\Dishes\UpdateRequest;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class DishController extends Controller
{
    public function index(): View
    {
        $dishes = Dish::with('category')->paginate(20);

        return view('admin.dishes.index', compact('dishes'));
    }

    public function create(): View
    {
        $categories = Category::get(['id', 'name']);

        return view('admin.dishes.create', compact('categories'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $dish = Dish::create($request->only(['name', 'ingredients', 'weight', 'category_id']));

        return redirect()->route('admin.dishes.show', $dish);
    }

    public function show(Dish $dish): View
    {
        return view('admin.dishes.show', compact('dish'));
    }

    public function edit(Dish $dish): View
    {
        $categories = Category::get(['id', 'name']);

        return view('admin.dishes.edit', compact('dish', 'categories'));
    }

    public function update(UpdateRequest $request, Dish $dish): RedirectResponse
    {
        $dish->update([
            'name' => $request['name'],
            'ingredients' => $request['ingredients'],
            'weight' => $request['weight'],
            'category_id' => $request['category_id']
        ]);

        return redirect()->route('admin.dishes.show', $dish);
    }

    /**
     * @throws Throwable
     */
    public function destroy(Dish $dish): RedirectResponse
    {
        $dish->deleteOrFail();

        return redirect()->route('admin.dishes.index');
    }
}
