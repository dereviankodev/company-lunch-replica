<?php

namespace App\Http\Requests\Admin\Dishes;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:dishes'],
            'ingredients' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
