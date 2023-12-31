<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', "min:3", "max:50", "regex:/^[а-яА-Я]|[a-zA-Z]$/"],
            'email' => ['required', 'email', "regex:/^\S+@\S+\.\S+$/", "unique:users,email,{$this->route('user')}"],
            'password' => ['required', "min:3", "max:255"],
        ];
    }

    protected function passedValidation(): void
    {
        $password = $this->validated('password');

        $this->replace(['password' => Hash::isHashed($password) ? $password : Hash::make($password)]);
    }
}
