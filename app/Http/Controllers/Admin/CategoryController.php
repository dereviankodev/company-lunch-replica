<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Throwable;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $fileName = $request->file('image')->store('images/category');
        $category = Category::create(
            array_merge(
                $request->only(['name']),
                ['img_path' => $fileName]
            )
        );

        return redirect()->route('admin.categories.show', $category);
    }

    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateRequest $request, Category $category): RedirectResponse
    {
        $fileName = $category->img_path;

        if (isset($request['image']) && $category->isDifferentFiles($request['image'])) {
            Storage::delete($fileName);
            $fileName = $request->file('image')->store('images/category');
        }

        $category->update([
            'name' => $request['name'],
            'img_path' => $fileName,
        ]);

        return redirect()->route('admin.categories.show', $category);
    }

    /**
     * @throws Throwable
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->deleteOrFail();

        return redirect()->route('admin.categories.index');
    }
}
