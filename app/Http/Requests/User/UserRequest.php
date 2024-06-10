<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'SAP' => 'required|unique:users,SAP|numeric',
            'name' => 'required|string|max:255',
            'BU' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'role' => 'required|in:user,admin,visitor', // Ensure role is one of the specified values
            'password' => 'sometimes',
        ];
    }
}
