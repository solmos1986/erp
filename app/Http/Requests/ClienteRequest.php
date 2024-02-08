<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
        'idCliente'=>'max:10',
        'nomCliente'=>'max:100',
    	'docCliente'=>'max:20',
    	'tel1Cliente'=>'max:25',
    	'tel2Cliente'=>'max:25',
    	'dirCliente'=>'max:150',
        'mailCliente'=>'max:100',
        'CondicionCliente'=>'max:2',
        ];
    }
}
