<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tipo_comprobanteRequest extends FormRequest
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
            'nomTipoComprobante' => 'max:50',
            'condicionTipo_Comprobante' => 'max:2',

        ];

    }
}
