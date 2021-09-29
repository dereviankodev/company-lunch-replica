<?php

namespace App\Http\Requests\Admin\Dishes;

use App\Models\Dish;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dishes')
                    ->where('ingredients', $this->dish?->ingredients)
                    ->ignore($this->dish)
            ],
            'ingredients' => [
                'string',
                'nullable',
                'max:255',
                Rule::unique('dishes')
                    ->where('name', $this->dish->name)
                    ->ignore($this->dish)
            ],
            'weight' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'The combination of name and ingredients has already been taken.',
            'ingredients.unique' => 'The combination of name and ingredients has already been taken.'
        ];
    }
}
