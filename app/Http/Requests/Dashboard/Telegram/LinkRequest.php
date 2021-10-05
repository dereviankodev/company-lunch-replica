<?php

namespace App\Http\Requests\Dashboard\Telegram;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'photo_url' => ['required', 'string', 'max:255'],
            'auth_date' => ['required', 'date_format:U'],
            'hash' => ['required', 'string', 'max:255'],
        ];
    }
}
