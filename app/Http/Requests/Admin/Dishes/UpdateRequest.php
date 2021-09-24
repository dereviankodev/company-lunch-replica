<?php

namespace App\Http\Requests\Admin\Dishes;

use App\Models\Dish;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Dish $dish
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
            'name' => ['required', 'string', 'max:255', 'unique:dishes,id,'.$this->dish->name],
            'ingredients' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
