<?php

namespace App\Http\Requests\Admin\Menus;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property Menu $menu
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
            'dish_id' => [
                'required',
                'integer',
                Rule::unique('menus')
                    ->where('actual_at', $this->menu->actual_at)
                    ->ignore($this->menu),
                'exists:dishes,id',
            ],
            'price' => [
                'integer',
                'nullable',
                'min:1',
            ],
            'actual_at' => [
                'required',
                'date',
                Rule::unique('menus')
                    ->where('dish_id', $this->menu->dish_id)
                    ->ignore($this->menu),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'dish_id.unique' => 'The dish has already been taken for the current date.',
            'actual_at.unique' => 'The dish has already been taken for the current date.'
        ];
    }
}
