<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
        'idProveedor'=>'max:10',
        'nomProveedor'=>'max:100',
    	'tel1Proveedor'=>'max:25',
    	'tel2Proveedor'=>'max:25',
    	'dirProveedor'=>'max:150',
        'mailProveedor'=>'max:100',
        'condicionProveedor'=>'max:2',
        ];
    }
}
