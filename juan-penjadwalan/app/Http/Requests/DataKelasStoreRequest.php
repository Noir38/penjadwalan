<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataKelasStoreRequest extends FormRequest
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
        if(request()->isMethod('post')) {
            return [
                'kode_ruang' => 'required',
                
                
            ];
        } else {
            return [
                'kode_ruang' => 'required',
                
            ];
        }
    }
     
    public function messages()
    {
        if(request()->isMethod('post')) {
            return [
                'kode_ruang.required' => 'kode_ruang is required!',
                
               
            ];
        } else {
            return [
                'kode_ruang.required' => 'kode_ruang is required!',
                
               
            ];   
        }
    }
}