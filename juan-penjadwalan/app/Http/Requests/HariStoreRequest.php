<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HariStoreRequest extends FormRequest
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
            'hari' => 'required|string|max:255|unique:hari', // Pastikan hari memiliki nilai unik di dalam tabel 'hari'
        ];
    }
     
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'hari.required' => 'The hari field is required.',
            'hari.string' => 'The hari field must be a string.',
            'hari.max' => 'The hari may not be greater than :max characters.',
            'hari.unique' => 'The hari has already been taken.',
        ];
    }
}

