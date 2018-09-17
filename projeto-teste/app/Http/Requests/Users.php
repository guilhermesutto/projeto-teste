<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Users extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [            
            'email' => 'unique:users',
            'cpf' => 'unique:users',            
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email já cadastrado',
            'cpf.unique'  => 'CPF já cadastrado',
        ];
    }
}
