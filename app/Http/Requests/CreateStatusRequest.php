<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStatusRequest extends FormRequest
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

          'estado' => 'unique:states|required|string|max:20',
          'descripcion' => 'required|string|max:200'

      ];
    }

    public function messages()
    {
      return [
        'estado.required' => 'Debe Añadir Nombre del nuevo estado',
        'estado.max:20' =>'No puede sobrepasar los 20 caracteres',
        'estado.unique:states'=>'Ya existe este estado',
        'descripcion.required' => 'Debe ingresar una descripción para el estado',
        'descripcion.string' => 'Método de entrada invalido',
        'descripcion.max:200' =>'La descripción debe ser de un máximo de 200 caracteres'

      ];
    }
}
