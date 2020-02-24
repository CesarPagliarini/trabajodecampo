<?php

namespace App\Http\Requests\Backend\services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesUpdateFormRequest extends FormRequest
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
            'specialty_id.required' => 'Este campo es requerido',
            'name.required'  => 'Este campo es requerido',
            'description.required'  => 'Este campo es requerido',

        ];
    }
}
