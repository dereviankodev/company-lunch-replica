<?php

namespace App\GraphQL\Mutations;

use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CategoryMutator
{
    public function create($root, array $args): Category
    {
        $params = Arr::only($args, ['name']);

        if (Arr::has($args, 'image')) {
            $fileName = Storage::putFile('images/category', $args['image']);
            $params = array_merge($params, ['img_path' => $fileName]);
        }

        return Category::create($params);
    }

    public function update($root, array $args): Category
    {
        $params = Arr::only($args, ['id', 'name']);
        $category = Category::find($params['id']);

        if (Arr::has($args, 'image')) {
            $currentImage = $category->img_path;

            if ($this->isDifferentFiles($currentImage, $args['image'])) {
                Storage::delete($currentImage);
                $fileName = Storage::putFile('images/category', $args['image']);
                $params = array_merge($params, ['img_path' => $fileName]);

                if ($category->update($params)) {
                    return $category;
                }
            }
        }

        $category->update($params);

        return $category;
    }

    public function upsert($root, array $args): Category
    {
        $params = Arr::only($args, ['id', 'name']);
        $category = Category::find($params['id']);

        if (Arr::has($args, 'image')) {
            $currentImage = $category->img_path;

            if ($this->isDifferentFiles($currentImage, $args['image'])) {
                Storage::delete($currentImage);
                $fileName = Storage::putFile('images/category', $args['image']);
                $params = array_merge($params, ['img_path' => $fileName]);

                return Category::updateOrCreate(
                    ['id' => $args['id']],
                    $params
                );
            }
        }

        return Category::updateOrCreate(
            ['id' => $args['id']],
            $params
        );
    }

    public function forceDelete($root, array $args): Category
    {
        $category = Category::find($args['id']);
        Storage::delete($category->img_path);
        $category->forceDelete();

        return $category;
    }

    private function isDifferentFiles($currentImage, UploadedFile $image): bool
    {
        if (
            Storage::size($currentImage) === $image->getSize()
            && Storage::mimeType($currentImage) === $image->getMimeType()
        ) {
            return false;
        }

        return true;
    }
}
