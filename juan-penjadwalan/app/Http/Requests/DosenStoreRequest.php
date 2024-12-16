<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenStoreRequest extends FormRequest
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
            'nidn' => 'required|string',
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            's1' => 'nullable|string',
            's2' => 'nullable|string',
            's3' => 'nullable|string',
        ];
    }
     
    public function messages()
    {
        return [
            'nama.required' => 'Nama is required!',
            'nidn.required' => 'NIDN is required!',
            'nidn.numeric' => 'NIDN must be a number!',
        ];
    }
}
