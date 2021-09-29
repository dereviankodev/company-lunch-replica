<?php

namespace App\Http\Requests\Admin\Dishes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $name
 * @property ?string $ingredients
 */
class StoreRequest extends FormRequest
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
                    ->where('ingredients', $this?->ingredients)
            ],
            'ingredients' => [
                'string',
                'nullable',
                'max:255',
                Rule::unique('dishes')
                    ->where('name', $this->name)
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
