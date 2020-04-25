<?php

namespace App\Http\Requests\Backend\attentionplaces;

use Illuminate\Foundation\Http\FormRequest;

class AttentionplacesUpdateFormRequest extends FormRequest
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
            'address' => 'required',
            'number' => 'required',
            'phone' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este campo es requerido',
            'address.required' => 'Este campo es requerido',
            'number.required' => 'Este campo es requerido',
            'phone.required' => 'Este campo es requerido',
        ];
    }
}
