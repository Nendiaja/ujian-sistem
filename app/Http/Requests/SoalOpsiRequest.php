<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoalOpsiRequest extends FormRequest
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
            // tabel soal
            'soal' => 'required',
            'poin' => 'sometimes',
            'kategori_id' => 'required',

            // tabel opsi
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'jawaban' => 'required',
            'soal_id' => 'required',
        ];
    }
}
