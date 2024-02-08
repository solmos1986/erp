<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
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
            'idProducto'=>'max:10',
            'codProducto'=>'max:45',
            'nomProducto'=>'max:100',
            'unidadMedida'=>'max:45',
            'imagenProducto'=>'mimes:jpeg,bmp,png', //required|
            'stockMinimo'=>'max:11',
            'idCategoria'=>'max:35',
            'condicionProducto'=>'max:2',
             ];
    }
}
