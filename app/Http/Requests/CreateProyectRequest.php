<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateProyectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $hoy = date("Y-m-d H:i:s");
        return [
            'name' => ['required','max:20','min:4'],
            'fecha_limite' => ['required',"date","after:$hoy"],
            'dev' => ['required','exists:users,id'],
            'type' => ['required','numeric'],
            'id' => ['required','numeric'],
            'descripcion' => ['sometimes','required','max:500'],
        ];
    }
    public function messages()
    {
        return [ 'name.max' => 'Max 20 caracteres.',
        'name.required' => 'Por favor Ingresa un nombre valido.',
        'name.min' => 'Min 4 caracteres.',
        'fecha_limite.date' => 'El valor ingresado debe ser una fecha.',
        'fecha_limite.after' => 'El valor ingresado debe ser una fecha luego de hoy.',
        'dev.required' => 'Debes ingresar un desarrollador.',
        'dev.numeric' => 'Debe tener un valor numerico.',
        'dev.exists' => 'El desarrollador ingresado debe estar registrado.',
        'descripcion.required' => 'Este campo es requerido.',
        'descripcion.max' => 'Maximo 500 caracteres.',
        // 'type.numeric' => '',
        // 'type.required' => '',
        // 'id.numeric' => '',
        // 'id.required' => '',
    ];
}
}
