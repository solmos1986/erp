<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaquetesGymRequest extends FormRequest
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
            'idPaquete' => 'max:10',
            'nomPaquete' => 'max:100',
            'duracionPaquete' => 'max:25',
            'costoPaquete' => 'max:25',
            'condicionPaquete' => 'max:2',
        ];
    }
}
