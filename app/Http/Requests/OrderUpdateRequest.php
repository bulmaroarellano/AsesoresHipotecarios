<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'destino' => [
                'required',
                'in:casa,auto,préstamo,tarjeta de crédito',
            ],
            'monto_solicitado' => ['nullable', 'max:255', 'string'],
            'plazo' => ['nullable', 'max:2'],
        ];
    }
}
