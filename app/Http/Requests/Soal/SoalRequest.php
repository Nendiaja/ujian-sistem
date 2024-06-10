<?php

namespace App\Http\Requests\Soal;

use Illuminate\Foundation\Http\FormRequest;

class SoalRequest extends FormRequest
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
            'soal' => 'required',
            'gambar' => 'sometimes',
            'poin' => 'sometimes',
            'kategori_id' => 'required',
        ];
    }
}
