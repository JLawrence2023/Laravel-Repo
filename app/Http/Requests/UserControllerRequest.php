<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserControllerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'last_name' => 'nullable',
            'first_name' => 'nullable',
            'age' => 'numeric|nullable',
        ];
    }
}
