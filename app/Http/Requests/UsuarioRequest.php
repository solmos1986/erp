<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        'idUsuario'=>'max:10',
        'nomUsuario'=>'max:100',
        'docUsuario'=>'max:45',
    	'telUsuario'=>'max:25',
    	'dirUsuario'=>'max:150',
        'mailUsuario'=>'max:100',
        'condicionUsuario'=>'max:2',

        ];
    }
}
