<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EgresoFormRequest extends FormRequest
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
            'idProveedor'=>'max:11',
            'idTipoPago'=>'max:50',
            'idTipoComprobante'=>'max:50',
            'numeroComprobante'=>'max:25',
            'fechaEgreso'=>'', //required|
            'impuestoEgreso'=>'max:11,0',
            'estadoEgreso'=>'max:11',
            'idProducto'=>'max:11',
            'cantidadCompra'=>'max:25',
            'precioVentaEgreso'=>'max:25,0',
            'precioCompraEgreso'=>'max:25,0',
             ];
    }
}
