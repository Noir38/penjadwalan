<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailyscheduleStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'kode' => 'required',
            'matakuliah' => 'required',
            'sks' => 'required',
            'nama_kelas' => 'required',
            'hari' => 'required|string',
            'jam' => 'required|string',
            'ruang' => 'required',
            'pengampu1' => 'nullable',
            'pengampu2' => 'nullable',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'kode.required' => 'Kode is required!',
            'matakuliah.required' => 'Matakuliah is required!',
            'sks.required' => 'SKS is required!',
            'nama_kelas.required' => 'Nama kelas is required!',
            'hari.required' => 'Hari is required!',
            'jam.required' => 'Jam is required!',
            'ruang.required' => 'Ruang is required!',
            'pengampu1.string' => 'Pengampu 1 must be a string!',
            'pengampu2.string' => 'Pengampu 2 must be a string!',
        ];
    }
}
