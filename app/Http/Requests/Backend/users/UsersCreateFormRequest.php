<?php

namespace App\Http\Requests\Backend\users;

use Illuminate\Foundation\Http\FormRequest;

class UsersCreateFormRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'roles' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este campo es requerido',
            'email.required'  => 'Este campo es requerido',
            'email.unique'  => 'El email ya existe',
            'password.required'  => 'Este campo es requerido',
            'roles.required'  => 'Escoje al menos 1 rol',
        ];
    }
}
