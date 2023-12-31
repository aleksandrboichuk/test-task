<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            "name" => ["required", "string", "min:3", "max:75"],
            "slug" => ["required", "string", "min:3", "max:75", "regex:/^[A-Za-z0-9\-]+$/", "unique:posts"],
            "content" => ["required", "string", "min:3", "max:255"],
        ];
    }
}
