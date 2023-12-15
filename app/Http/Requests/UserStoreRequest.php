<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', "min:3", "max:50", "regex:/^[a-zA-Z\s]*$/"],
            'email' => ['required', 'email', "regex:/^\S+@\S+\.\S+$/", "unique:users"],
            'password' => ['required', "min:3", "max:255"],
        ];
    }
}
