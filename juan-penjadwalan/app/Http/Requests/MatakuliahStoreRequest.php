<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatakuliahStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules(): array 
    {
        return [
            'kode' => 'required|unique:matakuliahs',
            'nama' => 'required|string',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
        ];
    }
     
    public function messages()
    {
        return [
            'kode.required' => 'Kode is required!',
            'kode.unique' => 'Kode must be unique!',
            'nama.required' => 'Nama is required!',
            'sks.required' => 'SKS is required!',
            'sks.integer' => 'SKS must be an integer!',
            'semester.required' => 'Semester is required!',
            'semester.integer' => 'Semester must be an integer!',
        ];
    }
}
