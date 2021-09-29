<?php

namespace App\Http\Requests\Admin\Categories;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Category $category
 */
class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,id,'.$this->category->id],
            'image' => [
                'file', 'image', 'mimes:jpeg,jpg,png,webp', 'max:256', 'dimensions:width=765,height=70',
                'nullable'
            ]
        ];
    }
}
