<?php

namespace App\Http\Requests\Backend\services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesCreateFormRequest extends FormRequest
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
            'specialties' => 'required|array|min:1',
            'name'  => 'required',
            'description'  => 'required',

        ];
    }

    public function messages()
    {
        return [
            'specialties.required' => 'Escoje al menos una especialidad',
            'name.required'  => 'Este campo es requerido',
            'description.required'  => 'Este campo es requerido',

        ];
    }

}
