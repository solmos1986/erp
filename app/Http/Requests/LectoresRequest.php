<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectoresRequest extends FormRequest
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
            'idLector' => 'max:10',
            'nomLector' => 'max:100',
            'ipLector' => 'max:25',
            'portLector' => 'max:25',
            'userLector' => 'max:150',
            'passLector' => 'max:100',
            'condicionLector' => 'max:2',
        ];
    }
}
