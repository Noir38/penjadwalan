<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataAngkatanStoreRequest extends FormRequest
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
                'jurusan' => 'required',
                
            ];
        } else {
            return [
                'jurusan' => 'required',
                
            ];
        }
    }
     
    public function messages()
    {
        if(request()->isMethod('post')) {
            return [
                'jurusan.required' => 'jurusan is required!',
                
            ];
        } else {
            return [
                'jurusan.required' => 'jurusan is required!',
                
            ];   
        }
    }
}
