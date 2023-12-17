<?php

namespace App\Http\Requests;

use App\Interfaces\PostInterface;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(PostInterface $service): bool
    {
        return true;

//        it works, but no need to complicate

//        return $this->user()->can('update', $service->find($this->route('post')));
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
            "slug" => ["required", "string", "min:3", "max:75", "regex:/^[A-Za-z0-9\-]+$/", "unique:posts,slug,{$this->route('post')}"],
            "content" => ["required", "string", "min:3", "max:255"],
        ];
    }
}
