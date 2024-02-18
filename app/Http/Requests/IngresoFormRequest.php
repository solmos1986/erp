<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest
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
            'idCLiente' => 'max:11',
            'idTipoPago' => 'max:50',
            'idTipoComprobante' => 'max:50',
            'fechaIngreso' => '', //required|
            'impuestoIngreso' => 'max:11,0',
            'estadoIngreso' => 'max:11',
            'idProducto' => 'max:11',
            'cantidadVenta' => 'max:25',
            'precioVenta' => 'max:25,0',

        ];
    }
}
