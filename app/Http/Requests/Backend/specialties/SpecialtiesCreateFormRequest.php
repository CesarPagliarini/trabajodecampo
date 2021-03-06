<?php

namespace App\Http\Requests\Backend\specialties;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtiesCreateFormRequest extends FormRequest
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
            'name'  => 'required',
            'description'  => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Este campo es requerido',
            'description.required'  => 'Este campo es requerido',

        ];
    }
}
