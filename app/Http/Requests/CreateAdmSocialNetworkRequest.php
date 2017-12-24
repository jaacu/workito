<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdmSocialNetworkRequest extends FormRequest
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
            'facebook' => ['required_without_all:twitter,instagram'],
            'fbPermisosCompra' => ['required_with:facebook'],
            'twitter' => ['required_without_all:facebook,instagram'],
            'twEmail' => ['required_with:twitter'],
            'twPassword' => ['required_with:twitter'],
            'instagram' => ['required_without_all:facebook,twitter'],
            'instEmail' => ['required_with:instagram'],
            'instPassword' => ['required_with:instagram'],
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'Por favor Ingresa un nombre.',
            'fbPermisosCompra.required_with' => 'Llena este campo para que podamos administrar tu Facebook.',
            'twEmail.required_with' => 'Llena este campo para que podamos administrar tu Twitter.',
            'twPassword.required_with' => 'Llena este campo para que podamos administrar tu Twitter.',
            'instEmail.required_with' => 'Llena este campo para que podamos administrar tu Instagram.',
            'instPassword.required_with' => 'Llena este campo para que podamos administrar tu Instagram.',
        ];
    }
}
