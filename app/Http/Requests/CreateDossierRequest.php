<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDossierRequest extends FormRequest
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
            'nombre' =>['required'],
            'queEs' => ['required'],
            'publico' => ['required'],
            'mision' => ['required'],
            'vision' => ['required'],
            'valores' => ['required'],
            'servicios' => ['required'],
            'crecimiento' => ['required'],
            'que_se_puede_encontrar' => ['required'],
            'cualidades' => ['required'],
            'comentarios' => [''],
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' =>'Por favor llena este campo.',
            'queEs.required' =>'Por favor llena este campo.',
            'publico.required' =>'Por favor llena este campo.',
            'mision.required' =>'Por favor llena este campo.',
            'vision.required' =>'Por favor llena este campo.',
            'valores.required' =>'Por favor llena este campo.',
            'servicios.required' =>'Por favor llena este campo.',
            'crecimiento.required' =>'Por favor llena este campo.',
            'que_se_puede_encontrar.required' =>'Por favor llena este campo.',
            'cualidades.required' =>'Por favor llena este campo.',
            'comentarios.required' =>'Por favor llena este campo.',
        ];
    }
}
