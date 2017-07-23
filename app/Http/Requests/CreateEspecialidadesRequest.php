<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEspecialidadesRequest extends FormRequest
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

            'especialidad' => 'required|string|max:40|unique:specialties'

        ];
    }

    public function messages()
{
    return [
        'especialidad.required' => '    Debe Añadir el Nombre de la Especialidad',
        'especialidad.max:40' =>'     No puede sobrepasar los 40 caracteres',
        'especialidad.unique'=>'      Ya existe esta especialidad'

    ];
}
}
