<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicosRequest extends FormRequest
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
         'run' => 'required|string|size:10',
         'nombres' => 'required|string|max:30',
         'paterno'=>'required|string|max:20',
         'materno'=>'required|string|max:20',
         'especialidad_id'=> 'required',
         'comentarios'=>'required|string|max:500'
        ];
    }
}
